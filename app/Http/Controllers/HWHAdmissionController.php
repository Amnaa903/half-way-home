<?php

namespace App\Http\Controllers;

use App\Models\HWHAdmission;
use App\Models\Child;
use App\Models\Incharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;

class HWHAdmissionController extends Controller
{
    /**
     * Format CNIC for display (add hyphens)
     */
    private function formatCnicForDisplay($cnic)
    {
        if (!$cnic || strlen($cnic) !== 13) {
            return $cnic;
        }
        
        // Convert "1234567890123" to "12345-6789012-3"
        return substr($cnic, 0, 5) . '-' . substr($cnic, 5, 7) . '-' . substr($cnic, 12, 1);
    }

    /**
     * Format CNIC for storage (remove hyphens)
     */
    private function formatCnicForStorage($cnic)
    {
        if (!$cnic) {
            return $cnic;
        }
        
        // Remove any hyphens, spaces, or other non-digit characters
        return preg_replace('/[^0-9]/', '', $cnic);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = HWHAdmission::query();
        
        // Format search CNIC for storage before querying
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $searchCnic = $this->formatCnicForStorage($search);
            
            $query->where(function($q) use ($search, $searchCnic) {
                $q->where('patient_name', 'like', "%{$search}%")
                  ->orWhere('cnic', 'like', "%{$searchCnic}%")
                  ->orWhere('father_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        
        // Status filtering
        if ($request->has('status') && $request->status == 'discharged') {
            $query->where('status', 'discharged');
        } elseif ($request->has('status') && $request->status == 'active') {
            $query->where('status', 'active');
        }
        
        $hwhadmissions = $query->with('children')->orderBy('created_at', 'desc')->paginate(10);
        
        return view('hwhadmissions.index', compact('hwhadmissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Pre-fill data if coming from incharge list
        $prefillData = [];
        
        if ($request->has('incharge_id')) {
            $prefillData = [
                'incharge_id' => $request->get('incharge_id'),
                'patient_name' => $request->get('name'),
                'cnic' => $request->get('cnic'),
                'father_name' => $request->get('father_name', ''),
                'phone' => $request->get('phone', ''),
                'address' => $request->get('address', ''),
                'guardian_name' => $request->get('guardian_name', ''),
                'guardian_contact' => $request->get('guardian_contact', ''),
            ];
        }
        
        return view('hwhadmissions.create', compact('prefillData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('Form submission started', ['data' => $request->except(['_token', 'files'])]);

        // Format CNIC for storage before validation
        if ($request->has('cnic') && $request->cnic) {
            $request->merge([
                'cnic' => $this->formatCnicForStorage($request->cnic)
            ]);
        }

        // Validate the main form data
        $validator = Validator::make($request->all(), [
            'patient_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|in:male,female,other',
            'cnic' => 'required|regex:/^\d{13}$/|unique:hwh_admissions,cnic',
            'phone' => 'required|string|max:15',
            'education' => 'nullable|string|max:255',
            'address' => 'required|string',
            'marital_status' => 'required|in:Single,Married,Widowed,Divorced',
            'spouse_name' => 'nullable|string|max:255',
            'children_count' => 'nullable|integer|min:0',
            'boys_count' => 'nullable|integer|min:0',
            'girls_count' => 'nullable|integer|min:0',
            'religion' => 'nullable|string|max:255',
            'guardian_name' => 'required|string|max:255',
            'guardian_contact' => 'required|string|max:15',
            'relationship' => 'required|string|max:255',
            'guardian_address' => 'required|string',
            'admission_date' => 'required|date',
            'reason' => 'nullable|string',
            'disease_name' => 'required|string|max:255',
            'treatment_details' => 'required|string',
            'case_history' => 'required|string',
            'other_diseases' => 'nullable|string',
            
            // File validations
            'id_card_front' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'id_card_back' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'passport_photos' => 'required|array|min:1',
            'passport_photos.*' => 'file|mimes:jpg,jpeg,png|max:5120',
            'medical_reports' => 'required|array|min:1',
            'medical_reports.*' => 'file|mimes:pdf,jpg,jpeg,png|max:5120',
            'referral_form' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'affidavit' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'additional_documents' => 'nullable|array',
            'additional_documents.*' => 'file|mimes:pdf,jpg,jpeg,png|max:5120',
            
            // Children validation
            'children' => 'sometimes|array',
            'children.*.name' => 'required_with:children|string|max:255',
            'children.*.gender' => 'required_with:children|in:male,female',
            'children.*.age' => 'nullable|integer|min:0|max:25',
            'children.*.education' => 'nullable|string|max:255',
        ], [
            'id_card_front.required' => 'ID Card Front is required',
            'id_card_back.required' => 'ID Card Back is required',
            'passport_photos.required' => 'Passport photos are required',
            'passport_photos.min' => 'At least one passport photo is required',
            'medical_reports.required' => 'Medical reports are required',
            'medical_reports.min' => 'At least one medical report is required',
            'referral_form.required' => 'Referral form is required',
            'cnic.regex' => 'CNIC must be 13 digits without hyphens',
            'cnic.unique' => 'This CNIC is already registered',
        ]);

        if ($validator->fails()) {
            \Log::error('Validation failed', ['errors' => $validator->errors()->toArray()]);
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fix the validation errors below.');
        }

        DB::beginTransaction();

        try {
            $filePaths = [];

            // Handle single file uploads
            $singleFileFields = [
                'id_card_front',
                'id_card_back', 
                'referral_form', 
                'affidavit'
            ];
            
            foreach ($singleFileFields as $field) {
                if ($request->hasFile($field) && $request->file($field)->isValid()) {
                    $file = $request->file($field);
                    $fileName = time() . '_' . $field . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('admissions/' . date('Y/m'), $fileName, 'public');
                    $filePaths[$field] = $filePath;
                    \Log::info("File uploaded: {$field}", ['path' => $filePath]);
                } else {
                    if (in_array($field, ['id_card_front', 'id_card_back', 'referral_form'])) {
                        throw new \Exception("File upload failed for: {$field}. Please check the file and try again.");
                    }
                }
            }

            // Handle multiple file uploads
            $multipleFileFields = [
                'passport_photos',
                'medical_reports', 
                'additional_documents'
            ];
            
            foreach ($multipleFileFields as $field) {
                if ($request->hasFile($field)) {
                    $uploadedFiles = [];
                    foreach ($request->file($field) as $index => $file) {
                        if ($file->isValid()) {
                            $fileName = time() . '_' . $field . '_' . $index . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                            $filePath = $file->storeAs('admissions/' . date('Y/m'), $fileName, 'public');
                            $uploadedFiles[] = $filePath;
                            \Log::info("Multiple file uploaded: {$field}_{$index}", ['path' => $filePath]);
                        } else {
                            throw new \Exception("File upload failed for {$field} at index {$index}");
                        }
                    }
                    if (!empty($uploadedFiles)) {
                        $filePaths[$field] = json_encode($uploadedFiles);
                    }
                } elseif (in_array($field, ['passport_photos', 'medical_reports'])) {
                    throw new \Exception("Required files missing for: {$field}");
                }
            }

            // Prepare admission data
            $admissionData = $request->except([
                'children', 
                '_token', 
                'passport_photos', 
                'medical_reports', 
                'additional_documents',
                'id_card_front',
                'id_card_back', 
                'referral_form', 
                'affidavit'
            ]);
            
            // Format admission date to remove time
            if ($request->has('admission_date') && $request->admission_date) {
                $admissionData['admission_date'] = Carbon::parse($request->admission_date)->format('Y-m-d');
            }
            
            // Set default values for nullable fields
            $nullableFields = [
                'children_count' => 0,
                'boys_count' => 0,
                'girls_count' => 0,
                'spouse_name' => null,
                'education' => null,
                'religion' => null,
                'reason' => null,
                'other_diseases' => null,
                'incharge_id' => null,
            ];
            
            foreach ($nullableFields as $field => $defaultValue) {
                if (empty($admissionData[$field])) {
                    $admissionData[$field] = $defaultValue;
                }
            }
            
            // Set default status
            $admissionData['status'] = 'active';
            
            // Generate reference ID
            $admissionData['reference_id'] = 'HWH-' . date('Ymd') . '-' . strtoupper(Str::random(6));
            
            $admissionData = array_merge($admissionData, $filePaths);

            \Log::info('Creating admission record', ['data' => array_keys($admissionData)]);

            // Create the admission record
            $admission = HWHAdmission::create($admissionData);

            \Log::info('Admission record created', ['id' => $admission->id]);

            // AUTO-REMOVAL: Remove from incharge list if coming from there
            if ($request->has('incharge_id') && $request->incharge_id) {
                $incharge = Incharge::find($request->incharge_id);
                if ($incharge) {
                    $incharge->delete();
                    \Log::info('Auto-removed from incharge list', ['incharge_id' => $request->incharge_id]);
                }
            }

            // Save children information if exists
            if ($request->has('children') && is_array($request->children)) {
                $childrenCreated = 0;
                foreach ($request->children as $childData) {
                    // Only create child record if we have valid data
                    if (!empty($childData['name']) && !empty($childData['gender'])) {
                        Child::create([
                            'hwh_admission_id' => $admission->id,
                            'name' => $childData['name'],
                            'gender' => $childData['gender'],
                            'age' => $childData['age'] ?? null,
                            'education' => $childData['education'] ?? null,
                        ]);
                        $childrenCreated++;
                    }
                }
                \Log::info("Children records created", ['count' => $childrenCreated]);
            }

            DB::commit();

            \Log::info('Admission successfully created', ['id' => $admission->id]);

            return redirect()->route('hwhadmissions.index')
                ->with('success', 'Admission created successfully! Reference ID: ' . $admission->reference_id);

        } catch (\Exception $e) {
            DB::rollBack();
            
            \Log::error('Admission creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file_paths' => $filePaths ?? []
            ]);

            // Delete any uploaded files if transaction fails
            if (isset($filePaths)) {
                foreach ($filePaths as $filePath) {
                    try {
                        if (is_string($filePath)) {
                            // Check if it's JSON encoded array or single file path
                            if (str_starts_with($filePath, '[')) {
                                $files = json_decode($filePath, true);
                                if (is_array($files)) {
                                    foreach ($files as $singlePath) {
                                        Storage::disk('public')->delete($singlePath);
                                    }
                                }
                            } else {
                                Storage::disk('public')->delete($filePath);
                            }
                        }
                    } catch (\Exception $fileException) {
                        \Log::error('Failed to delete file during rollback', [
                            'file_path' => $filePath,
                            'error' => $fileException->getMessage()
                        ]);
                    }
                }
            }

            return back()->with('error', 'Failed to create admission: ' . $e->getMessage())
                        ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $record = HWHAdmission::with('children')->findOrFail($id);
        return view('hwhadmissions.show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $record = HWHAdmission::with('children')->findOrFail($id);
        return view('hwhadmissions.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $admission = HWHAdmission::findOrFail($id);
        
        // Format CNIC for storage before validation
        if ($request->has('cnic') && $request->cnic) {
            $request->merge([
                'cnic' => $this->formatCnicForStorage($request->cnic)
            ]);
        }

        $validator = Validator::make($request->all(), [
            'patient_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|in:male,female,other',
            'cnic' => 'required|regex:/^\d{13}$/|unique:hwh_admissions,cnic,' . $admission->id,
            'phone' => 'required|string|max:15',
            'education' => 'nullable|string|max:255',
            'address' => 'required|string',
            'marital_status' => 'required|in:Single,Married,Widowed,Divorced',
            'spouse_name' => 'nullable|string|max:255',
            'children_count' => 'nullable|integer|min:0',
            'boys_count' => 'nullable|integer|min:0',
            'girls_count' => 'nullable|integer|min:0',
            'religion' => 'nullable|string|max:255',
            'guardian_name' => 'required|string|max:255',
            'guardian_contact' => 'required|string|max:15',
            'relationship' => 'required|string|max:255',
            'guardian_address' => 'required|string',
            'admission_date' => 'required|date',
            'reason' => 'nullable|string',
            'disease_name' => 'required|string|max:255',
            'treatment_details' => 'required|string',
            'case_history' => 'required|string',
            'other_diseases' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fix the validation errors.');
        }

        DB::beginTransaction();

        try {
            $updateData = $request->except(['_token', '_method']);
            
            // Format admission date
            if ($request->has('admission_date') && $request->admission_date) {
                $updateData['admission_date'] = Carbon::parse($request->admission_date)->format('Y-m-d');
            }

            // Handle file updates if provided
            $fileFields = ['id_card_front', 'id_card_back', 'referral_form', 'affidavit'];
            foreach ($fileFields as $field) {
                if ($request->hasFile($field) && $request->file($field)->isValid()) {
                    // Delete old file
                    if ($admission->$field) {
                        Storage::disk('public')->delete($admission->$field);
                    }
                    
                    // Upload new file
                    $file = $request->file($field);
                    $fileName = time() . '_' . $field . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('admissions/' . date('Y/m'), $fileName, 'public');
                    $updateData[$field] = $filePath;
                }
            }

            // Handle multiple file updates
            $multipleFileFields = ['passport_photos', 'medical_reports', 'additional_documents'];
            foreach ($multipleFileFields as $field) {
                if ($request->hasFile($field)) {
                    // Delete old files
                    if ($admission->$field) {
                        $oldFiles = json_decode($admission->$field, true);
                        if (is_array($oldFiles)) {
                            foreach ($oldFiles as $oldFile) {
                                Storage::disk('public')->delete($oldFile);
                            }
                        }
                    }
                    
                    // Upload new files
                    $uploadedFiles = [];
                    foreach ($request->file($field) as $index => $file) {
                        if ($file->isValid()) {
                            $fileName = time() . '_' . $field . '_' . $index . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                            $filePath = $file->storeAs('admissions/' . date('Y/m'), $fileName, 'public');
                            $uploadedFiles[] = $filePath;
                        }
                    }
                    $updateData[$field] = json_encode($uploadedFiles);
                }
            }

            // Update admission
            $admission->update($updateData);

            // Update children if provided
            if ($request->has('children') && is_array($request->children)) {
                // Delete existing children
                Child::where('hwh_admission_id', $admission->id)->delete();
                
                // Create new children records
                foreach ($request->children as $childData) {
                    if (!empty($childData['name']) && !empty($childData['gender'])) {
                        Child::create([
                            'hwh_admission_id' => $admission->id,
                            'name' => $childData['name'],
                            'gender' => $childData['gender'],
                            'age' => $childData['age'] ?? null,
                            'education' => $childData['education'] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('hwhadmissions.show', $admission->id)
                ->with('success', 'Admission updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            \Log::error('Admission update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Failed to update admission: ' . $e->getMessage())
                        ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $admission = HWHAdmission::findOrFail($id);
        
        DB::beginTransaction();
        try {
            // Delete children first
            Child::where('hwh_admission_id', $id)->delete();
            
            // Delete files
            $fileFields = ['id_card_front', 'id_card_back', 'referral_form', 'affidavit'];
            foreach ($fileFields as $field) {
                if ($admission->$field) {
                    Storage::disk('public')->delete($admission->$field);
                }
            }
            
            $arrayFields = ['passport_photos', 'medical_reports', 'additional_documents'];
            foreach ($arrayFields as $field) {
                if ($admission->$field) {
                    $files = json_decode($admission->$field, true);
                    if (is_array($files)) {
                        foreach ($files as $file) {
                            Storage::disk('public')->delete($file);
                        }
                    }
                }
            }
            
            // Delete admission
            $admission->delete();
            
            DB::commit();
            
            return redirect()->route('hwhadmissions.index')
                ->with('success', 'Admission deleted successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Admission deletion failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Failed to delete admission: ' . $e->getMessage());
        }
    }

    /**
     * CNIC Search for auto-fill - FIXED VERSION
     */
    public function searchByCnic(Request $request)
    {
        try {
            $cnic = $request->query('cnic');
            
            if (!$cnic) {
                \Log::error('CNIC search: No CNIC provided');
                return response()->json([
                    'exists' => false,
                    'message' => 'CNIC is required'
                ], 400);
            }

            // Format the search CNIC for storage (remove hyphens)
            $searchCnic = $this->formatCnicForStorage($cnic);
            
            \Log::info('CNIC Search Debug', [
                'original_cnic' => $cnic,
                'formatted_cnic' => $searchCnic,
                'cnic_length' => strlen($searchCnic)
            ]);

            // Check if CNIC is exactly 13 digits
            if (strlen($searchCnic) !== 13) {
                \Log::error('CNIC search: Invalid CNIC length', ['length' => strlen($searchCnic)]);
                return response()->json([
                    'exists' => false,
                    'message' => 'Invalid CNIC format. Must be 13 digits.'
                ], 400);
            }

            // DEBUG: Check what's in the database
            $allCnicInDb = HWHAdmission::pluck('cnic')->toArray();
            \Log::info('All CNIC in database', $allCnicInDb);

            // Check in hwh_admissions table - FIXED QUERY
            $record = HWHAdmission::with('children')
                ->where('cnic', $searchCnic)
                ->first();

            // If not found with exact match, try with like as fallback
            if (!$record) {
                \Log::info('Trying fallback search with LIKE', ['search_cnic' => $searchCnic]);
                $record = HWHAdmission::with('children')
                    ->where('cnic', 'like', '%' . $searchCnic . '%')
                    ->first();
            }

            if ($record) {
                \Log::info('Record found successfully', [
                    'id' => $record->id,
                    'patient_name' => $record->patient_name,
                    'db_cnic' => $record->cnic,
                    'search_cnic' => $searchCnic
                ]);
                
                return response()->json([
                    'exists' => true,
                    'message' => 'Record found in database',
                    'data' => $this->formatAdmissionData($record),
                    'source' => 'permanent'
                ]);
            }

            \Log::info('No record found for CNIC', [
                'search_cnic' => $searchCnic,
                'all_db_cnic' => $allCnicInDb
            ]);
            
            return response()->json([
                'exists' => false,
                'message' => 'No record found for this CNIC'
            ]);

        } catch (\Exception $e) {
            \Log::error('CNIC Search Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input_cnic' => $request->query('cnic')
            ]);
            
            return response()->json([
                'exists' => false,
                'message' => 'Error searching for CNIC: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Format admission data for auto-fill - IMPROVED VERSION
     */
    private function formatAdmissionData($record)
    {
        $data = [
            'patient_name' => $record->patient_name ?? '',
            'father_name' => $record->father_name ?? '',
            'age' => $record->age ?? '',
            'gender' => $record->gender ?? '',
            'cnic' => $this->formatCnicForDisplay($record->cnic) ?? '',
            'phone' => $record->phone ?? '',
            'education' => $record->education ?? '',
            'address' => $record->address ?? '',
            'marital_status' => $record->marital_status ?? '',
            'spouse_name' => $record->spouse_name ?? '',
            'children_count' => $record->children_count ?? 0,
            'boys_count' => $record->boys_count ?? 0,
            'girls_count' => $record->girls_count ?? 0,
            'religion' => $record->religion ?? '',
            'guardian_name' => $record->guardian_name ?? '',
            'guardian_contact' => $record->guardian_contact ?? '',
            'relationship' => $record->relationship ?? '',
            'guardian_address' => $record->guardian_address ?? '',
            'admission_date' => $record->admission_date ? Carbon::parse($record->admission_date)->format('Y-m-d') : '',
            'reason' => $record->reason ?? '',
            'disease_name' => $record->disease_name ?? '',
            'treatment_details' => $record->treatment_details ?? '',
            'case_history' => $record->case_history ?? '',
            'other_diseases' => $record->other_diseases ?? '',
        ];

        // Include children data if exists
        if ($record->children && $record->children->count() > 0) {
            $data['children'] = $record->children->map(function($child) {
                return [
                    'name' => $child->name ?? '',
                    'gender' => $child->gender ?? '',
                    'age' => $child->age ?? '',
                    'education' => $child->education ?? ''
                ];
            })->toArray();
        } else {
            $data['children'] = [];
        }

        // Include attachment information for existing records
        $attachmentFields = ['id_card_front', 'id_card_back', 'passport_photos', 'medical_reports', 'referral_form', 'affidavit', 'additional_documents'];
        foreach ($attachmentFields as $field) {
            if ($record->$field) {
                $data[$field] = $record->$field;
                
                // Create preview data for attachments
                if (in_array($field, ['passport_photos', 'medical_reports', 'additional_documents'])) {
                    $files = json_decode($record->$field, true);
                    if (is_array($files)) {
                        $data[$field . '_count'] = count($files);
                        $data[$field . '_previews'] = array_map(function($filePath) {
                            return [
                                'url' => Storage::disk('public')->url($filePath),
                                'name' => basename($filePath)
                            ];
                        }, $files);
                    }
                } else {
                    $data[$field . '_preview'] = [
                        'url' => Storage::disk('public')->url($record->$field),
                        'name' => basename($record->$field)
                    ];
                }
            }
        }

        return $data;
    }

    /**
     * Show attachment file
     */
    public function showAttachment($id, $field)
    {
        $admission = HWHAdmission::findOrFail($id);
        
        if (!in_array($field, ['id_card_front', 'id_card_back', 'referral_form', 'affidavit', 'passport_photos', 'medical_reports', 'additional_documents'])) {
            abort(404);
        }

        $filePath = $admission->$field;
        
        if (!$filePath) {
            abort(404);
        }

        if (in_array($field, ['passport_photos', 'medical_reports', 'additional_documents'])) {
            // For array fields, take the first file
            $files = json_decode($filePath, true);
            if (is_array($files) && count($files) > 0) {
                $filePath = $files[0];
            } else {
                abort(404);
            }
        }

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404);
        }

        return response()->file(Storage::disk('public')->path($filePath));
    }
}