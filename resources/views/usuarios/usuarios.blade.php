@extends('layouts.vuexy')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Gestión de Usuarios /</span> Lista de Usuarios</h4>

        <div class="card">
            <h5 class="card-header">Usuarios Registrados</h5>
            <div class="d-flex justify-content-between align-items-center mx-4 mb-3">
                <div></div>
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus"></i> Agregar Nuevo Usuario
                </a>
            </div>

            {{-- Mensaje de éxito (si existe) --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible mx-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>RUT</th>
                            <th>Nombre Completo</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->rut }}</td>
                                <td>{{ $user->nombre }} {{ $user->apellido }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{-- Botones de acción --}}
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-icon btn-info">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-icon btn-warning">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-danger"
                                                onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">
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