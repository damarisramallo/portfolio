<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function showLogin()
    {
        return Inertia::render('Auth/Login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
    
        $key = Str::lower($request->email) . '|' . $request->ip();
    
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'email' => "Demasiados intentos. Espera {$seconds} segundos.",
            ]);
        }
    
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::clear($key); 
            $request->session()->regenerate();
    
            if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard');
            }
    
            return redirect('/');
        }
    
        RateLimiter::hit($key); 
    
        return back()->withErrors([
            'email' => 'Las credenciales no son correctas.',
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
