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

// Public Routes
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// ==================== PUBLIC CNIC SEARCH ROUTE ====================
Route::get('/hwhadmissions/search-by-cnic', [HWHAdmissionController::class, 'searchByCnic'])->name('hwhadmissions.search-by-cnic');

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
    
    // ==================== HWH ADMISSIONS ROUTES ====================
    Route::prefix('hwhadmissions')->name('hwhadmissions.')->group(function () {
        // Create admission form (accessible from pending registration)
        Route::get('/create', [HWHAdmissionController::class, 'create'])->name('create');
        // Store admission data
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
        // Show attachments
        Route::get('/{id}/attachment/{field}', [HWHAdmissionController::class, 'showAttachment'])->name('attachment.show');
    });
    
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
            // Bulk delete discharges - ADDED
            Route::post('/bulk-delete', [InchargeController::class, 'bulkDeleteDischarge'])->name('bulk-delete');
            // Export discharges - ADDED
            Route::get('/export', [InchargeController::class, 'exportDischarges'])->name('export');
        });
        
        // CNIC Check Route
        Route::post('/check-cnic', [InchargeController::class, 'checkRcnic'])->name('check.cnic');
        
        // Register Again Route
        Route::post('/register-again', [InchargeController::class, 'registerAgain'])->name('register.again');
        
        // Resident Management Routes
        Route::get('/residents/list', [InchargeController::class, 'listResidents'])->name('residents.list');
        Route::get('/residents/pending', [InchargeController::class, 'pendingRegistration'])->name('pending.registration');
    });
    
    // ==================== DEO ROUTES ====================
    Route::prefix('deo')->name('deo.')->group(function () {
        Route::get('/dashboard', [DeoController::class, 'dashboard'])->name('dashboard');
        
        // DEO Pending Registration Route
        Route::get('/pending-registration', [InchargeController::class, 'deoPendingRegistration'])->name('pending.registration');
        
        // ==================== DEO DISCHARGE ROUTES ====================
        Route::prefix('discharge')->name('discharge.')->group(function () {
            // DEO Pending Discharge List
            Route::get('/pending', [InchargeController::class, 'deoPendingDischarge'])->name('pending');
            // Delete discharge entry
            Route::delete('/{id}', [InchargeController::class, 'destroyDischarge'])->name('destroy');
            // Bulk delete discharges - ADDED
            Route::post('/bulk-delete', [InchargeController::class, 'bulkDeleteDischarge'])->name('bulk-delete');
        });
        
        // DEO HWH Admissions Management
        Route::get('/hwh-admissions', [HWHAdmissionController::class, 'index'])->name('hwh.admissions');
        Route::get('/hwh-admissions/{id}', [HWHAdmissionController::class, 'show'])->name('hwh.admissions.show');
    });
    
    // ==================== ADMIN ROUTES ====================
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        
        // Admin HWH Admissions Management
        Route::get('/hwh-admissions', [HWHAdmissionController::class, 'index'])->name('hwh.admissions');
        Route::get('/hwh-admissions/{id}', [HWHAdmissionController::class, 'show'])->name('hwh.admissions.show');
        Route::delete('/hwh-admissions/{id}', [HWHAdmissionController::class, 'destroy'])->name('hwh.admissions.destroy');
        
        // Admin Discharge Management
        Route::get('/discharge/pending', [InchargeController::class, 'deoPendingDischarge'])->name('discharge.pending');
        Route::delete('/discharge/{id}', [InchargeController::class, 'destroyDischarge'])->name('discharge.destroy');
        // Admin bulk delete discharges - ADDED
        Route::post('/discharge/bulk-delete', [InchargeController::class, 'bulkDeleteDischarge'])->name('discharge.bulk-delete');
    });
});

// Fallback Route
Route::fallback(function () {
    return view('errors.404');
});