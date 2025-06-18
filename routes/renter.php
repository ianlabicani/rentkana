<?php

use App\Http\Controllers\Renter\DashboardController;
use App\Http\Controllers\Renter\DefaultLocationController;
use App\Http\Controllers\Renter\ProfileController;
use Illuminate\Support\Facades\Route;


Route::prefix('renter')->name('renter.')->middleware(['auth', 'role:renter', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('default-locations', DefaultLocationController::class);
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('default-location', [DefaultLocationController::class, 'store'])->name('default-location.store');

    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
});

