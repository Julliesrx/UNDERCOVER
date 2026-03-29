<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function form()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
                
            if(auth()->user()->is_banned) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Votre compte a été banni.',
                ]);
            }

            $request->session()->regenerate();

            if(auth()->user()->role === 'admin') {
                return redirect()->route('users.index'); 
            } else {
                return redirect()->route('dashboard'); 
            }
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
