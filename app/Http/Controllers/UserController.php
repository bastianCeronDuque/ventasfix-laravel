<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Rules\ValidRutChileno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Listar todos los usuarios
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtenemos todos los usuarios de la base de datos
        $users = User::all();

        // Retornamos la vista y pasamos los usuarios a la vista
        return view('usuarios.index', compact('users'));
    }

    /**
     * Mostrar el formulario para crear un nuevo usuario
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Agregar un nuevo usuario
     *
     * @param  App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        // Los datos ya están validados por el UserRequest

        // Formatear el RUT antes de guardar
        $rutFormateado = ValidRutChileno::formatearParaGuardar($request->rut);

        // Creamos el nuevo usuario en la base de datos
        User::create([
            'rut' => $rutFormateado,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Ciframos la contraseña
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Obtener los datos de un usuario por su ID
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Buscamos un usuario por su ID. Si no lo encuentra, Laravel lanza un error 404.
        $user = User::findOrFail($id);

        // Retorna la vista y pasa los datos del usuario
        return view('usuarios.show', compact('user'));
    }

    /**
     * Mostrar el formulario para editar un usuario
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('usuarios.edit', compact('user'));
    }

    /**
     * Actualizar un usuario por su id
     *
     * @param  App\Http\Requests\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        // Los datos ya están validados por el UserRequest

        // Si se proporciona una nueva contraseña, la actualizamos
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->rut = ValidRutChileno::formatearParaGuardar($request->rut);
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Eliminar un usuario por su Id
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
