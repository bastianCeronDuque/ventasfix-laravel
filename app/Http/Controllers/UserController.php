<?php

namespace App\Http\Controllers;
use App\Models\User;
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
        return view('users.create');
    }

    /**
     * Agregar un nuevo usuario
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validamos los datos recibidos del formulario
        $request->validate([
            'rut' => ['required', 'unique:users', new ValidRutChileno],
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => [
                'required',
                'email',
                'unique:users',
                'regex:/^[a-z]+\.[a-z]+@ventasfix\.cl$/i'
            ],
            'password' => 'required|string|min:8|confirmed',
        ]);

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
        return view('users.show', compact('user'));
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
        return view('users.edit', compact('user'));
    }

    /**
     * Actualizar un usuario por su id
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validamos los datos, pero permitimos que el email y rut sean los mismos si no cambian
        $request->validate([
            'rut' => ['required', 'unique:users,rut,' . $user->id, new ValidRutChileno],
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $user->id,
                'regex:/^[a-z]+\.[a-z]+@ventasfix\.cl$/i'
            ],
        ]);

        // Si se proporciona una nueva contraseña, la actualizamos
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
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
