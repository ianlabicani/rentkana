<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VerifiedLandlordController;
use Illuminate\Support\Facades\Route;
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('verified-landlords', VerifiedLandlordController::class)->only(['index']);
    Route::patch('verified-landlords/{id}/approve', [VerifiedLandlordController::class, 'approve'])->name('verified-landlords.approve');
    Route::patch('verified-landlords/{id}/reject', [VerifiedLandlordController::class, 'reject'])->name('verified-landlords.reject');

});
