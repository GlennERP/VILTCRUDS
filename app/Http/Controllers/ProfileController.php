<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        try {
            $user = auth()->user();
            return Inertia::render('Admin/Profile/index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading profile');
        }
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'contact' => 'nullable|string|max:255',
            'password' => 'nullable|min:8',
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        auth()->user()->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        if (!Hash::check($request->password, auth()->user()->password)) {
            return back()->withErrors([
                'password' => 'Password is incorrect'
            ]);
        }

        try {
            $user = auth()->user();
            $user->delete();
            
            return redirect()->route('login')->with('success', 'Account deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete account');
        }
    }

}
