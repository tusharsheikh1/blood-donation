<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\BloodRequestController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Donor Routes
Route::prefix('donor')->group(function () {
    // Guest routes
    Route::middleware('guest:web')->group(function () {
        Route::get('/register', [DonorController::class, 'showRegister'])->name('donor.register');
        Route::post('/register', [DonorController::class, 'register']);
        Route::get('/login', [DonorController::class, 'showLogin'])->name('donor.login');
        Route::post('/login', [DonorController::class, 'login']);
        
        // Password Reset Routes
        Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('donor.password.request');
        Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('donor.password.email');
        Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('donor.password.reset');
        Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('donor.password.update');
    });

    // Authenticated donor routes
    Route::middleware('auth:web')->group(function () {
        Route::get('/dashboard', [DonorController::class, 'dashboard'])->name('donor.dashboard');
        Route::get('/profile', [DonorController::class, 'showProfile'])->name('donor.profile');
        Route::post('/profile', [DonorController::class, 'updateProfile'])->name('donor.profile.update');
        Route::post('/logout', [DonorController::class, 'logout'])->name('donor.logout');
    });
});

// Blood Request Routes (Protected - Donors only)
Route::middleware('auth:web')->prefix('blood-request')->group(function () {
    Route::get('/create', [BloodRequestController::class, 'create'])->name('blood-request.create');
    Route::post('/create', [BloodRequestController::class, 'store'])->name('blood-request.store');
    Route::get('/my-requests', [BloodRequestController::class, 'myRequests'])->name('blood-request.my-requests');
    Route::post('/{id}/update-status', [BloodRequestController::class, 'updateStatus'])->name('blood-request.update-status');
    Route::delete('/{id}', [BloodRequestController::class, 'destroy'])->name('blood-request.destroy');
});

// API routes for location dropdowns
Route::get('/api/districts/{division}', [DonorController::class, 'getDistricts']);
Route::get('/api/upazilas/{district}', [DonorController::class, 'getUpazilas']);

// Admin Routes
Route::prefix('admin')->group(function () {
    // Guest admin routes
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login']);
    });

   // Protected admin routes
Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/donors', [DashboardController::class, 'donors'])->name('admin.donors');

    // NEW
    Route::get('/donors/create', [DashboardController::class, 'createDonor'])->name('admin.donors.create');
    Route::post('/donors', [DashboardController::class, 'storeDonor'])->name('admin.donors.store');

    Route::get('/donors/{id}/edit', [DashboardController::class, 'editDonor'])->name('admin.donors.edit');
    Route::post('/donors/{id}', [DashboardController::class, 'updateDonor'])->name('admin.donors.update');
    Route::delete('/donors/{id}', [DashboardController::class, 'deleteDonor'])->name('admin.donors.delete');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

});