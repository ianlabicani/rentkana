<?php

use App\Http\Controllers\CareerApplicationController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('feedback', [FeedbackController::class, 'store'])->name('feedback.store');

require __DIR__ . '/auth.php';

Route::resource('career-applications', CareerApplicationController::class)->except(['show', 'edit', 'update', 'destroy', 'index']);

require __DIR__ . '/renter.php';
require __DIR__ . '/landlord.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/guest.php';
