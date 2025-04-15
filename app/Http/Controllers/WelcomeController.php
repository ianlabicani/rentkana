<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Get up to 6 available rooms with their landlord info
        $featuredRooms = Room::where('status', 'Available')
            ->with('landlord')
            ->latest()
            ->take(6)
            ->get();
            
        return view('welcome', compact('featuredRooms'));
    }   
}
