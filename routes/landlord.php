<?php

use App\Http\Controllers\Landlord\DashboardController;
use Illuminate\Support\Facades\Route;
Route::prefix('landlord')->name('landlord.')->middleware(['auth', 'role:landlord'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
});
