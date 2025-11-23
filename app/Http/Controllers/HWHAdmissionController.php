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

class HwhAdmissionController extends Controller
{
    /**
     * Format CNIC for display (add hyphens)
     */
    private function formatCnicForDisplay($cnic)
    {
        if (!$cnic || strlen($cnic) !== 13) {
            return $cnic;
        }
        
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
        
        return preg_replace('/[^0-9]/', '', $cnic);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = HWHAdmission::query();
        
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
        \Log::info('=== FORM SUBMISSION STARTED ===');
        \Log::info('All request data:', $request->all());

        // DEBUG: Log all incoming data
        \Log::info('Files received:', $request->allFiles());
        \Log::info('Children data:', $request->children ?? []);

        // STEP 1: First validate with original CNIC format
        $validator = Validator::make($request->all(), [
            // Personal Information
            'patient_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|in:male,female,other',
            'cnic' => 'required|string|max:20', // Temporary larger size for formatted CNIC
            'phone' => 'required|string|max:15',
            'education' => 'nullable|string|max:255',
            'address' => 'required|string',
            
            // Family Information
            'marital_status' => 'required|in:Single,Married,Widowed,Divorced',
            'spouse_name' => 'nullable|string|max:255',
            'children_count' => 'nullable|integer|min:0',
            'boys_count' => 'nullable|integer|min:0',
            'girls_count' => 'nullable|integer|min:0',
            'religion' => 'nullable|string|max:255',
            
            // Guardian Information
            'guardian_name' => 'required|string|max:255',
            'guardian_contact' => 'required|string|max:15',
            'relationship' => 'required|string|max:255',
            'guardian_address' => 'required|string',
            
            // Medical Information
            'admission_date' => 'required|date',
            'reason' => 'nullable|string',
            'disease_name' => 'required|string|max:255',
            'treatment_details' => 'required|string',
            'case_history' => 'required|string',
            'other_diseases' => 'nullable|string',
            
            // File Validations - MORE FLEXIBLE
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
            
            // Children Data
            'children' => 'nullable|array',
            'children.*.name' => 'required_with:children|string|max:255',
            'children.*.gender' => 'required_with:children|in:male,female',
            'children.*.age' => 'nullable|integer|min:0|max:25',
        ], [
            'cnic.unique' => 'This CNIC is already registered in the system.',
            'id_card_front.required' => 'ID Card Front copy is required',
            'id_card_back.required' => 'ID Card Back copy is required',
            'passport_photos.required' => 'At least one passport photo is required',
            'medical_reports.required' => 'At least one medical report is required',
            'referral_form.required' => 'Referral form is required',
            'children.*.name.required_with' => 'Child name is required',
            'children.*.gender.required_with' => 'Child gender is required',
        ]);

        if ($validator->fails()) {
            \Log::error('VALIDATION FAILED:', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fix the validation errors below.');
        }

        \Log::info('Validation passed, formatting CNIC...');

        // STEP 2: Format CNIC for storage and check uniqueness
        $originalCnic = $request->cnic;
        $formattedCnic = $this->formatCnicForStorage($request->cnic);
        
        // Check if CNIC is already registered (with formatted CNIC)
        $existingRecord = HWHAdmission::where('cnic', $formattedCnic)->first();
        if ($existingRecord) {
            \Log::error('CNIC already exists: ' . $formattedCnic);
            return redirect()->back()
                ->withErrors(['cnic' => 'This CNIC is already registered in the system.'])
                ->withInput()
                ->with('error', 'This CNIC is already registered.');
        }

        $request->merge(['cnic' => $formattedCnic]);
        \Log::info('CNIC formatted: ' . $originalCnic . ' -> ' . $formattedCnic);

        DB::beginTransaction();

        try {
            // Prepare basic admission data
            $admissionData = [
                'patient_name' => $request->patient_name,
                'father_name' => $request->father_name,
                'age' => $request->age,
                'gender' => $request->gender,
                'cnic' => $formattedCnic,
                'phone' => $request->phone,
                'education' => $request->education,
                'address' => $request->address,
                'marital_status' => $request->marital_status,
                'spouse_name' => $request->spouse_name,
                'children_count' => $request->children_count ?? 0,
                'boys_count' => $request->boys_count ?? 0,
                'girls_count' => $request->girls_count ?? 0,
                'religion' => $request->religion,
                'guardian_name' => $request->guardian_name,
                'guardian_contact' => $request->guardian_contact,
                'relationship' => $request->relationship,
                'guardian_address' => $request->guardian_address,
                'admission_date' => $request->admission_date,
                'reason' => $request->reason,
                'disease_name' => $request->disease_name,
                'treatment_details' => $request->treatment_details,
                'case_history' => $request->case_history,
                'other_diseases' => $request->other_diseases,
                'incharge_id' => $request->incharge_id,
                'status' => 'active',
                'reference_id' => 'HWH-' . date('Ymd') . '-' . strtoupper(Str::random(6)),
            ];

            \Log::info('Admission data prepared:', $admissionData);

            // Handle file uploads
            $filePaths = [];
            
            // Single file uploads
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
                    \Log::info("File uploaded: {$field} -> {$filePath}");
                } else {
                    \Log::warning("File upload failed or not provided for: {$field}");
                }
            }

            // Multiple file uploads
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
                            \Log::info("Multiple file uploaded: {$field}[{$index}] -> {$filePath}");
                        } else {
                            \Log::warning("Multiple file upload failed for: {$field}[{$index}]");
                        }
                    }
                    if (!empty($uploadedFiles)) {
                        $filePaths[$field] = json_encode($uploadedFiles);
                    } else {
                        \Log::warning("No valid files uploaded for: {$field}");
                    }
                } else {
                    \Log::warning("No files provided for: {$field}");
                }
            }

            // Check if required files are present
            $requiredFiles = ['id_card_front', 'id_card_back', 'passport_photos', 'medical_reports', 'referral_form'];
            foreach ($requiredFiles as $requiredFile) {
                if (!isset($filePaths[$requiredFile])) {
                    throw new \Exception("Required file {$requiredFile} is missing or invalid.");
                }
            }

            // Merge file paths with admission data
            $admissionData = array_merge($admissionData, $filePaths);
            \Log::info('Final admission data with files:', $admissionData);

            // CREATE THE ADMISSION RECORD
            $admission = HWHAdmission::create($admissionData);
            \Log::info('Admission record created successfully. ID: ' . $admission->id);

            // Handle children data
            if ($request->has('children') && is_array($request->children)) {
                $childrenCreated = 0;
                foreach ($request->children as $childData) {
                    if (!empty($childData['name']) && !empty($childData['gender'])) {
                        Child::create([
                            'hwh_admission_id' => $admission->id,
                            'name' => $childData['name'],
                            'gender' => $childData['gender'],
                            'age' => $childData['age'] ?? null,
                            'education' => $childData['education'] ?? null,
                        ]);
                        $childrenCreated++;
                        \Log::info("Child created: {$childData['name']}");
                    }
                }
                \Log::info("Total children records created: {$childrenCreated}");
            }

            // Remove from incharge list if applicable
            if ($request->has('incharge_id') && $request->incharge_id) {
                $incharge = Incharge::find($request->incharge_id);
                if ($incharge) {
                    $incharge->delete();
                    \Log::info('Removed from incharge list. Incharge ID: ' . $request->incharge_id);
                }
            }

            DB::commit();
            \Log::info('=== TRANSACTION COMMITTED SUCCESSFULLY ===');
            \Log::info('Admission created with Reference ID: ' . $admission->reference_id);

            return redirect()->route('hwhadmissions.index')
                ->with('success', 'Admission created successfully! Reference ID: ' . $admission->reference_id)
                ->with('reference_id', $admission->reference_id);

        } catch (\Exception $e) {
            DB::rollBack();
            
            \Log::error('ADMISSION CREATION FAILED:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            // Clean up uploaded files if any
            if (isset($filePaths) && !empty($filePaths)) {
                foreach ($filePaths as $filePath) {
                    try {
                        if (is_string($filePath)) {
                            // Check if it's JSON encoded array
                            if (str_starts_with($filePath, '[')) {
                                $files = json_decode($filePath, true);
                                if (is_array($files)) {
                                    foreach ($files as $singlePath) {
                                        if (Storage::disk('public')->exists($singlePath)) {
                                            Storage::disk('public')->delete($singlePath);
                                        }
                                    }
                                }
                            } else {
                                // Single file path
                                if (Storage::disk('public')->exists($filePath)) {
                                    Storage::disk('public')->delete($filePath);
                                }
                            }
                        }
                    } catch (\Exception $fileException) {
                        \Log::error('File cleanup failed: ' . $fileException->getMessage());
                    }
                }
            }

            return back()
                ->with('error', 'Failed to create admission: ' . $e->getMessage())
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
        
        // Format CNIC for storage
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
            'cnic' => 'required|string|max:15|unique:hwh_admissions,cnic,' . $admission->id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'marital_status' => 'required|in:Single,Married,Widowed,Divorced',
            'guardian_name' => 'required|string|max:255',
            'guardian_contact' => 'required|string|max:15',
            'relationship' => 'required|string|max:255',
            'guardian_address' => 'required|string',
            'admission_date' => 'required|date',
            'disease_name' => 'required|string|max:255',
            'treatment_details' => 'required|string',
            'case_history' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fix the validation errors.');
        }

        DB::beginTransaction();

        try {
            $updateData = $request->except(['_token', '_method', 'children']);
            
            $updateData['admission_date'] = Carbon::parse($request->admission_date)->format('Y-m-d');

            // Handle file updates
            $fileFields = ['id_card_front', 'id_card_back', 'referral_form', 'affidavit'];
            foreach ($fileFields as $field) {
                if ($request->hasFile($field) && $request->file($field)->isValid()) {
                    // Delete old file if exists
                    if ($admission->$field) {
                        Storage::disk('public')->delete($admission->$field);
                    }
                    
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
                    // Delete old files if exist
                    if ($admission->$field) {
                        $oldFiles = json_decode($admission->$field, true);
                        if (is_array($oldFiles)) {
                            foreach ($oldFiles as $oldFile) {
                                Storage::disk('public')->delete($oldFile);
                            }
                        }
                    }
                    
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

            $admission->update($updateData);

            // Update children data
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
            
            \Log::error('Admission update failed: ' . $e->getMessage());

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
            // Delete children records
            Child::where('hwh_admission_id', $id)->delete();
            
            // Delete single files
            $fileFields = ['id_card_front', 'id_card_back', 'referral_form', 'affidavit'];
            foreach ($fileFields as $field) {
                if ($admission->$field) {
                    Storage::disk('public')->delete($admission->$field);
                }
            }
            
            // Delete multiple files
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
            
            $admission->delete();
            
            DB::commit();
            
            return redirect()->route('hwhadmissions.index')
                ->with('success', 'Admission deleted successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Admission deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete admission: ' . $e->getMessage());
        }
    }

    /**
     * CNIC Search for auto-fill
     */
    public function searchByCnic(Request $request)
    {
        try {
            $cnic = $request->query('cnic');
            
            if (!$cnic) {
                return response()->json([
                    'exists' => false,
                    'message' => 'CNIC is required'
                ], 400);
            }

            $searchCnic = $this->formatCnicForStorage($cnic);
            
            $record = HWHAdmission::with('children')
                ->where('cnic', $searchCnic)
                ->first();

            if ($record) {
                return response()->json([
                    'exists' => true,
                    'message' => 'Record found in database',
                    'data' => $this->formatAdmissionData($record),
                    'source' => 'permanent'
                ]);
            }
            
            return response()->json([
                'exists' => false,
                'message' => 'No record found for this CNIC'
            ]);

        } catch (\Exception $e) {
            \Log::error('CNIC Search Error: ' . $e->getMessage());
            
            return response()->json([
                'exists' => false,
                'message' => 'Error searching for CNIC: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Format admission data for auto-fill
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

        // Add children data
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

        return $data;
    }
}