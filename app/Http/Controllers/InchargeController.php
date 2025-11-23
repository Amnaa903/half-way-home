<?php

namespace App\Http\Controllers;

use App\Models\Incharge;
use App\Models\PendingDischarge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class InchargeController extends Controller
{
    // ==================== DASHBOARD METHOD ====================
    
    /**
     * Display incharge dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        Log::info('Incharge Dashboard - User:', [
            'id' => $user->id, 
            'name' => $user->name, 
            'district' => $user->district
        ]);

        // Temporary fix - check if table exists
        $pendingDischargeCount = 0;
        try {
            if (Schema::hasTable('pending_discharges')) {
                $pendingDischargeCount = DB::table('pending_discharges')
                    ->where('user_district', $user->district)
                    ->where('status', 'pending')
                    ->count();
            }
        } catch (\Exception $e) {
            Log::warning('Pending discharges table not found, using default count 0');
        }

        // Get real statistics
        $stats = [
            'total_residents' => DB::table('incharges')->where('user_district', $user->district)->count(),
            'pending_registration' => DB::table('incharges')->where('user_district', $user->district)->count(),
            'pending_discharge' => $pendingDischargeCount,
            'today_tasks' => DB::table('incharges')
                            ->where('user_district', $user->district)
                            ->whereDate('created_at', today())
                            ->count()
        ];
        
        return view('incharge_dashboard', compact('stats'));
    }

    // ==================== REGISTRATION SYSTEM METHODS ====================

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $ud = $user->district;

        Log::info('=== INDEX METHOD CALLED ===');
        Log::info('User district:', ['district' => $ud]);

        // AUTO-REMOVAL: First remove incharges that have been registered in HWH admissions
        $this->autoRemoveRegisteredIncharges();

        // Get pending registrations for current user's district
        $incharges = Incharge::where('user_district', $ud)
                        ->orderBy('created_at', 'desc')
                        ->get();

        Log::info('Incharges data count:', ['count' => $incharges->count()]);

        return view('admissions.registerlist', compact('incharges', 'user'));
    }

    /**
     * Automatically remove incharges that have been registered in HWH system
     */
    private function autoRemoveRegisteredIncharges()
    {
        try {
            $userDistrict = Auth::user()->district;
            
            // Find incharges that have corresponding HWH admissions
            $registeredIncharges = DB::select("
                SELECT i.id 
                FROM incharges i 
                INNER JOIN hwh_admissions h ON i.rcnic = h.cnic 
                WHERE i.user_district = '$userDistrict'
            ");

            $removedCount = 0;
            foreach ($registeredIncharges as $incharge) {
                $inchargeRecord = Incharge::find($incharge->id);
                if ($inchargeRecord) {
                    $inchargeRecord->delete();
                    $removedCount++;
                }
            }

            // Set success message if any records were auto-removed
            if ($removedCount > 0) {
                session()->flash('auto_removed', $removedCount . ' pending registration(s) were automatically removed as they have been registered in HWH system.');
            }

            return $removedCount;

        } catch (\Exception $e) {
            \Log::error('Auto remove registered incharges failed: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Show registration form (Create Registration List)
     */
    public function createRegistration()
    {
        $user = Auth::user();
        
        Log::info('Create Registration - Data loaded:', [
            'user_district' => $user->district
        ]);
        
        return view('incharge.create_registration');
    }

    /**
     * Store registration data - UPDATED VERSION
     */
    public function storeRegistration(Request $request)
    {
        $user = auth()->user();
        
        Log::info('=== STORE REGISTRATION START ===');
        Log::info('User:', ['id' => $user->id, 'name' => $user->name, 'district' => $user->district]);
        Log::info('Request data:', $request->all());

        // Validation
        $request->validate([
            'rname.*' => 'required|string|max:255',
            'reg_date.*' => 'required|date',
            'rcnic.*' => 'required|string|max:15'
        ]);

        $savedCount = 0;
        $errors = [];
        $duplicateCount = 0;

        // Save new entries
        if($request->has('rname') && count($request->rname) > 0) {
            foreach($request->rname as $index => $name) {
                try {
                    // Check if all fields are filled
                    if (!empty($name) && 
                        !empty($request->reg_date[$index]) && 
                        !empty($request->rcnic[$index])) {
                        
                        // Clean CNIC (remove dashes and spaces)
                        $cleanCnic = preg_replace('/[^0-9]/', '', $request->rcnic[$index]);
                        
                        // Check for duplicate CNIC in database
                        $existing = Incharge::where('rcnic', $cleanCnic)->first();
                        if ($existing) {
                            $errors[] = "CNIC {$cleanCnic} already exists for {$existing->rname}";
                            $duplicateCount++;
                            Log::warning('Duplicate CNIC found:', [
                                'cnic' => $cleanCnic,
                                'existing_name' => $existing->rname
                            ]);
                            continue;
                        }
                        
                        // Create new record
                        $incharge = Incharge::create([
                            'user_id' => $user->id,
                            'user_district' => $user->district,
                            'rname' => trim($name),
                            'reg_date' => $request->reg_date[$index],
                            'rcnic' => $cleanCnic,
                        ]);
                        
                        $savedCount++;
                        Log::info("Saved row {$index}: ", [
                            'name' => $name,
                            'cnic' => $cleanCnic,
                            'date' => $request->reg_date[$index]
                        ]);
                    }
                } catch (\Exception $e) {
                    $errorMsg = "Error saving row " . ($index + 1) . ": " . $e->getMessage();
                    $errors[] = $errorMsg;
                    Log::error($errorMsg);
                }
            }
        } else {
            Log::warning('No new rows found in request');
            $errors[] = 'No data received. Please fill at least one row.';
        }

        // Prepare response message
        if ($savedCount > 0) {
            $message = $savedCount . ' registration(s) created successfully!';
            if ($duplicateCount > 0) {
                $message .= " {$duplicateCount} duplicate(s) skipped.";
            }
            if (!empty($errors)) {
                $message .= ' Errors: ' . implode(', ', array_slice($errors, 0, 3));
            }
            return redirect()->route('incharge.registration.list')->with('success', $message);
        } else {
            $errorMsg = 'No registrations were saved. ';
            if ($duplicateCount > 0) {
                $errorMsg .= "{$duplicateCount} duplicate CNIC(s) found. ";
            }
            if (!empty($errors)) {
                $errorMsg .= implode(', ', array_slice($errors, 0, 3));
            } else {
                $errorMsg .= 'Please check your input.';
            }
            return redirect()->route('incharge.create.registration')->with('error', $errorMsg);
        }
    }

    /**
     * Display registration list - UPDATED VERSION
     */
    public function registrationList()
    {
        $user = Auth::user();
        
        Log::info('=== REGISTRATION LIST START ===');
        Log::info('User for list:', ['id' => $user->id, 'name' => $user->name, 'district' => $user->district]);

        // AUTO-REMOVAL: Remove incharges that have been registered
        $removedCount = $this->autoRemoveRegisteredIncharges();
        if ($removedCount > 0) {
            Log::info('Auto-removed registered incharges:', ['count' => $removedCount]);
        }

        // Get pending registrations
        $incharges = Incharge::where('user_district', $user->district)
                            ->orderBy('created_at', 'desc')
                            ->get();
        
        Log::info('Incharges data retrieved:', [
            'user_district' => $user->district,
            'total_count' => $incharges->count()
        ]);
    
        return view('incharge.registration_list', compact('incharges', 'user'));
    }

    /**
     * Get registration data for editing
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
     * Update registration data
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
     * Delete registration entry
     */
    public function destroyRegistration($id)
    {
        $user = Auth::user();
        
        Log::info('=== DELETE REGISTRATION START ===');
        Log::info('Delete request:', ['id' => $id, 'user_id' => $user->id, 'user_district' => $user->district]);

        $incharge = Incharge::find($id);
        
        if ($incharge) {
            Log::info('Record found:', $incharge->toArray());
            
            // Check if the record belongs to the user's district
            if ($incharge->user_district === $user->district) {
                $deletedName = $incharge->rname;
                $incharge->delete();
                Log::info('Record deleted successfully');
                return redirect()->route('incharge.registration.list')->with('success', "Registration for {$deletedName} deleted successfully");
            } else {
                Log::warning('Access denied - District mismatch:', [
                    'user_district' => $user->district,
                    'record_district' => $incharge->user_district
                ]);
                return redirect()->route('incharge.registration.list')->with('error', 'Access denied to delete this record.');
            }
        }
        
        Log::warning('Record not found for deletion:', ['id' => $id]);
        return redirect()->route('incharge.registration.list')->with('error', 'Record not found');
    }

    /**
     * Bulk delete registrations
     */
    public function bulkDeleteRegistration(Request $request)
    {
        $user = Auth::user();
        $ids = $request->input('selected_ids', []);
        
        if (empty($ids)) {
            return redirect()->route('incharge.registration.list')->with('error', 'No registrations selected for deletion.');
        }
        
        $deletedCount = Incharge::where('user_district', $user->district)
                            ->whereIn('id', $ids)
                            ->delete();
        
        if ($deletedCount > 0) {
            return redirect()->route('incharge.registration.list')->with('success', "{$deletedCount} registration(s) deleted successfully.");
        }
        
        return redirect()->route('incharge.registration.list')->with('error', 'No registrations were deleted.');
    }

    /**
     * Export registrations
     */
    public function exportRegistrations()
    {
        $user = Auth::user();
        $incharges = Incharge::where('user_district', $user->district)->get();
        
        // You can implement CSV or Excel export here
        // For now, just return success message
        return redirect()->route('incharge.registration.list')->with('success', 'Export functionality will be implemented soon.');
    }

    // ==================== DEO METHODS ====================

    /**
     * DEO Pending Registration List - All Incharges Data
     */
    public function deoPendingRegistration()
    {
        $user = Auth::user();
        
        Log::info('=== DEO PENDING REGISTRATION START ===');
        Log::info('DEO User:', ['id' => $user->id, 'name' => $user->name]);

        try {
            // Check if incharges table exists
            if (!Schema::hasTable('incharges')) {
                Log::error('Incharges table does not exist');
                $incharges = collect([]);
                return view('deo.pending_registration', compact('incharges'))->with('error', 'Incharges table not found.');
            }

            // Get all pending registrations from all incharges
            $incharges = Incharge::with('user')
                            ->orderBy('created_at', 'desc')
                            ->get();

            Log::info('DEO Pending Registrations Data:', [
                'total_count' => $incharges->count()
            ]);

            return view('deo.pending_registration', compact('incharges'));

        } catch (\Exception $e) {
            Log::error('DEO Pending Registration Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            $incharges = collect([]);
            return view('deo.pending_registration', compact('incharges'))->with('error', 'Error loading data: ' . $e->getMessage());
        }
    }

    /**
     * DEO Delete Registration
     */
    public function deoDestroyRegistration($id)
    {
        $user = Auth::user();
        
        Log::info('=== DEO DELETE REGISTRATION START ===');
        Log::info('DEO Delete request:', ['id' => $id, 'user_id' => $user->id]);

        $incharge = Incharge::find($id);
        
        if ($incharge) {
            Log::info('Record found for DEO deletion:', $incharge->toArray());
            
            $deletedName = $incharge->rname;
            $incharge->delete();
            Log::info('Record deleted successfully by DEO');
            return redirect()->route('deo.pending.registration')->with('success', "Registration for {$deletedName} deleted successfully");
        }
        
        Log::warning('Record not found for DEO deletion:', ['id' => $id]);
        return redirect()->route('deo.pending.registration')->with('error', 'Record not found');
    }

    /**
     * DEO Approve Registration
     */
    public function deoApproveRegistration($id)
    {
        $user = Auth::user();
        
        Log::info('=== DEO APPROVE REGISTRATION START ===');
        Log::info('DEO Approve request:', ['id' => $id, 'user_id' => $user->id]);

        $incharge = Incharge::find($id);
        
        if ($incharge) {
            Log::info('Record found for DEO approval:', $incharge->toArray());
            
            $approvedName = $incharge->rname;
            
            // Here you can add additional logic for approval
            // For example, update status, send notifications, etc.
            
            $incharge->delete(); // Or update status instead of delete
            Log::info('Record approved successfully by DEO');
            return redirect()->route('deo.pending.registration')->with('success', "Registration for {$approvedName} approved successfully");
        }
        
        Log::warning('Record not found for DEO approval:', ['id' => $id]);
        return redirect()->route('deo.pending.registration')->with('error', 'Record not found');
    }

    /**
     * DEO Registration Details
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

    // ==================== OTHER METHODS ====================

    public function editlist(){
        $ud = Auth::user()->district;
        $incharges = DB::table('oldohadmissions')
        ->where('district', $ud)
        ->whereNull('readmit')
        ->get();
        
        return view('admissions.editlist', compact('incharges'));
    }

    /**
     * Check RCnic
     */
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
     * Store registration data - OLD VERSION
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        
        $indata = $request->validate([
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

    public function show(Incharge $incharge)
    {
        //
    }

    public function edit(Incharge $incharge)
    {
        //
    }

    public function registered()
    { 
        $user = Auth::user();
        $users = User::all();
        $incharges = Incharge::all();
        return view('admissions.index', compact('incharges','user'));
    }

    public function update(Request $request, Incharge $incharge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
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

    // Add other missing methods as needed
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
        $existingResident = \App\Models\HWHAdmission::where('cnic', $cnic)->first();
        
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

    // Add other methods that are referenced in your routes
    public function createDischarge()
    {
        $user = Auth::user();
        return view('incharge.create_discharge');
    }

    public function storeDischarge(Request $request)
    {
        // Implementation for store discharge
        $user = Auth::user();
        
        // Add your discharge storage logic here
        return redirect()->back()->with('success', 'Discharge request submitted successfully');
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
            $discharge->delete();
            return redirect()->back()->with('success', 'Discharge request deleted successfully');
        }
        
        return redirect()->back()->with('error', 'Discharge request not found');
    }

    public function bulkDeleteDischarge(Request $request)
    {
        $ids = $request->input('ids');
        
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
     * DEO Pending Discharge List
     */
    public function deoPendingDischarge()
    {
        $user = Auth::user();
        
        Log::info('=== DEO PENDING DISCHARGE START ===');
        Log::info('DEO User:', ['id' => $user->id, 'name' => $user->name]);

        // Check if table exists
        if (!Schema::hasTable('pending_discharges')) {
            $pendingDischarges = collect([]);
            return view('deo.pending_discharge', compact('pendingDischarges'));
        }

        // Get all pending discharges from all districts
        $pendingDischarges = PendingDischarge::where('status', 'pending')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('deo.pending_discharge', compact('pendingDischarges'));
    }
}