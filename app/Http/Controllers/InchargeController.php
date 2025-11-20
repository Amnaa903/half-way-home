<?php

namespace App\Http\Controllers;

use App\Models\Incharge;
use App\Models\PendingDischarge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

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
            'pending_discharge' => $pendingDischargeCount, // Use the safe count
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
    public function index(Incharge $incharge)
    {
        $user = Auth::user();
        $ud = Auth::user()->district;
        $users=User::all();

        // AUTO-REMOVAL: First remove incharges that have been registered in HWH admissions
        $this->autoRemoveRegisteredIncharges();

        // Query to remove which are registered
        $incharge= DB::select("SELECT * 
        FROM   incharges
        WHERE  rcnic Not IN (SELECT cnic FROM hwh_admissions) and  user_district = '$ud '");
    
        return view ('/admissions.registerlist', compact('incharge','user'));
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

    public function editlist(){
        $ud = Auth::user()->district;
        $incharge = DB::table('oldohadmissions')
        ->where('district', $ud)
        ->whereNull('readmit')
        ->get();
        
       
            return view ('/admissions.editlist', compact('incharge'));
    }

    /**
     * Show form to create registration
     */
    public function create()
    {
        return view('admissions.preregister');
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
     * Store registration data
     */
    public function store(Request $request ,Incharge $incharge)
    {
        $indata=request()->validate([
            'incharges.*.rname'=>'',
            'incharges.*.reg_date'=>'',
            'incharges.*.rcnic'=>'',
        ]);
        
        $user = auth()->user();
        if(count($request->rname) > 0)
        {
            foreach($request->rname as $incharge=>$v){
                $indata=array(
                    'user_id'=>$user->id,
                    'user_district'=>$user->district,
                    'rname'=>$request->rname[$incharge],
                    'reg_date'=>$request->reg_date[$incharge],
                    'rcnic'=>$request->rcnic[$incharge],
                );
            
                $d = array();
                array_push($d, $indata);
                Incharge::Insert($d);
            }
        }
               
        return redirect('/admissions.registerlist');
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
            return redirect()->route('incharge.registration.create')->with('success', $message);
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
            return redirect()->route('incharge.registration.create')->with('error', $errorMsg);
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
     * Bulk Delete Registrations
     */
    public function bulkDeleteRegistration(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:incharges,id'
        ]);

        $deletedCount = 0;
        
        foreach ($request->ids as $id) {
            $incharge = Incharge::find($id);
            if ($incharge && $incharge->user_district === $user->district) {
                $incharge->delete();
                $deletedCount++;
            }
        }

        if ($deletedCount > 0) {
            return redirect()->route('incharge.registration.list')->with('success', "{$deletedCount} registration(s) deleted successfully");
        }

        return redirect()->route('incharge.registration.list')->with('error', 'No registrations were deleted.');
    }

    /**
     * Register Again Method
     */
    public function registerAgain(Request $request)
    {
        $user = Auth::user();

        // Get the CNIC from request
        $rcnic = $request->input('rcnic');
        $cleanCnic = preg_replace('/[^0-9]/', '', $rcnic);
        
        // Find existing record
        $existing = Incharge::where('rcnic', $cleanCnic)->first();
        
        if ($existing) {
            // Update the record with current user info
            $existing->update([
                'user_id' => $user->id,
                'user_district' => $user->district,
                'reg_date' => now()->format('Y-m-d')
            ]);
            
            Log::info('Registration updated:', $existing->toArray());
            return redirect()->route('incharge.registration.list')->with('success', "Registration for {$existing->rname} updated successfully!");
        }
        
        return redirect()->route('incharge.registration.list')->with('error', 'Record not found for the provided CNIC.');
    }

    /**
     * Export Registrations to Excel
     */
    public function exportRegistrations()
    {
        $user = Auth::user();
        $incharges = Incharge::where('user_district', $user->district)
                            ->orderBy('created_at', 'desc')
                            ->get();

        // Simple CSV export
        $fileName = 'registrations_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($incharges) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'CNIC', 'Registration Date', 'Created At']);
            
            foreach ($incharges as $incharge) {
                fputcsv($file, [
                    $incharge->id,
                    $incharge->rname,
                    $incharge->rcnic,
                    $incharge->reg_date,
                    $incharge->created_at
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
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

        // Get all pending registrations from all incharges
        $incharges = Incharge::orderBy('created_at', 'desc')
                            ->get();

        Log::info('DEO Pending Registrations:', [
            'total_count' => $incharges->count()
        ]);

        return view('deo.pending_registration', compact('incharges'));
    }

    // ==================== PENDING DISCHARGE METHODS ====================

    /**
     * Show create discharge form
     */
    public function createDischarge()
    {
        $user = Auth::user();
        
        Log::info('Create Discharge Form - User:', [
            'id' => $user->id, 
            'name' => $user->name, 
            'district' => $user->district
        ]);
        
        // Ensure pending_discharges table exists
        $this->ensurePendingDischargesTable();
        
        return view('incharge.discharge.create');
    }

    /**
     * Store pending discharge data
     */
    public function storeDischarge(Request $request)
    {
        $user = auth()->user();
        
        Log::info('=== STORE DISCHARGE START ===');
        Log::info('User:', ['id' => $user->id, 'name' => $user->name, 'district' => $user->district]);

        // Validation
        $request->validate([
            'resident_name.*' => 'required|string|max:255',
            'discharge_date.*' => 'required|date',
            'cnic.*' => 'required|string|max:15',
            'admission_date.*' => 'required|date'
        ]);

        $savedCount = 0;
        $errors = [];

        try {
            // Ensure table exists
            $this->ensurePendingDischargesTable();

            // Save new entries
            if($request->has('resident_name') && count($request->resident_name) > 0) {
                foreach($request->resident_name as $index => $name) {
                    try {
                        // Check if all fields are filled
                        if (!empty($name) && 
                            !empty($request->discharge_date[$index]) && 
                            !empty($request->cnic[$index]) &&
                            !empty($request->admission_date[$index])) {
                            
                            // Clean CNIC (remove dashes and spaces)
                            $cleanCnic = preg_replace('/[^0-9]/', '', $request->cnic[$index]);
                            
                            // Check for duplicate CNIC in pending discharges
                            $existing = PendingDischarge::where('cnic', $cleanCnic)
                                ->where('status', 'pending')
                                ->first();
                            
                            if ($existing) {
                                $errors[] = "CNIC {$cleanCnic} already exists in pending discharges";
                                Log::warning('Duplicate CNIC in pending discharges:', [
                                    'cnic' => $cleanCnic,
                                    'existing_name' => $existing->resident_name
                                ]);
                                continue;
                            }
                            
                            // Create new record
                            $pendingDischarge = PendingDischarge::create([
                                'user_id' => $user->id,
                                'user_district' => $user->district,
                                'resident_name' => trim($name),
                                'discharge_date' => $request->discharge_date[$index],
                                'cnic' => $cleanCnic,
                                'admission_date' => $request->admission_date[$index],
                                'status' => 'pending'
                            ]);
                            
                            $savedCount++;
                            Log::info("Saved discharge row {$index}: ", [
                                'name' => $name,
                                'cnic' => $cleanCnic,
                                'discharge_date' => $request->discharge_date[$index]
                            ]);
                        }
                    } catch (\Exception $e) {
                        $errorMsg = "Error saving discharge row " . ($index + 1) . ": " . $e->getMessage();
                        $errors[] = $errorMsg;
                        Log::error($errorMsg);
                    }
                }
            } else {
                Log::warning('No discharge rows found in request');
                $errors[] = 'No data received. Please fill at least one row.';
            }

            // Prepare response message
            if ($savedCount > 0) {
                $message = $savedCount . ' discharge(s) added to pending list successfully!';
                if (!empty($errors)) {
                    $message .= ' Some errors: ' . implode(', ', array_slice($errors, 0, 3));
                }
                return redirect()->route('incharge.discharge.create')->with('success', $message);
            } else {
                $errorMsg = 'No discharges were saved. ';
                if (!empty($errors)) {
                    $errorMsg .= implode(', ', array_slice($errors, 0, 3));
                } else {
                    $errorMsg .= 'Please check your input.';
                }
                return redirect()->route('incharge.discharge.create')->with('error', $errorMsg);
            }

        } catch (\Exception $e) {
            Log::error('Store discharge failed: ' . $e->getMessage());
            return redirect()->route('incharge.discharge.create')->with('error', 'System error: ' . $e->getMessage());
        }
    }

    /**
     * Display pending discharge list for Incharge
     */
    public function pendingDischargeList()
    {
        $user = Auth::user();
        
        Log::info('=== INCHARGE PENDING DISCHARGE LIST START ===');
        Log::info('User for discharge list:', ['id' => $user->id, 'name' => $user->name, 'district' => $user->district]);

        // Check if table exists
        if (!Schema::hasTable('pending_discharges')) {
            $pendingDischarges = collect([]); // Empty collection
            return view('incharge.discharge.pending_list', compact('pendingDischarges'));
        }

        // AUTO-REMOVAL: Remove discharges that have been processed
        $removedCount = $this->autoRemoveProcessedDischarges();
        if ($removedCount > 0) {
            Log::info('Auto-removed processed discharges:', ['count' => $removedCount]);
        }

        // Get pending discharges for this incharge's district
        $pendingDischarges = PendingDischarge::where('user_district', $user->district)
                            ->where('status', 'pending')
                            ->orderBy('created_at', 'desc')
                            ->get();
        
        return view('incharge.discharge.pending_list', compact('pendingDischarges'));
    }

    /**
     * Display pending discharge list for DEO (All districts)
     */
    public function deoPendingDischarge()
    {
        $user = Auth::user();
        
        Log::info('=== DEO PENDING DISCHARGE START ===');
        Log::info('DEO User:', ['id' => $user->id, 'name' => $user->name]);

        // Check if table exists
        if (!Schema::hasTable('pending_discharges')) {
            $pendingDischarges = collect([]); // Empty collection
            return view('deo.pending_discharge', compact('pendingDischarges'));
        }

        // AUTO-REMOVAL: Remove discharges that have been processed
        $removedCount = $this->autoRemoveProcessedDischarges();
        if ($removedCount > 0) {
            session()->flash('auto_removed', $removedCount . ' discharge(s) were automatically removed as they have been processed.');
        }

        // Get all pending discharges from all districts
        $pendingDischarges = PendingDischarge::where('status', 'pending')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('deo.pending_discharge', compact('pendingDischarges'));
    }

    /**
     * Delete discharge entry
     */
    public function destroyDischarge($id)
    {
        $user = Auth::user();
        
        Log::info('=== DELETE DISCHARGE START ===');
        Log::info('Delete discharge request:', ['id' => $id, 'user_id' => $user->id]);

        $pendingDischarge = PendingDischarge::find($id);
        
        if ($pendingDischarge) {
            Log::info('Discharge record found:', $pendingDischarge->toArray());
            
            // Check permissions - Incharge can only delete their district's records
            // DEO/Admin can delete any record
            if ($user->user_type === 'incharge' && $pendingDischarge->user_district !== $user->district) {
                Log::warning('Access denied - District mismatch:', [
                    'user_district' => $user->district,
                    'record_district' => $pendingDischarge->user_district
                ]);
                return redirect()->back()->with('error', 'Access denied to delete this record.');
            }
            
            $deletedName = $pendingDischarge->resident_name;
            $pendingDischarge->delete();
            Log::info('Discharge record deleted successfully');
            
            return redirect()->back()->with('success', "Discharge record for {$deletedName} deleted successfully");
        }
        
        Log::warning('Discharge record not found for deletion:', ['id' => $id]);
        return redirect()->back()->with('error', 'Discharge record not found');
    }

    /**
     * Bulk delete discharges
     */
    public function bulkDeleteDischarge(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'selected_discharges' => 'required|array',
            'selected_discharges.*' => 'exists:pending_discharges,id'
        ]);

        $deletedCount = 0;
        
        foreach ($request->selected_discharges as $id) {
            $discharge = PendingDischarge::find($id);
            if ($discharge) {
                // Check permissions
                if ($user->user_type === 'incharge' && $discharge->user_district !== $user->district) {
                    continue; // Skip if not authorized
                }
                $discharge->delete();
                $deletedCount++;
            }
        }

        if ($deletedCount > 0) {
            return redirect()->back()->with('success', "{$deletedCount} discharge(s) deleted successfully");
        }

        return redirect()->back()->with('error', 'No discharges were deleted.');
    }

    /**
     * Export discharges
     */
    public function exportDischarges()
    {
        $user = Auth::user();
        $pendingDischarges = PendingDischarge::when($user->user_type === 'incharge', function($query) use ($user) {
            return $query->where('user_district', $user->district);
        })
        ->where('status', 'pending')
        ->orderBy('created_at', 'desc')
        ->get();

        // Simple CSV export
        $fileName = 'pending_discharges_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($pendingDischarges) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Discharge Date', 'CNIC', 'Admission Date', 'District', 'Status']);
            
            foreach ($pendingDischarges as $discharge) {
                fputcsv($file, [
                    $discharge->id,
                    $discharge->resident_name,
                    $discharge->discharge_date,
                    $discharge->cnic,
                    $discharge->admission_date,
                    $discharge->user_district,
                    $discharge->status
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Ensure pending_discharges table exists
     */
    private function ensurePendingDischargesTable()
    {
        try {
            if (!Schema::hasTable('pending_discharges')) {
                Schema::create('pending_discharges', function ($table) {
                    $table->id();
                    $table->foreignId('user_id')->constrained()->onDelete('cascade');
                    $table->string('user_district');
                    $table->string('resident_name');
                    $table->date('discharge_date');
                    $table->string('cnic');
                    $table->date('admission_date');
                    $table->string('status')->default('pending');
                    $table->timestamps();
                    
                    $table->index(['user_district', 'status']);
                    $table->index('cnic');
                });
                
                Log::info('Pending discharges table created successfully');
            }
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to ensure pending_discharges table: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Automatically remove processed discharges
     */
    private function autoRemoveProcessedDischarges()
    {
        try {
            // Placeholder - returns 0 as we don't have discharge processing table
            $removedCount = 0;

            return $removedCount;

        } catch (\Exception $e) {
            Log::error('Auto remove processed discharges failed: ' . $e->getMessage());
            return 0;
        }
    }

    // ==================== EXISTING METHODS ====================
    
    public function show(Incharge $incharge)
    {
        //
    }

    public function edit(Incharge $incharge)
    {
        //
    }

    public function registered(Incharge $incharge)
    { 
        $user = Auth::user();
        $users=User::all();
        $incharges= Incharge::all();
        return view('/admissions.index', compact('incharge','user'));
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
        $incharge->delete();
        return redirect('/admissions.registerlist')->with('success','Data deleted successfully');
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
}