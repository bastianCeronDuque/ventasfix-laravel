<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('usuarios.index', compact('users'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rut' => 'required|unique:users',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'rut' => $request->rut,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    // Método show: Muestra los detalles de un usuario
    public function show(User $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    // Método edit: Muestra el formulario de edición
    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'rut' => 'required|unique:users,rut,' . $user->id,
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']); // No actualiza la contraseña si no se llenó el campo
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}