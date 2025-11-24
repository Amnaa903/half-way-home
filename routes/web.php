<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\InchargeController;
use App\Http\Controllers\DeoController;
use App\Http\Controllers\HWHAdmissionController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// ==================== PUBLIC HWH ADMISSIONS ROUTES ====================
Route::prefix('hwhadmissions')->name('hwhadmissions.')->group(function () {
    // CNIC Search
    Route::get('/search-by-cnic', [HWHAdmissionController::class, 'searchByCnic'])->name('search-by-cnic');
    
    // Create admission form (accessible from pending registration)
    Route::get('/create', [HWHAdmissionController::class, 'create'])->name('create');
    
    // ✅ FIXED: SINGLE STORE ROUTE
    Route::post('/', [HWHAdmissionController::class, 'store'])->name('store');
    
    // List all admissions
    Route::get('/', [HWHAdmissionController::class, 'index'])->name('index');
    // Show single admission
    Route::get('/{id}', [HWHAdmissionController::class, 'show'])->name('show');
    // Edit admission form
    Route::get('/{id}/edit', [HWHAdmissionController::class, 'edit'])->name('edit');
    // Update admission
    Route::put('/{id}', [HWHAdmissionController::class, 'update'])->name('update');
    // Delete admission
    Route::delete('/{id}', [HWHAdmissionController::class, 'destroy'])->name('destroy');
    
    // ✅ DISCHARGE SYSTEM ROUTES
    Route::prefix('discharges')->name('discharges.')->group(function () {
        Route::get('/', [HWHAdmissionController::class, 'dischargeIndex'])->name('index');
        Route::get('/create/{id}', [HWHAdmissionController::class, 'dischargeCreate'])->name('create');
        Route::post('/', [HWHAdmissionController::class, 'dischargeStore'])->name('store');
        Route::get('/discharged-list', [HWHAdmissionController::class, 'dischargedList'])->name('discharged-list');
        Route::post('/reverse/{id}', [HWHAdmissionController::class, 'reverseDischarge'])->name('reverse');
    });
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// User Management Routes (Protected)
Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    
    // Additional routes if needed
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/detailReports', function () {
        return view('detail-reports');
    })->name('detailReports');
    
    // ==================== INCHARGE ROUTES ====================
    Route::prefix('incharge')->name('incharge.')->group(function () {
        // Incharge Dashboard
        Route::get('/dashboard', [InchargeController::class, 'dashboard'])->name('dashboard');
        
        // ==================== REGISTRATION SYSTEM ROUTES ====================
        Route::prefix('registration')->name('registration.')->group(function () {
            // Create registration form
            Route::get('/create', [InchargeController::class, 'createRegistration'])->name('create');
            
            // Store registration data
            Route::post('/store', [InchargeController::class, 'storeRegistration'])->name('store');
            
            // View registration list
            Route::get('/list', [InchargeController::class, 'registrationList'])->name('list');
            // Get registration data for editing
            Route::get('/{id}/edit-data', [InchargeController::class, 'getRegistrationData'])->name('edit.data');
            // Update registration data
            Route::put('/{id}', [InchargeController::class, 'updateRegistration'])->name('update');
            // Delete registration entry
            Route::delete('/{id}', [InchargeController::class, 'destroyRegistration'])->name('destroy');
            // Bulk delete registrations
            Route::post('/bulk-delete', [InchargeController::class, 'bulkDeleteRegistration'])->name('bulk-delete');
            // Export registrations
            Route::get('/export', [InchargeController::class, 'exportRegistrations'])->name('export');
        });
        
        // ==================== DISCHARGE SYSTEM ROUTES ====================
        Route::prefix('discharge')->name('discharge.')->group(function () {
            // Create discharge form
            Route::get('/create', [InchargeController::class, 'createDischarge'])->name('create');
            // Store discharge data  
            Route::post('/store', [InchargeController::class, 'storeDischarge'])->name('store');
            // View pending discharge list
            Route::get('/pending', [InchargeController::class, 'pendingDischargeList'])->name('pending');
            // Delete discharge entry
            Route::delete('/{id}', [InchargeController::class, 'destroyDischarge'])->name('destroy');
            // Bulk delete discharges
            Route::post('/bulk-delete', [InchargeController::class, 'bulkDeleteDischarge'])->name('bulk-delete');
        });
        
        // CNIC Check Route
        Route::post('/check-cnic', [InchargeController::class, 'checkRcnic'])->name('check.cnic');
        
        // Register Again Route
        Route::post('/register-again', [InchargeController::class, 'registerAgain'])->name('register.again');
        
        // Resident Management Routes
        Route::get('/residents/list', [InchargeController::class, 'listResidents'])->name('residents.list');
        Route::get('/residents/pending', [InchargeController::class, 'pendingRegistration'])->name('pending.registration');
        Route::get('/pending-list', [InchargeController::class, 'pendingList'])->name('pending.list');
        Route::delete('/pending/{id}', [InchargeController::class, 'deletePending'])->name('pending.delete');
        
        // ==================== OLD ADMISSIONS ROUTES ====================
        Route::prefix('admissions')->name('admissions.')->group(function () {
            // Old registration list route
            Route::get('/registerlist', [InchargeController::class, 'index'])->name('registerlist');
            // Old edit list route
            Route::get('/editlist', [InchargeController::class, 'editlist'])->name('editlist');
            // Old create route
            Route::get('/preregister', [InchargeController::class, 'create'])->name('preregister');
            // Old store route
            Route::post('/store', [InchargeController::class, 'store'])->name('store');
            // Old destroy route
            Route::delete('/registerlist/{id}', [InchargeController::class, 'destroy'])->name('destroy');
            // Old registered route
            Route::get('/registered', [InchargeController::class, 'registered'])->name('registered');
        });
        
        // Check CNIC Route
        Route::post('/check-cnic-exists', [InchargeController::class, 'checkCnic'])->name('check.cnic.exists');
    });
    
    // ==================== DEO ROUTES ====================
    Route::prefix('deo')->name('deo.')->group(function () {
        // DEO Dashboard
        Route::get('/dashboard', [DeoController::class, 'dashboard'])->name('dashboard');
        
        // ==================== DEO REGISTRATION ROUTES ====================
        Route::prefix('registration')->name('registration.')->group(function () {
            // DEO Pending Registration List
            Route::get('/pending', [InchargeController::class, 'deoPendingRegistration'])->name('pending');
            // DEO Approve Registration
            Route::put('/{id}/approve', [InchargeController::class, 'deoApproveRegistration'])->name('approve');
            // DEO Registration Details
            Route::get('/{id}/details', [InchargeController::class, 'deoRegistrationDetails'])->name('details');
            // DEO Delete Registration
            Route::delete('/{id}', [InchargeController::class, 'deoDestroyRegistration'])->name('destroy');
        });
        
        // DEO Pending List
        Route::get('/pending-list', [InchargeController::class, 'deoPendingList'])->name('pending.list');
        
        // ==================== DEO DISCHARGE ROUTES ====================
        Route::prefix('discharge')->name('discharge.')->group(function () {
            // DEO Pending Discharge List
            Route::get('/pending', [InchargeController::class, 'deoPendingDischarge'])->name('pending');
            // Delete discharge entry
            Route::delete('/{id}', [InchargeController::class, 'destroyDischarge'])->name('destroy');
            // Bulk delete discharges
            Route::post('/bulk-delete', [InchargeController::class, 'bulkDeleteDischarge'])->name('bulk-delete');
        });
        
        // DEO HWH Admissions Management
        Route::get('/hwh-admissions', [HWHAdmissionController::class, 'index'])->name('hwh.admissions');
        Route::get('/hwh-admissions/{id}', [HWHAdmissionController::class, 'show'])->name('hwh.admissions.show');
        
        // ✅ DEO DISCHARGE SYSTEM ACCESS
        Route::prefix('hwh-discharges')->name('hwh.discharges.')->group(function () {
            Route::get('/', [HWHAdmissionController::class, 'dischargeIndex'])->name('index');
            Route::get('/create/{id}', [HWHAdmissionController::class, 'dischargeCreate'])->name('create');
            Route::post('/', [HWHAdmissionController::class, 'dischargeStore'])->name('store');
            Route::get('/discharged-list', [HWHAdmissionController::class, 'dischargedList'])->name('discharged-list');
            Route::post('/reverse/{id}', [HWHAdmissionController::class, 'reverseDischarge'])->name('reverse');
        });
    });
    
    // ==================== ADMIN ROUTES ====================
    Route::prefix('admin')->name('admin.')->group(function () {
        // ✅ ADMIN DASHBOARD ROUTE ADDED
        Route::get('/dashboard', [HomeController::class, 'adminDashboard'])->name('dashboard');
        
        // Admin HWH Admissions Management
        Route::get('/hwh-admissions', [HWHAdmissionController::class, 'index'])->name('hwh.admissions');
        Route::get('/hwh-admissions/{id}', [HWHAdmissionController::class, 'show'])->name('hwh.admissions.show');
        Route::delete('/hwh-admissions/{id}', [HWHAdmissionController::class, 'destroy'])->name('hwh.admissions.destroy');
        Route::post('/hwhadmissions', [HWHAdmissionFormController::class, 'store'])->name('hwhadmissions.store');
        // Admin Registration Management
        Route::get('/pending-registration', [InchargeController::class, 'deoPendingRegistration'])->name('admin.pending.registration');
        Route::delete('/registration/{id}', [InchargeController::class, 'deoDestroyRegistration'])->name('admin.registration.destroy');
        
        // Admin Discharge Management
        Route::get('/discharge/pending', [InchargeController::class, 'deoPendingDischarge'])->name('admin.discharge.pending');
        Route::delete('/discharge/{id}', [InchargeController::class, 'destroyDischarge'])->name('admin.discharge.destroy');
        // Admin bulk delete discharges
        Route::post('/discharge/bulk-delete', [InchargeController::class, 'bulkDeleteDischarge'])->name('admin.discharge.bulk-delete');
        
        // ✅ ADMIN DISCHARGE SYSTEM ACCESS
        Route::prefix('hwh-discharges')->name('hwh.discharges.')->group(function () {
            Route::get('/', [HWHAdmissionController::class, 'dischargeIndex'])->name('index');
            Route::get('/create/{id}', [HWHAdmissionController::class, 'dischargeCreate'])->name('create');
            Route::post('/', [HWHAdmissionController::class, 'dischargeStore'])->name('store');
            Route::get('/discharged-list', [HWHAdmissionController::class, 'dischargedList'])->name('discharged-list');
            Route::post('/reverse/{id}', [HWHAdmissionController::class, 'reverseDischarge'])->name('reverse');
        });
    });

    // ==================== ADDITIONAL ROUTES FOR COMPATIBILITY ====================
    
    // ✅ FIXED: ADDED ALL MISSING ROUTES
    Route::get('/incharge/create-registration', [InchargeController::class, 'createRegistration'])->name('incharge.create.registration');
    Route::post('/incharge/store-registration', [InchargeController::class, 'storeRegistration'])->name('incharge.store.registration');
    Route::get('/incharge/registration-list', [InchargeController::class, 'registrationList'])->name('incharge.registration.list');
    
    // DEO direct routes
    Route::get('/deo/pending-registration', [InchargeController::class, 'deoPendingRegistration'])->name('deo.pending.registration');
    
    // Resource routes for incharges (for basic CRUD operations)
    Route::resource('incharges', InchargeController::class)->except(['create', 'store', 'edit', 'update']);
    
    // Additional utility routes
    Route::get('/check-cnic-global', [InchargeController::class, 'checkCnic'])->name('check.cnic.global');
    
    // Bulk operations
    Route::post('/bulk/registrations/delete', [InchargeController::class, 'bulkDeleteRegistration'])->name('bulk.registrations.delete');
    Route::post('/bulk/discharges/delete', [InchargeController::class, 'bulkDeleteDischarge'])->name('bulk.discharges.delete');
    
    // Export routes
    Route::get('/export/registrations', [InchargeController::class, 'exportRegistrations'])->name('export.registrations');
    
    // Registration flow routes
    Route::post('/register-from-pending', [InchargeController::class, 'registerAgain'])->name('register.from.pending');
    
    // Dashboard redirects
    Route::get('/incharge', function () {
        return redirect()->route('incharge.dashboard');
    });
    
    Route::get('/deo', function () {
        return redirect()->route('deo.dashboard');
    });
    
    Route::get('/admin', function () {
        return redirect()->route('admin.dashboard');
    });
    
    // ✅ ADDED: Debug routes for testing
    Route::get('/debug/incharge-data', function() {
        if (!Auth::check()) {
            return "Please login first as Incharge";
        }
        
        $user = Auth::user();
        $allIncharges = \App\Models\Incharge::all();
        $userIncharges = \App\Models\Incharge::where('user_district', $user->district)->get();
        
        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'district' => $user->district,
                'role' => $user->role
            ],
            'all_incharges_count' => $allIncharges->count(),
            'all_incharges' => $allIncharges->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->rname,
                    'cnic' => $item->rcnic,
                    'district' => $item->user_district,
                    'user_id' => $item->user_id,
                    'created_at' => $item->created_at
                ];
            }),
            'user_incharges_count' => $userIncharges->count(),
            'user_incharges' => $userIncharges->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->rname,
                    'cnic' => $item->rcnic,
                    'created_at' => $item->created_at
                ];
            })
        ]);
    });
    
    // ✅ ADDED: Test form submission route
    Route::get('/test/form-submission', function() {
        return view('test_form_submission');
    });
});

// ==================== PUBLIC UTILITY ROUTES ====================
Route::get('/system-info', function () {
    return response()->json([
        'system' => 'Half Way Home Management System',
        'version' => '2.0',
        'modules' => [
            'Incharge Registration',
            'DEO Approval', 
            'HWH Admissions',
            'Discharge Management'
        ]
    ]);
});

// Health check route
Route::get('/health', function () {
    return response()->json(['status' => 'healthy', 'timestamp' => now()]);
});

// Route list for debugging
Route::get('/route-list', function() {
    $routes = Route::getRoutes();
    $routeList = [];
    
    foreach ($routes as $route) {
        $routeList[] = [
            'method' => $route->methods()[0],
            'uri' => $route->uri(),
            'name' => $route->getName(),
            'action' => $route->getActionName()
        ];
    }
    
    return response()->json($routeList);
});

// Fixed Fallback Route
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});