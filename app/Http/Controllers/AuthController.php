<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('login'); // points to resources/views/login.blade.php
    }

    // Handle login submission
    public function login(Request $request)
    {
        // Add validation for login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8', // allows passwords longer than 8
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->with('error', 'Invalid credentials');
    }

    // Show registration form
    public function showRegisterForm()
    {
        return view('registration'); // points to resources/views/registration.blade.php
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|max:32|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
