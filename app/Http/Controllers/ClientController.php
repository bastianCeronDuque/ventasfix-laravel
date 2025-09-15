<?php

namespace App\Http\Controllers;

use App\Models\Client; // Importa el modelo de Cliente
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Método para mostrar la lista de todos los clientes
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    // Método para mostrar el formulario de creación de un nuevo cliente
    public function create()
    {
        return view('clients.create');
    }

    // Método para guardar un nuevo cliente en la base de datos
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'rut_empresa' => 'required|unique:clients',
            'rubro' => 'required',
            'razon_social' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'nombre_contacto' => 'required',
            'email_contacto' => 'required|email|unique:clients',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')
            ->with('success', 'Cliente creado exitosamente.');
    }

    // ... Puedes agregar los métodos show, edit, update y destroy siguiendo la misma lógica del controlador de productos y usuarios.
}