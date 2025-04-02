<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
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
        $roles = Role::all();
        $roleDescriptions = [
            'renter' => 'Renters can browse property listings and submit rental applications.',
            'landlord' => 'Landlords can list properties and manage tenant applications.',
            'admin' => 'Administrators have full control over the system and user management.'
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required', 'string', 'exists:roles,id'], // Validate UUID format
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // Assign the selected role to the user by creating an explicit RoleUser entry
        RoleUser::create([
            'id' => (string) Str::uuid(), // Explicitly generate a UUID for the pivot table
            'user_id' => $user->id,
            'role_id' => $request->role_id,
        ]);
    
        event(new Registered($user));
    
        Auth::login($user);
    
        return redirect(route('welcome', absolute: false));
    }
}
