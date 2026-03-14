<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'clave_institucional' => 'required|max:255|unique:users,clave_institucional',
            'password' => 'required|min:4|confirmed',
            'rol' => 'nullable|max:50',
        ]);

        User::create([
            'nombre' => $request->nombre,
            'clave_institucional' => $request->clave_institucional,
            'password' => Hash::make($request->password),
            'rol' => $request->rol ?? 'user',
            'activo' => $request->has('activo'),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'clave_institucional' => [
                'required',
                'max:255',
                Rule::unique('users', 'clave_institucional')->ignore($user->id),
            ],
            'password' => 'nullable|min:4|confirmed',
            'rol' => 'nullable|max:50',
        ]);

        $data = [
            'nombre' => $request->nombre,
            'clave_institucional' => $request->clave_institucional,
            'rol' => $request->rol ?? 'user',
            'activo' => $request->has('activo'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() == $user->id) {
            return redirect()->route('users.index')->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
