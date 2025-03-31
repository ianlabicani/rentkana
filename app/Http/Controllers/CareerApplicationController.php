<?php

namespace App\Http\Controllers;

use App\Models\CareerApplication;
use Illuminate\Http\Request;

class CareerApplicationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if the number of applications has reached the limit (50)
        if (CareerApplication::count() >= 30) {
            return redirect()->route('welcome')->with('error', 'Application limit reached. No more applications are accepted.');
        }

        // Validate input fields
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'position' => 'required|string|max:50',
        ]);

        // Create and save the application
        CareerApplication::create([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
        ]);

        return redirect()->route('welcome')->with('success', 'Application submitted successfully. Please refrain from submitting again.');
    }
}
