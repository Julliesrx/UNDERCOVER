<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User ;

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

    public function formRegister()
    {
        return view('auth.signin');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'nom' => $request->nom,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'player',
        ]);

        // Connecter automatiquement après inscription
        Auth::attempt(['email' => $request->email, 'password' => $request->password], true);

        return redirect()->route('dashboard');
    }
}
