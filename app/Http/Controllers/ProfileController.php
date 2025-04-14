<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{


    public function show(Request $request)
    {
        $profile = Profile::where('user_id', $request->user()->id)->first();

        return view('profile.show', [
            'profile' => $profile,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Update user information (name and email)
        $user->fill($request->only('name', 'email'));

        // If the email is updated, mark it as unverified
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Save the updated user information
        $user->save();

        // Update profile information (phone, address, bio)
        if ($user->profile) {
            $user->profile->update($request->only('phone', 'bio'));
        } else {
            // Create a new profile if it doesn't exist
            $user->profile()->create($request->only('phone', 'bio'));
        }

        // Redirect back with a success message
        return Redirect::back()->with('status', 'profile-updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
