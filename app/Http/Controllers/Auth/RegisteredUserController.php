<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\VerifiedLandlord;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    // In RegisteredUserController.php
    public function create(): View
    {
        // Fetch roles with formatted descriptions
        $roles = Role::where('name', '!=', 'admin')->get();
        $roleDescriptions = [
            'renter' => 'Renters can browse property listings and submit rental applications.',
            'landlord' => 'Landlords can list properties and manage tenant applications.',
        ];

        return view('auth.register', compact('roles', 'roleDescriptions'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'exists:roles,name'], // Validate by role name
        ]);

        // Find the role by its name
        $role = Role::where('name', $validated['role'])->first();

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Assign role
        $user->roles()->attach($role->id, ['id' => (string) Str::uuid()]);

        // If the role is 'landlord', create the VerifiedLandlord entry
        if ($role->name === 'landlord') {
            VerifiedLandlord::create([
                'user_id' => $user->id,
                'status' => 'pending',
            ]);
        }

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('welcome');
    }
}
