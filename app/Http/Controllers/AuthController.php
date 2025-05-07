<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Prikazivanje forme za registraciju
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Obrada registracije
    public function register(Request $request)
    {
        // Validacija unosa
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Kreiranje korisnika
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Automatska prijava nakon registracije
        Auth::login($user);

        // Preusmjeravanje na početnu stranicu ili bilo koju rutu
        return redirect()->route('login');
    }

    // Prikazivanje forme za prijavu
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Obrada prijave
    public function login(Request $request)
    {
        // Validacija unosa
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Provjera kredencijala
        if (Auth::attempt($credentials)) {
            // Obnova sesije ako su podaci točni
            $request->session()->regenerate();
            return redirect()->intended('suppliers');
        }

        // Ako podaci nisu točni, vratiti grešku
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Odjava korisnika
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
