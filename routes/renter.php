<?php

use App\Http\Controllers\Renter\DashboardController;
use Illuminate\Support\Facades\Route;


Route::prefix('renter')->name('renter.')->middleware(['auth', 'role:renter'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

});

