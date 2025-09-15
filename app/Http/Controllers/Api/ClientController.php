<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $clients = Client::all();
        return response()->json([
            'status' => 'success',
            'data' => $clients
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rut_empresa' => 'required|string|unique:clients|max:12',
            'rubro' => 'required|string|max:150',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string',
            'nombre_contacto' => 'required|string|max:255',
            'email_contacto' => 'required|email|unique:clients|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // TODO: Implementar validación de RUT chileno
        // Esto debería ser reemplazado por una regla de validación personalizada

        $client = Client::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Cliente creado exitosamente',
            'data' => $client
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $client = Client::find($id);
        
        if (!$client) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cliente no encontrado'
            ], 404);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        $client = Client::find($id);
        
        if (!$client) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cliente no encontrado'
            ], 404);
        }
        
        $validator = Validator::make($request->all(), [
            'rut_empresa' => 'string|unique:clients,rut_empresa,' . $id . '|max:12',
            'rubro' => 'string|max:150',
            'razon_social' => 'string|max:255',
            'telefono' => 'string|max:20',
            'direccion' => 'string',
            'nombre_contacto' => 'string|max:255',
            'email_contacto' => 'email|unique:clients,email_contacto,' . $id . '|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // TODO: Implementar validación de RUT chileno si se está actualizando
        // Esto debería ser reemplazado por una regla de validación personalizada

        $client->update($request->all());
        
        return response()->json([
            'status' => 'success',
            'message' => 'Cliente actualizado exitosamente',
            'data' => $client
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $client = Client::find($id);
        
        if (!$client) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cliente no encontrado'
            ], 404);
        }
        
        $client->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Cliente eliminado exitosamente'
        ]);
    }
}
