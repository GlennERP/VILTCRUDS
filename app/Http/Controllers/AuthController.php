<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = request()->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if (auth()->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $request->session()->regenerate();

            return redirect()->route('dashboard'); // Redirect to the dashboard
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);

        return Inertia::render('Auth/Login');
    }



public function showLoginForm()
{
    return Inertia::render ('Auth/Login');
}

public function showRegistrationForm ()
{

    return Inertia::render ('Auth/Register');
}
    public function register(Request $request)
    {
        //VALIDATION OF DATA TYPES
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'contact' => 'required|string|max:255',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'contact' => $data['contact'],
        ]);

       return Inertia::render('Auth/Register');
    }
     
    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}