<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email'],
            'password' => ['required','string','min:8','confirmed'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => strtolower($data['email']),
            'password' => Hash::make($data['password']),
            'role' => 'attendee',
        ]);

        Auth::login($user);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Registered', 'user' => $user], 201);
        }

        return redirect('/');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required','string']
        ]);

        if (!Auth::attempt($credentials, true)) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Invalid credentials'], 422);
            }
            throw ValidationException::withMessages(['email' => 'These credentials do not match our records.']);
        }

        $request->session()->regenerate();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Logged in', 'user' => Auth::user()]);
        }

        return Auth::user()->role === 'admin' ? redirect('/admin/options') : redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Logged out']);
        }
        return redirect('/');
    }

    public function me(Request $request)
    {
        return response()->json(['user' => $request->user()]);
    }
}