@extends('layouts.vuexy')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Gestión de Usuarios /</span> Ver Usuario</h4>

    <div class="card">
        <h5 class="card-header">Detalles del Usuario</h5>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $usuario->id }}</p>
            <p><strong>RUT:</strong> {{ $usuario->rut }}</p>
            <p><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
            <p><strong>Apellido:</strong> {{ $usuario->apellido }}</p>
            <p><strong>Email:</strong> {{ $usuario->email }}</p>
            <p><strong>Registrado desde:</strong> 
                @if ($usuario->created_at)
                    {{ $usuario->created_at->format('d/m/Y') }}
                @else
                    No disponible
                @endif
            </p>
            
            <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>
            <a href="{{ route('dashboard') }}" class="btn btn-info mt-3">Inicio</a>
            <a href="{{ route('users.edit', $usuario->id) }}" class="btn btn-warning mt-3">Editar Usuario</a>
        </div>
    </div>
</div>
@endsection