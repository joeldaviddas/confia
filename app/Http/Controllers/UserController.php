<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        $usuarios = User::orderBy('created_at', 'desc')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'El nombre es obligatorio',
            'name.string' => 'El nombre debe ser texto',
            'name.max' => 'El nombre no puede tener más de :max caracteres',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'El correo electrónico debe ser válido',
            'email.unique' => 'Este correo electrónico ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'role.required' => 'El rol es obligatorio',
            'role.in' => 'El rol seleccionado no es válido',
        ];

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()],
            'role' => ['required', 'string', 'in:admin,user'],
        ], $messages);

        try {
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
            ]);

            return redirect()->route('usuarios.index')
                ->with('success', 'Usuario creado exitosamente');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error al crear el usuario. Por favor, intente nuevamente.');
        }
    }

    public function edit(User $usuario)
    {
        if ($usuario->id === 1 && Auth::id() !== 1) {
            return redirect()->route('usuarios.index')
                ->with('error', 'No tienes permiso para editar al usuario principal');
        }
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, User $usuario)
    {
        if ($usuario->id === 1 && Auth::id() !== 1) {
            return redirect()->route('usuarios.index')
                ->with('error', 'No tienes permiso para modificar al usuario principal');
        }

        $messages = [
            'name.required' => 'El nombre es obligatorio',
            'name.string' => 'El nombre debe ser texto',
            'name.max' => 'El nombre no puede tener más de :max caracteres',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'El correo electrónico debe ser válido',
            'email.unique' => 'Este correo electrónico ya está registrado',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'role.required' => 'El rol es obligatorio',
            'role.in' => 'El rol seleccionado no es válido',
        ];

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $usuario->id],
            'role' => ['required', 'string', 'in:admin,user'],
        ], $messages);

        try {
            $data = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $validated['role'],
            ];

            if ($request->filled('password')) {
                $request->validate([
                    'password' => ['confirmed', Rules\Password::min(8)
                        ->mixedCase()
                        ->numbers()
                        ->symbols()],
                ], $messages);
                $data['password'] = Hash::make($request->password);
            }

            $usuario->update($data);

            return redirect()->route('usuarios.index')
                ->with('success', 'Usuario actualizado exitosamente');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error al actualizar el usuario. Por favor, intente nuevamente.');
        }
    }

    public function destroy(User $usuario)
    {
        if ($usuario->id === Auth::id()) {
            return redirect()->route('usuarios.index')
                ->with('error', 'No puedes eliminar tu propio usuario');
        }

        if ($usuario->id === 1) {
            return redirect()->route('usuarios.index')
                ->with('error', 'No se puede eliminar al usuario principal');
        }

        try {
            $usuario->delete();
            return redirect()->route('usuarios.index')
                ->with('success', 'Usuario eliminado exitosamente');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Error al eliminar el usuario. Por favor, intente nuevamente.');
        }
    }
}
