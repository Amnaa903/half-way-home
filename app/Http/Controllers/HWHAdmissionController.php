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
    private function formatCnicForDisplay($cnic)
    {
        if (!$cnic || strlen($cnic) !== 13) {
            return $cnic;
        }
        return substr($cnic, 0, 5) . '-' . substr($cnic, 5, 7) . '-' . substr($cnic, 12, 1);
    }

    private function formatCnicForStorage($cnic)
    {
        if (!$cnic) return null;
        return preg_replace('/[^0-9]/', '', $cnic);
    }

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

        $hwhadmissions = $query->with('children')->orderBy('created_at', 'desc')->paginate(10);
        return view('hwhadmissions.index', compact('hwhadmissions'));
    }

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

    public function store(Request $request)
    {
        \Log::info('=== HWH ADMISSION FORM SUBMISSION STARTED ===', $request->all());

        $validator = Validator::make($request->all(), [
            'patient_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|in:male,female,other',
            'cnic' => 'required|string|regex:/^\d{5}-\d{7}-\d{1}$/|unique:hwh_admissions,cnic',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',

            'guardian_name' => 'required|string|max:255',
            'guardian_contact' => 'required|string|max:15',
            'relationship' => 'required|string|max:255',
            'guardian_address' => 'required|string',

            'admission_date' => 'required|date',
            'disease_name' => 'required|string|max:255',
            'treatment_details' => 'required|string',
            'case_history' => 'required|string',

            'id_card_front' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'id_card_back' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'referral_form' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'cnic.unique' => 'This CNIC is already registered.',
            'cnic.regex' => 'CNIC must be in format: 12345-1234567-1',
            'id_card_front.required' => 'ID Card Front is required',
            'id_card_back.required' => 'ID Card Back is required',
            'referral_form.required' => 'Referral form is required',
        ]);

        if ($validator->fails()) {
            \Log::error('Validation failed', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fix the errors below.');
        }

        // Format CNIC
        $originalCnic = $request->cnic;
        $formattedCnic = $this->formatCnicForStorage($request->cnic);

        // Double-check duplicate CNIC
        if (HWHAdmission::where('cnic', $formattedCnic)->exists()) {
            return redirect()->back()
                ->withErrors(['cnic' => 'This CNIC is already registered in the system.'])
                ->withInput()
                ->with('error', 'Duplicate CNIC detected.');
        }

        \Log::info('CNIC formatted', ['original' => $originalCnic, 'clean' => $formattedCnic]);

        DB::beginTransaction();

        try {
            $admissionData = [
                'patient_name' => $request->patient_name,
                'father_name' => $request->father_name,
                'age' => $request->age,
                'gender' => $request->gender,
                'cnic' => $formattedCnic,
                'phone' => $request->phone,
                'education' => $request->education ?? null,
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

            // Handle Required Files
            $requiredFiles = ['id_card_front', 'id_card_back', 'referral_form'];
            foreach ($requiredFiles as $field) {
                if (!$request->hasFile($field) || !$request->file($field)->isValid()) {
                    throw new \Exception("Required file missing: $field");
                }
                $file = $request->file($field);
                $fileName = time() . "_{$field}_" . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('admissions', $fileName, 'public');
                $admissionData[$field] = $path;
                \Log::info("Uploaded: $field → $path");
            }

            // Handle Optional Files
            $optionalSingle = ['affidavit'];
            foreach ($optionalSingle as $field) {
                if ($request->hasFile($field) && $request->file($field)->isValid()) {
                    $file = $request->file($field);
                    $fileName = time() . "_{$field}_" . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('admissions', $fileName, 'public');
                    $admissionData[$field] = $path;
                }
            }

            // Handle Multiple Files
            $multipleFiles = ['passport_photos', 'medical_reports', 'additional_documents'];
            foreach ($multipleFiles as $field) {
                if ($request->hasFile($field)) {
                    $paths = [];
                    foreach ($request->file($field) as $index => $file) {
                        if ($file->isValid()) {
                            $fileName = time() . "_{$field}_{$index}_" . uniqid() . '.' . $file->getClientOriginalExtension();
                            $path = $file->storeAs('admissions', $fileName, 'public');
                            $paths[] = $path;
                        }
                    }
                    if (!empty($paths)) {
                        $admissionData[$field] = json_encode($paths);
                    }
                }
            }

            // Create Admission
            $admission = HWHAdmission::create($admissionData);
            \Log::info('Admission created', ['id' => $admission->id, 'ref' => $admission->reference_id]);

            // Save Children
            if ($request->has('children') && is_array($request->children)) {
                foreach ($request->children as $child) {
                    if (!empty($child['name']) && !empty($child['gender'])) {
                        Child::create([
                            'hwh_admission_id' => $admission->id,
                            'name' => $child['name'],
                            'gender' => $child['gender'],
                            'age' => $child['age'] ?? null,
                        ]);
                    }
                }
            }

            // Remove from Incharge pending list
            if ($request->incharge_id) {
                Incharge::find($request->incharge_id)?->delete();
            }

            DB::commit();

            return redirect()->route('hwhadmissions.index')
                ->with('success', 'Admission created successfully!')
                ->with('reference_id', $admission->reference_id);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Admission failed', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);

            return back()
                ->with('error', 'Failed to save admission: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $record = HWHAdmission::with('children')->findOrFail($id);
        return view('hwhadmissions.show', compact('record'));
    }

    public function edit($id)
    {
        $record = HWHAdmission::with('children')->findOrFail($id);
        return view('hwhadmissions.edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $admission = HWHAdmission::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'patient_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|in:male,female,other',
            'cnic' => 'required|string|regex:/^\d{5}-\d{7}-\d{1}$/|unique:hwh_admissions,cnic,' . $admission->id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
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
                ->withInput();
        }

        DB::beginTransaction();

        try {
            $formattedCnic = $this->formatCnicForStorage($request->cnic);

            $updateData = [
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
            ];

            // Handle file updates if needed
            $admission->update($updateData);

            // Update children
            if ($request->has('children')) {
                // Delete existing children
                Child::where('hwh_admission_id', $admission->id)->delete();
                
                // Add new children
                foreach ($request->children as $child) {
                    if (!empty($child['name']) && !empty($child['gender'])) {
                        Child::create([
                            'hwh_admission_id' => $admission->id,
                            'name' => $child['name'],
                            'gender' => $child['gender'],
                            'age' => $child['age'] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('hwhadmissions.show', $admission->id)
                ->with('success', 'Admission updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update admission: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $admission = HWHAdmission::findOrFail($id);
            
            // Delete associated children
            Child::where('hwh_admission_id', $admission->id)->delete();
            
            // Delete admission
            $admission->delete();
            
            DB::commit();
            
            return redirect()->route('hwhadmissions.index')
                ->with('success', 'Admission deleted successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete admission: ' . $e->getMessage());
        }
    }

    public function searchByCnic(Request $request)
    {
        try {
            $cnic = $request->query('cnic');
            if (!$cnic) {
                return response()->json(['exists' => false, 'message' => 'CNIC required'], 400);
            }

            $cleanCnic = $this->formatCnicForStorage($cnic);
            $record = HWHAdmission::with('children')->where('cnic', $cleanCnic)->first();

            if ($record) {
                return response()->json([
                    'exists' => true,
                    'message' => 'Record found',
                    'data' => $this->formatAdmissionData($record),
                    'source' => 'permanent'
                ]);
            }

            return response()->json(['exists' => false, 'message' => 'No record found']);
        } catch (\Exception $e) {
            \Log::error('CNIC Search Error: ' . $e->getMessage());
            return response()->json(['exists' => false, 'message' => 'Search error'], 500);
        }
    }

    private function formatAdmissionData($record)
    {
        return [
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
            'children' => $record->children ? $record->children->map(function($c) {
                return ['name' => $c->name, 'gender' => $c->gender, 'age' => $c->age];
            })->toArray() : [],
        ];
    }

    // ==================== DISCHARGE METHODS - ADDED AT THE END ====================

    /**
     * Display discharge index page
     */
    public function dischargeIndex()
    {
        $activeAdmissions = HWHAdmission::where('status', 'active')
                        ->orderBy('patient_name')
                        ->paginate(10);
        
        return view('hwh-discharges.index', compact('activeAdmissions'));
    }

    /**
     * Show discharge creation form
     */
    public function dischargeCreate($id)
    {
        $admission = HWHAdmission::with('children')->findOrFail($id);
        
        if ($admission->status !== 'active') {
            return redirect()->route('hwhadmissions.discharges.index')
                ->with('error', 'This patient is not currently admitted.');
        }
        
        // Check if this is coming from pending discharges
        $pendingDischarge = null;
        
        return view('hwh-discharges.create', compact('admission', 'pendingDischarge'));
    }

    /**
     * Store discharge data - FIXED VERSION
     */
    public function dischargeStore(Request $request)
    {
        \Log::info('🎯 === DISCHARGE FORM SUBMISSION STARTED ===', $request->all());

        try {
            // Get admission ID from any possible field name
            $admissionId = $request->hwh_admission_id ?? $request->admission_id ?? $request->input('admission_id');
            
            \Log::info('Looking for admission ID:', ['provided_id' => $admissionId]);

            if (!$admissionId) {
                throw new \Exception('Admission ID is required.');
            }

            // Find the admission
            $admission = HWHAdmission::find($admissionId);
            
            if (!$admission) {
                throw new \Exception('Patient record not found.');
            }

            \Log::info('Found admission', [
                'id' => $admission->id,
                'patient_name' => $admission->patient_name,
                'status' => $admission->status
            ]);

            if ($admission->status !== 'active') {
                throw new \Exception('This patient is not currently admitted.');
            }

            // Basic validation
            if (!$request->discharge_date) {
                throw new \Exception('Discharge date is required.');
            }

            if (!$request->discharge_reason) {
                throw new \Exception('Discharge reason is required.');
            }

            // Check if discharge date is not in future
            $dischargeDate = Carbon::parse($request->discharge_date);
            if ($dischargeDate->isFuture()) {
                throw new \Exception('Discharge date cannot be in the future.');
            }

            DB::beginTransaction();

            // Update admission status to discharged
            $admission->update([
                'discharge_date' => $request->discharge_date,
                'discharge_reason' => $request->discharge_reason,
                'discharge_summary' => $request->discharge_notes ?? $request->discharge_summary,
                'follow_up_instructions' => $request->follow_up_instructions,
                'status' => 'discharged',
            ]);

            \Log::info('✅ Admission discharged successfully', [
                'admission_id' => $admission->id,
                'patient_name' => $admission->patient_name,
                'discharge_date' => $request->discharge_date
            ]);

            DB::commit();

            return redirect()->route('hwhadmissions.discharges.discharged-list')
                ->with('success', 'Patient discharged successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('❌ Discharge failed', ['error' => $e->getMessage()]);
            return back()
                ->with('error', 'Failed to discharge patient: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display discharged patients list
     */
    public function dischargedList()
    {
        $dischargedAdmissions = HWHAdmission::where('status', 'discharged')
                            ->orderBy('discharge_date', 'desc')
                            ->paginate(10);
        
        return view('hwh-discharges.discharged-list', compact('dischargedAdmissions'));
    }

    /**
     * Reverse discharge (readmit patient)
     */
    public function reverseDischarge($id)
    {
        DB::beginTransaction();

        try {
            $admission = HWHAdmission::findOrFail($id);
            
            if ($admission->status !== 'discharged') {
                throw new \Exception('This patient is not discharged.');
            }

            $admission->update([
                'discharge_date' => null,
                'discharge_reason' => null,
                'discharge_summary' => null,
                'follow_up_instructions' => null,
                'status' => 'active',
            ]);

            DB::commit();

            return redirect()->route('hwhadmissions.discharges.discharged-list')
                ->with('success', 'Patient readmitted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to readmit patient: ' . $e->getMessage());
        }
    }
}