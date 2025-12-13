<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

   
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required'
        ]);

        
        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        $credentials = [
            $field => $request->login,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'login' => 'Email/username atau password salah.',
        ]);
    }

    // Logout - PERBAIKI DI SINI: HAPUS $ EKSTRA
    public function logout(Request $request)  // <-- SEHARUSNYA $request, BUKAN $ $request
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}