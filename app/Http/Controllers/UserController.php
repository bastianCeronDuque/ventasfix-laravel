<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Obtenemos todos los usuarios de la base de datos
        $users = User::all();

        // Retornamos la vista y pasamos los usuarios a la vista
        return view('usuarios', compact('users'));
    }
    public function show($id)
    {
        // Buscamos un usuario por su ID. Si no lo encuentra, Laravel lanza un error 404.
        $user = User::findOrFail($id);

        // Retorna la vista y pasa los datos del usuario
        return view('usuarios.show', compact('user'));
    }
    public function store(Request $request)
    {
        // Validamos los datos recibidos del formulario
        $request->validate([
            'rut' => 'required|unique:users',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Creamos el nuevo usuario en la base de datos
        User::create([
            'rut' => $request->rut,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Ciframos la contraseña
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validamos los datos, pero permitimos que el email sea el mismo si no cambia
        $request->validate([
            'rut' => 'required|unique:users,rut,' . $user->id,
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        // Actualizamos el usuario
        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
