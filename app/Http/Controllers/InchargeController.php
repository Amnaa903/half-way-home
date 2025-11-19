<?php

namespace App\Http\Controllers;

use App\Models\Incharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InchargeController extends Controller
{
    // ==================== DASHBOARD METHODS ====================
    
    /**
     * Display incharge dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Temporary comment for testing
        // if (!isset($user->user_type) || $user->user_type !== 'incharge') {
        //     return redirect()->route('home')->with('error', 'Access denied. Incharge privileges required.');
        // }

        // Get real statistics
        $stats = [
            'total_residents' => DB::table('incharges')->where('user_district', $user->district)->count(),
            'pending_registration' => DB::table('incharges')->where('user_district', $user->district)->count(),
            'pending_discharge' => 8,
            'today_tasks' => DB::table('incharges')
                            ->where('user_district', $user->district)
                            ->whereDate('created_at', today())
                            ->count()
        ];
        
        // CHANGE: Updated to match your file name
        return view('incharge_dashboard', compact('stats'));
    }

    // ==================== REGISTRATION SYSTEM METHODS ====================

    /**
     * Show registration form (Create Registration List)
     */
    public function createRegistration()
    {
        $user = Auth::user();
        
        // Temporary comment for testing
        // if (!isset($user->user_type) || $user->user_type !== 'incharge') {
        //     return redirect()->route('home')->with('error', 'Access denied.');
        // }
        
        // Get existing registrations for this user's district
        $incharges = Incharge::where('user_district', $user->district)
                            ->orderBy('created_at', 'desc')
                            ->get();
        
        Log::info('Create Registration - Data loaded:', [
            'user_district' => $user->district,
            'records_count' => $incharges->count()
        ]);
        
        return view('incharge.create_registration', compact('incharges'));
    }

    /**
     * Store registration data - UPDATED VERSION
     */
    public function storeRegistration(Request $request)
    {
        $user = auth()->user();
        
        // Debugging
        Log::info('=== STORE REGISTRATION START ===');
        Log::info('User:', ['id' => $user->id, 'name' => $user->name, 'district' => $user->district]);
        Log::info('Request Data:', $request->all());

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
                    } else {
                        Log::warning('Empty fields in row:', [
                            'index' => $index,
                            'name' => $name ?? 'EMPTY',
                            'date' => $request->reg_date[$index] ?? 'EMPTY',
                            'cnic' => $request->rcnic[$index] ?? 'EMPTY'
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

        Log::info('Save Summary:', [
            'total_rows' => $request->has('rname') ? count($request->rname) : 0,
            'saved_count' => $savedCount,
            'duplicate_count' => $duplicateCount,
            'errors' => $errors
        ]);

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
        
        // Temporary comment for testing
        // if (!isset($user->user_type) || $user->user_type !== 'incharge') {
        //     return redirect()->route('home')->with('error', 'Access denied.');
        // }

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
            'total_count' => $incharges->count(),
            'data_sample' => $incharges->take(3)->toArray()
        ]);
        
        Log::info('=== REGISTRATION LIST END ===');
    
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
        
        // Temporary comment for testing
        // if (!isset($user->user_type) || $user->user_type !== 'incharge') {
        //     return redirect()->route('home')->with('error', 'Access denied.');
        // }

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
     * CNIC Check Method - UPDATED
     */
    public function checkRcnic(Request $request)
    {
        $rcnic = $request->input('rcnic');
        
        // Clean CNIC
        $cleanCnic = preg_replace('/[^0-9]/', '', $rcnic);
    
        Log::info('CNIC Check:', ['original' => $rcnic, 'clean' => $cleanCnic]);
        
        // Check if the rcnic exists in the incharges table
        $exists = Incharge::where('rcnic', $cleanCnic)->first();
        
        if ($exists) {
            Log::info('CNIC exists:', $exists->toArray());
            return response()->json([
                'status' => 'exists',
                'data' => [
                    'name' => $exists->rname,
                    'date' => $exists->reg_date,
                    'cnic' => $exists->rcnic,
                    'district' => $exists->user_district
                ]
            ], 200);
        }
        
        Log::info('CNIC not found:', ['cnic' => $cleanCnic]);
        return response()->json([
            'status' => 'not_exists',
            'message' => 'CNIC not found in database'
        ], 200);
    }

    /**
     * Register Again Method
     */
    public function registerAgain(Request $request)
    {
        $user = Auth::user();
        
        // Temporary comment for testing
        // if (!isset($user->user_type) || $user->user_type !== 'incharge') {
        //     return redirect()->route('home')->with('error', 'Access denied.');
        // }

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
            'total_count' => $incharges->count(),
            'data_sample' => $incharges->take(3)->toArray()
        ]);
        
        Log::info('=== DEO PENDING REGISTRATION END ===');

        return view('deo.pending_registration', compact('incharges'));
    }

    /**
     * Automatically remove registered incharges
     */
    private function autoRemoveRegisteredIncharges()
    {
        try {
            $userDistrict = Auth::user()->district;
            
            // This is a placeholder - modify according to your admission table
            // Currently just returns 0 as we don't have admission table structure
            $removedCount = 0;

            // Example implementation (commented out as we don't have admissions table)
            /*
            $registeredIncharges = DB::table('incharges as i')
                ->join('admissions as a', 'i.rcnic', '=', 'a.cnic')
                ->where('i.user_district', $userDistrict)
                ->select('i.id')
                ->get();

            foreach ($registeredIncharges as $incharge) {
                $inchargeRecord = Incharge::find($incharge->id);
                if ($inchargeRecord) {
                    $inchargeRecord->delete();
                    $removedCount++;
                }
            }
            */

            if ($removedCount > 0) {
                session()->flash('auto_removed', $removedCount . ' pending registration(s) were automatically removed.');
            }

            return $removedCount;

        } catch (\Exception $e) {
            Log::error('Auto remove registered incharges failed: ' . $e->getMessage());
            return 0;
        }
    }

    // ==================== EXISTING METHODS ====================
    
    public function listResidents()
    {
        $user = Auth::user();
        
        if (!isset($user->user_type) || $user->user_type !== 'incharge') {
            return redirect()->route('home')->with('error', 'Access denied.');
        }
        
        return view('incharge.residents_list');
    }

    public function pendingRegistration()
    {
        $user = Auth::user();
        
        if (!isset($user->user_type) || $user->user_type !== 'incharge') {
            return redirect()->route('home')->with('error', 'Access denied.');
        }
        
        return view('incharge.pending_registration');
    }

    public function createDischarge()
    {
        $user = Auth::user();
        
        if (!isset($user->user_type) || $user->user_type !== 'incharge') {
            return redirect()->route('home')->with('error', 'Access denied.');
        }
        
        return view('incharge.create_discharge');
    }

    public function pendingDischarge()
    {
        $user = Auth::user();
        
        if (!isset($user->user_type) || $user->user_type !== 'incharge') {
            return redirect()->route('home')->with('error', 'Access denied.');
        }
        
        return view('incharge.pending_discharge');
    }
}