<?php

namespace App\Http\Controllers;

use App\Models\Client; // Importa el modelo de Cliente
use App\Rules\ValidRutChileno; // Importar la regla de validación
use App\Http\Requests\ClientRequest; // Importar el Form Request
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
    public function store(ClientRequest $request)
    {
        // La validación se maneja automáticamente en el ClientRequest
        
        // Obtener solo los datos validados
        $data = $request->validated();
        
        // Formatear el RUT antes de guardar
        $data['rut_empresa'] = ValidRutChileno::formatearParaGuardar($data['rut_empresa']);

        Client::create($data);

        return redirect()->route('clients.index')
            ->with('success', 'Cliente creado exitosamente.');
    }

    /**
     * Muestra los detalles de un cliente específico.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.show', compact('client'));
    }

    /**
     * Muestra el formulario para editar un cliente existente.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    /**
     * Actualiza un cliente en la base de datos.
     *
     * @param  \App\Http\Requests\ClientRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ClientRequest $request, $id)
    {
        $client = Client::findOrFail($id);
        
        // Obtener solo los datos validados
        $data = $request->validated();
        
        // Formatear el RUT antes de guardar
        if (isset($data['rut_empresa'])) {
            $data['rut_empresa'] = ValidRutChileno::formatearParaGuardar($data['rut_empresa']);
        }
        
        $client->update($data);
        
        return redirect()->route('clients.index')
            ->with('success', 'Cliente actualizado exitosamente.');
    }

    /**
     * Elimina un cliente de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        
        return redirect()->route('clients.index')
            ->with('success', 'Cliente eliminado exitosamente.');
    }
}