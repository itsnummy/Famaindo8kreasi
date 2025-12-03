<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nama' => 'required|string',
            'password' => 'required',
        ]);

        // Cek login dengan 'nama' bukan 'email'
        if (Auth::attempt(['nama' => $credentials['nama'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            
            // Redirect ke dashboard admin
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'nama' => 'Username atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}