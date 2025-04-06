<?php

use App\Http\Controllers\CareerApplicationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::resource('career-applications', CareerApplicationController::class)->except(['show', 'edit', 'update', 'destroy', 'index']);

require __DIR__ . '/renter.php';
require __DIR__ . '/landlord.php';
require __DIR__ . '/admin.php';
