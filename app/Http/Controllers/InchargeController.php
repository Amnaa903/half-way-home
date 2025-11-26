<?php

namespace App\Http\Controllers;

use App\Models\Incharge;
use App\Models\PendingDischarge;
use App\Models\User;
use App\Models\HWHAdmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class InchargeController extends Controller
{
    // ==================== DASHBOARD METHOD ====================
    
    public function dashboard()
    {
        $user = Auth::user();
        
        $stats = [
            'total_residents' => Incharge::where('user_district', $user->district)->count(),
            'pending_registration' => Incharge::where('user_district', $user->district)->count(),
            'pending_discharge' => PendingDischarge::where('user_district', $user->district)->where('status', 'pending')->count(),
            'today_tasks' => Incharge::where('user_district', $user->district)
                            ->whereDate('created_at', today())
                            ->count()
        ];
        
        return view('incharge_dashboard', compact('stats'));
    }

    // ==================== REGISTRATION SYSTEM METHODS ====================

    /**
     * Show registration form - ✅ ADDED THIS METHOD
     */
    public function createRegistration()
    {
        Log::info('🟢 CREATE REGISTRATION PAGE ACCESSED');
        return view('incharge.create_registration');
    }

    /**
     * Store registration data - WORKING VERSION
     */
    public function storeRegistration(Request $request)
    {
        Log::info('🎯 === STORE REGISTRATION START ===');
        
        $user = Auth::user();
        Log::info('👤 User:', [
            'id' => $user->id, 
            'name' => $user->name, 
            'district' => $user->district
        ]);

        try {
            // Simple validation
            $request->validate([
                'rname.*' => 'required',
                'reg_date.*' => 'required|date',
                'rcnic.*' => 'required'
            ]);

            $savedCount = 0;
            $savedRecords = [];

            foreach($request->rname as $index => $name) {
                if (!empty($name) && !empty($request->reg_date[$index]) && !empty($request->rcnic[$index])) {
                    
                    $cleanCnic = preg_replace('/[^0-9]/', '', $request->rcnic[$index]);
                    
                    // Check duplicate
                    $existing = Incharge::where('rcnic', $cleanCnic)->first();
                    if ($existing) {
                        Log::warning("⚠️ DUPLICATE CNIC: {$cleanCnic}");
                        continue;
                    }

                    // Create record
                    $incharge = Incharge::create([
                        'user_id' => $user->id,
                        'user_district' => $user->district,
                        'rname' => trim($name),
                        'reg_date' => $request->reg_date[$index],
                        'rcnic' => $cleanCnic,
                    ]);

                    $savedCount++;
                    $savedRecords[] = [
                        'name' => $name,
                        'cnic' => $cleanCnic,
                        'district' => $user->district
                    ];

                    Log::info("✅ SAVED: {$name} - {$cleanCnic} in {$user->district}");
                }
            }

            Log::info("🎉 STORE COMPLETE: {$savedCount} records saved", $savedRecords);

            if ($savedCount > 0) {
                return redirect()->route('incharge.registration.list')
                    ->with('success', $savedCount . ' registration(s) created successfully!');
            } else {
                return redirect()->route('incharge.create.registration')
                    ->with('error', 'No registrations were saved. Please check for duplicates.')
                    ->withInput();
            }

        } catch (\Exception $e) {
            Log::error('❌ STORE ERROR: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display registration list - FIXED VERSION
     */
    public function registrationList()
    {
        $user = Auth::user();
        
        Log::info('📋 REGISTRATION LIST ACCESSED', [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_district' => $user->district,
            'user_role' => $user->role
        ]);

        // ✅ DEBUG: Check ALL data in database
        $allIncharges = Incharge::all();
        Log::info('🗃️ ALL INCHARGES IN DATABASE:', [
            'total_count' => $allIncharges->count(),
            'data' => $allIncharges->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->rname,
                    'cnic' => $item->rcnic,
                    'district' => $item->user_district,
                    'user_id' => $item->user_id,
                    'created_at' => $item->created_at
                ];
            })->toArray()
        ]);

        // ✅ Get data for current user's district
        $incharges = Incharge::where('user_district', $user->district)
                        ->orderBy('created_at', 'desc')
                        ->get();

        Log::info('🎯 FILTERED INCHARGES FOR USER DISTRICT:', [
            'user_district' => $user->district,
            'filtered_count' => $incharges->count(),
            'filtered_data' => $incharges->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->rname,
                    'cnic' => $item->rcnic
                ];
            })->toArray()
        ]);

        return view('incharge.registration_list', compact('incharges', 'user'));
    }

    /**
     * DEO Pending Registration List - FIXED VERSION
     */
    public function deoPendingRegistration()
    {
        $user = Auth::user();
        
        Log::info('👨‍💼 DEO PENDING REGISTRATION ACCESSED', [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => $user->role
        ]);

        // ✅ Get ALL incharges for DEO (no district filter)
        $incharges = Incharge::with('user')
                        ->orderBy('created_at', 'desc')
                        ->get();

        Log::info('🌐 DEO ALL INCHARGES:', [
            'total_count' => $incharges->count(),
            'data' => $incharges->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->rname,
                    'cnic' => $item->rcnic,
                    'district' => $item->user_district,
                    'user_name' => $item->user->name ?? 'N/A'
                ];
            })->toArray()
        ]);

        return view('deo.pending_registration', compact('incharges'));
    }

    // ==================== OTHER REQUIRED METHODS ====================

    /**
     * Get registration data for editing - ✅ ADDED
     */
    public function getRegistrationData($id)
    {
        $incharge = Incharge::find($id);
        
        if ($incharge && $incharge->user_district === Auth::user()->district) {
            return response()->json([
                'success' => true,
                'registration' => $incharge
            ]);
        }
        
        return response()->json(['success' => false]);
    }

    /**
     * Update registration data - ✅ ADDED
     */
    public function updateRegistration(Request $request, $id)
    {
        $user = Auth::user();
        $incharge = Incharge::find($id);
        
        if ($incharge && $incharge->user_district === $user->district) {
            $request->validate([
                'rname' => 'required|string|max:255',
                'reg_date' => 'required|date',
                'rcnic' => 'required|string|max:15'
            ]);
            
            $incharge->update([
                'rname' => $request->rname,
                'reg_date' => $request->reg_date,
                'rcnic' => preg_replace('/[^0-9]/', '', $request->rcnic)
            ]);
            
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false]);
    }

    /**
     * Delete registration entry - ✅ ADDED
     */
    public function destroyRegistration($id)
    {
        $user = Auth::user();
        $incharge = Incharge::find($id);
        
        if ($incharge && $incharge->user_district === $user->district) {
            $deletedName = $incharge->rname;
            $incharge->delete();
            return redirect()->route('incharge.registration.list')
                ->with('success', "Registration for {$deletedName} deleted successfully");
        }
        
        return redirect()->route('incharge.registration.list')
            ->with('error', 'Record not found or access denied');
    }

    /**
     * Bulk delete registrations - ✅ ADDED
     */
    public function bulkDeleteRegistration(Request $request)
    {
        $user = Auth::user();
        $ids = $request->input('selected_ids', []);
        
        if (empty($ids)) {
            return redirect()->route('incharge.registration.list')
                ->with('error', 'No registrations selected for deletion.');
        }
        
        $deletedCount = Incharge::where('user_district', $user->district)
                            ->whereIn('id', $ids)
                            ->delete();
        
        if ($deletedCount > 0) {
            return redirect()->route('incharge.registration.list')
                ->with('success', "{$deletedCount} registration(s) deleted successfully.");
        }
        
        return redirect()->route('incharge.registration.list')
            ->with('error', 'No registrations were deleted.');
    }

    /**
     * Export registrations - ✅ ADDED
     */
    public function exportRegistrations()
    {
        $user = Auth::user();
        $incharges = Incharge::where('user_district', $user->district)->get();
        
        // You can implement CSV or Excel export here
        // For now, just return success message
        return redirect()->route('incharge.registration.list')
            ->with('success', 'Export functionality will be implemented soon.');
    }

    /**
     * DEO Delete Registration - ✅ ADDED
     */
    public function deoDestroyRegistration($id)
    {
        $incharge = Incharge::find($id);
        
        if ($incharge) {
            $deletedName = $incharge->rname;
            $incharge->delete();
            return redirect()->route('deo.pending.registration')
                ->with('success', "Registration for {$deletedName} deleted successfully");
        }
        
        return redirect()->route('deo.pending.registration')
            ->with('error', 'Record not found');
    }

    /**
     * DEO Approve Registration - ✅ ADDED
     */
    public function deoApproveRegistration($id)
    {
        $incharge = Incharge::find($id);
        
        if ($incharge) {
            $approvedName = $incharge->rname;
            $incharge->delete();
            return redirect()->route('deo.pending.registration')
                ->with('success', "Registration for {$approvedName} approved successfully");
        }
        
        return redirect()->route('deo.pending.registration')
            ->with('error', 'Record not found');
    }

    /**
     * DEO Registration Details - ✅ ADDED
     */
    public function deoRegistrationDetails($id)
    {
        $incharge = Incharge::with('user')->find($id);
        
        if ($incharge) {
            return response()->json([
                'id' => $incharge->id,
                'rname' => $incharge->rname,
                'rcnic' => $incharge->rcnic,
                'reg_date' => $incharge->reg_date,
                'user_district' => $incharge->user_district,
                'user_name' => $incharge->user->name ?? 'N/A',
                'created_at' => $incharge->created_at->format('d-m-Y H:i')
            ]);
        }
        
        return response()->json(['error' => 'Record not found'], 404);
    }

    // ==================== COMPATIBILITY METHODS ====================

    /**
     * Index method for old route - ✅ ADDED
     */
    public function index()
    {
        $user = Auth::user();
        $incharges = Incharge::where('user_district', $user->district)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('admissions.registerlist', compact('incharges', 'user'));
    }

    /**
     * Create method for old route - ✅ ADDED
     */
    public function create()
    {
        return view('admissions.preregister');
    }

    /**
     * Store method for old route - ✅ ADDED
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'rname.*' => 'required',
            'reg_date.*' => 'required|date',
            'rcnic.*' => 'required',
        ]);
        
        $savedCount = 0;
        if(count($request->rname) > 0) {
            foreach($request->rname as $index => $name) {
                if (!empty($name) && !empty($request->reg_date[$index]) && !empty($request->rcnic[$index])) {
                    $cleanCnic = preg_replace('/[^0-9]/', '', $request->rcnic[$index]);
                    
                    // Check for duplicate CNIC
                    $existing = Incharge::where('rcnic', $cleanCnic)->first();
                    if (!$existing) {
                        Incharge::create([
                            'user_id' => $user->id,
                            'user_district' => $user->district,
                            'rname' => $name,
                            'reg_date' => $request->reg_date[$index],
                            'rcnic' => $cleanCnic,
                        ]);
                        $savedCount++;
                    }
                }
            }
        }
        
        if ($savedCount > 0) {
            return redirect()->route('incharge.admissions.registerlist')->with('success', $savedCount . ' registration(s) created successfully!');
        } else {
            return redirect()->route('incharge.admissions.registerlist')->with('error', 'No registrations were saved. Please check for duplicates.');
        }
    }

    /**
     * Destroy method for old route - ✅ ADDED
     */
    public function destroy($id)
    {
        $incharge = Incharge::find($id);
        if ($incharge) {
            $incharge->delete();
            return redirect()->route('incharge.admissions.registerlist')->with('success','Data deleted successfully');
        }
        return redirect()->route('incharge.admissions.registerlist')->with('error','Record not found');
    }

    /**
     * Registered method - ✅ ADDED
     */
    public function registered()
    { 
        $user = Auth::user();
        $users = User::all();
        $incharges = Incharge::all();
        return view('admissions.index', compact('incharges','user'));
    }

    /**
     * Editlist method - ✅ ADDED
     */
    public function editlist(){
        $ud = Auth::user()->district;
        $incharges = DB::table('oldohadmissions')
        ->where('district', $ud)
        ->whereNull('readmit')
        ->get();
        
        return view('admissions.editlist', compact('incharges'));
    }

    /**
     * Show method - ✅ ADDED
     */
    public function show(Incharge $incharge)
    {
        // Implementation if needed
    }

    /**
     * Edit method - ✅ ADDED
     */
    public function edit(Incharge $incharge)
    {
        // Implementation if needed
    }

    /**
     * Update method - ✅ ADDED
     */
    public function update(Request $request, Incharge $incharge)
    {
        // Implementation if needed
    }

    // ==================== ADDITIONAL METHODS ====================

    public function listResidents()
    {
        $user = Auth::user();
        return view('incharge.residents_list');
    }

    public function pendingRegistration()
    {
        $user = Auth::user();
        return view('incharge.pending_registration');
    }

    public function pendingList()
    {
        $user = Auth::user();
        $ud = $user->district;

        $incharges = Incharge::where('user_district', $ud)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('incharge.pending_list', compact('incharges'));
    }

    public function deoPendingList()
    {
        $user = Auth::user();
        $incharges = Incharge::orderBy('created_at', 'desc')->get();

        return view('deo.pending_list', compact('incharges'));
    }

    public function deletePending($id)
    {
        $user = Auth::user();
        $pending = Incharge::find($id);
        
        if ($pending) {
            $deletedName = $pending->rname;
            $pending->delete();
            return redirect()->back()->with('success', "Registration for {$deletedName} deleted successfully");
        }
        
        return redirect()->back()->with('error', 'Record not found');
    }

    public function checkCnic(Request $request)
    {
        $cnic = $request->cnic;
        
        // Check in HWHAdmission table if resident already exists
        $existingResident = HWHAdmission::where('cnic', $cnic)->first();
        
        if ($existingResident) {
            return response()->json([
                'exists' => true,
                'data' => [
                    'date' => $existingResident->admission_date,
                    'discharge_date' => $existingResident->discharge_date
                ]
            ]);
        }
        
        return response()->json(['exists' => false]);
    }

    public function checkRcnic(Request $request)
    {
        $rcnic = $request->input('rcnic');
    
        // Check if the rcnic exists in the incharges table
        $exists = DB::table('ohadmissions')->where('cnic', $rcnic)->select('admitdate','id')->first();
        
        $discharge_date = '';
        $reg_date = '';
        if($exists != []){
            $reg_date = $exists->admitdate; 
            $discharge_date = DB::table('discharges')->where('ohadmissions_id', $exists->id)->select('ddate')->first();
        }

        if ($exists) {
            return response()->json(['status' => 'exists','admit_date' => $exists,'discharge_date'=>$discharge_date], 200);
        }
    
        return response()->json(['status' => 'not_exists'], 200);
    }

    /**
     * Show discharge creation form - ✅ FIXED
     */
    public function createDischarge()
    {
        $user = Auth::user();
        return view('incharge.discharge.create'); // ✅ FIXED PATH
    }

    /**
     * Store discharge data - ✅ FIXED VERSION
     */
    public function storeDischarge(Request $request)
    {
        Log::info('🎯 === STORE DISCHARGE START ===');
        
        $user = Auth::user();
        Log::info('👤 User:', [
            'id' => $user->id, 
            'name' => $user->name, 
            'district' => $user->district
        ]);

        try {
            // Simple validation
            $request->validate([
                'resident_name.*' => 'required',
                'discharge_date.*' => 'required|date',
                'cnic.*' => 'required',
                'admission_date.*' => 'required|date'
            ]);

            $savedCount = 0;
            $savedRecords = [];

            foreach($request->resident_name as $index => $name) {
                if (!empty($name) && !empty($request->discharge_date[$index]) && 
                    !empty($request->cnic[$index]) && !empty($request->admission_date[$index])) {
                    
                    $cleanCnic = preg_replace('/[^0-9]/', '', $request->cnic[$index]);
                    
                    // Check duplicate pending discharge
                    $existing = PendingDischarge::where('cnic', $cleanCnic)
                                ->where('status', 'pending')
                                ->first();
                    if ($existing) {
                        Log::warning("⚠️ DUPLICATE PENDING DISCHARGE CNIC: {$cleanCnic}");
                        continue;
                    }

                    // Create pending discharge record
                    $pendingDischarge = PendingDischarge::create([
                        'user_id' => $user->id,
                        'user_district' => $user->district,
                        'resident_name' => trim($name),
                        'discharge_date' => $request->discharge_date[$index],
                        'cnic' => $cleanCnic,
                        'admission_date' => $request->admission_date[$index],
                        'status' => 'pending',
                    ]);

                    $savedCount++;
                    $savedRecords[] = [
                        'name' => $name,
                        'cnic' => $cleanCnic,
                        'discharge_date' => $request->discharge_date[$index],
                        'district' => $user->district
                    ];

                    Log::info("✅ DISCHARGE SAVED: {$name} - {$cleanCnic} for discharge on {$request->discharge_date[$index]}");
                }
            }

            Log::info("🎉 DISCHARGE STORE COMPLETE: {$savedCount} records saved", $savedRecords);

            if ($savedCount > 0) {
                return redirect()->route('incharge.discharge.create')
                    ->with('success', $savedCount . ' discharge request(s) submitted successfully! They will appear in DEO pending list.');
            } else {
                return redirect()->route('incharge.discharge.create')
                    ->with('error', 'No discharge requests were saved. Please check for duplicates.')
                    ->withInput();
            }

        } catch (\Exception $e) {
            Log::error('❌ DISCHARGE STORE ERROR: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function pendingDischargeList()
    {
        $user = Auth::user();
        $ud = $user->district;
        
        $pendingDischarges = PendingDischarge::where('user_district', $ud)
                            ->where('status', 'pending')
                            ->orderBy('created_at', 'desc')
                            ->get();
                            
        return view('incharge.pending_discharge_list', compact('pendingDischarges'));
    }

    public function destroyDischarge($id)
    {
        $discharge = PendingDischarge::find($id);
        
        if ($discharge) {
            $dischargeName = $discharge->resident_name;
            $discharge->delete();
            return redirect()->back()->with('success', "Discharge request for {$dischargeName} deleted successfully");
        }
        
        return redirect()->back()->with('error', 'Discharge request not found');
    }

    public function bulkDeleteDischarge(Request $request)
    {
        $ids = $request->input('selected_discharges', []);
        
        if (!empty($ids)) {
            $deletedCount = PendingDischarge::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', "{$deletedCount} discharge request(s) deleted successfully");
        }
        
        return redirect()->back()->with('error', 'No discharge requests selected for deletion');
    }

    public function registerAgain(Request $request)
    {
        $inchargeId = $request->input('incharge_id');
        $incharge = Incharge::find($inchargeId);
        
        if ($incharge) {
            // Logic for re-registration
            return redirect()->route('hwhadmissions.create')
                ->with('incharge_data', $incharge)
                ->with('success', 'Please complete the registration form');
        }
        
        return redirect()->back()->with('error', 'Registration data not found');
    }

    /**
     * DEO Pending Discharge List - ✅ FIXED VERSION
     */
    public function deoPendingDischarge()
    {
        $user = Auth::user();
        
        Log::info('=== DEO PENDING DISCHARGE START ===');
        Log::info('DEO User:', ['id' => $user->id, 'name' => $user->name]);

        // Check if table exists
        if (!Schema::hasTable('pending_discharges')) {
            Log::warning('❌ pending_discharges table does not exist');
            $pendingDischarges = collect([]);
            return view('deo.pending_discharge', compact('pendingDischarges'));
        }

        // Get all pending discharges from all districts
        $pendingDischarges = PendingDischarge::where('status', 'pending')
                            ->orderBy('created_at', 'desc')
                            ->get();

        Log::info('📋 DEO PENDING DISCHARGES:', [
            'total_count' => $pendingDischarges->count(),
            'data' => $pendingDischarges->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->resident_name,
                    'cnic' => $item->cnic,
                    'discharge_date' => $item->discharge_date,
                    'district' => $item->user_district,
                    'user_name' => $item->user->name ?? 'N/A'
                ];
            })->toArray()
        ]);

        return view('deo.pending_discharge', compact('pendingDischarges'));
    }
}