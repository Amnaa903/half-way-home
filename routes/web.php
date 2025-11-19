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

// Public Routes
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Route::get('/home', [HomeController::class, 'index'])->name('home');

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
            // Delete registration entry
            Route::delete('/{id}', [InchargeController::class, 'destroyRegistration'])->name('destroy');
            // Bulk delete registrations
            Route::post('/bulk-delete', [InchargeController::class, 'bulkDeleteRegistration'])->name('bulk-delete');
            // Export registrations
            Route::get('/export', [InchargeController::class, 'exportRegistrations'])->name('export');
        });
        
        // CNIC Check Route
        Route::post('/check-cnic', [InchargeController::class, 'checkRcnic'])->name('check.cnic');
        
        // Register Again Route
        Route::post('/register-again', [InchargeController::class, 'registerAgain'])->name('register.again');
        
        // Resident Management Routes
        Route::get('/residents/list', [InchargeController::class, 'listResidents'])->name('residents.list');
        Route::get('/residents/pending', [InchargeController::class, 'pendingRegistration'])->name('pending.registration');
        
        // Discharge Management Routes  
        Route::get('/discharge/create', [InchargeController::class, 'createDischarge'])->name('create.discharge');
        Route::get('/discharge/pending', [InchargeController::class, 'pendingDischarge'])->name('pending.discharge');
    });
    
    // ==================== DEO ROUTES ====================
    Route::prefix('deo')->name('deo.')->group(function () {
        Route::get('/dashboard', [DeoController::class, 'dashboard'])->name('dashboard');
        // DEO Pending Registration Route - ADDED
        Route::get('/pending-registration', [InchargeController::class, 'deoPendingRegistration'])->name('pending.registration');
    });
    
    // ==================== ADMIN ROUTES ====================
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
    });
});