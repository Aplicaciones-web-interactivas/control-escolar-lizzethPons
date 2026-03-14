<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'clave_institucional' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('clave_institucional', $request->clave_institucional)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'clave_institucional' => 'Credenciales incorrectas.',
            ])->onlyInput('clave_institucional');
        }

        if (!$user->activo) {
            return back()->withErrors([
                'clave_institucional' => 'Usuario inactivo.',
            ])->onlyInput('clave_institucional');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
