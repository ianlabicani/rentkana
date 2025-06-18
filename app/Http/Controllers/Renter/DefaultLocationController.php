<?php

namespace App\Http\Controllers\Renter;

use App\Http\Controllers\Controller;
use App\Models\DefaultLocation;
use Illuminate\Http\Request;

class DefaultLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $defaultLocations = DefaultLocation::where('user_id', auth()->id())->get();

        // return view('renter.default-locations.index', compact('defaultLocations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'is_active' => 'nullable|boolean',
        ]);

        $user = $request->user();

        $user->defaultLocations()->create([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('renter.profile.index')->with('success', 'Default location added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(DefaultLocation $defaultLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DefaultLocation $defaultLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DefaultLocation $defaultLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DefaultLocation $defaultLocation)
    {
        //
    }
}
