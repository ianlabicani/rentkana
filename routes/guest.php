<?php

use App\Http\Controllers\Guest\RoomController;
use Illuminate\Support\Facades\Route;
Route::name('guest.')->group(function () {
    Route::resource('rooms', RoomController::class)->only(['index', 'show']);
});
