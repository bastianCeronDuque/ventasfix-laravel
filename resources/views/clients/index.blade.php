@extends('layouts.vuexy')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Gestión de Clientes /</span> Lista de Clientes</h4>
        <div class="card">
            <h5 class="card-header">Clientes Registrados</h5>
            <div class="d-flex justify-content-between align-items-center mx-4 mb-3">
                <div></div>
                <a href="{{ route('clients.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus"></i> Agregar Nuevo Cliente
                </a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>RUT</th>
                            <th>Razón Social</th>
                            <th>Rubro</th>
                            <th>Teléfono</th>
                            <th>Contacto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->rut_empresa }}</td>
                                <td>{{ $client->razon_social }}</td>
                                <td>{{ $client->rubro }}</td>
                                <td>{{ $client->telefono }}</td>
                                <td>{{ $client->nombre_contacto }}</td>
                                <td>
                                    {{-- Botones de acción --}}
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-icon btn-info">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-icon btn-warning">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-danger"
                                                onclick="return confirm('¿Estás seguro de que quieres eliminar este cliente?')">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection