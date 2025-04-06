<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VerifiedLandlord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifiedLandlordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = 10;

        $pendingLandlords = VerifiedLandlord::where('status', 'pending')
            ->latest()
            ->paginate($perPage, ['*'], 'pending_page');

        $otherLandlords = VerifiedLandlord::where('status', '!=', 'pending')
            ->latest()
            ->paginate($perPage, ['*'], 'landlords_page');

        return view('admin.verified-landlords.index', compact('pendingLandlords', 'otherLandlords'));
    }


    public function approve(string $id): RedirectResponse
    {
        $landlord = VerifiedLandlord::findOrFail($id);
        $landlord->update(['status' => 'approved', 'verified_at' => now(), 'verified_by' => auth()->user()->id]);


        return redirect()->back()->with('success', 'Landlord approved successfully.');
    }

    public function reject(string $id): RedirectResponse
    {
        $landlord = VerifiedLandlord::findOrFail($id);
        $landlord->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Landlord rejected successfully.');
    }

}
