<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

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

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'clave_institucional' => 'required|string|max:255|unique:users,clave_institucional',
            'password' => ['required', 'confirmed', Password::min(4)],
        ]);

        $user = User::create([
            'nombre' => $request->nombre,
            'clave_institucional' => $request->clave_institucional,
            'password' => Hash::make($request->password),
            'rol' => 'user',
            'activo' => 1,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Registro exitoso. Bienvenido.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
