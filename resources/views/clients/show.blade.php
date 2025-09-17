@extends('layouts.vuexy')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Gestión de Clientes /</span> Detalles del Cliente</h4>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Información del Cliente</h5>
                <div>
                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">
                        <i class="ti ti-edit me-1"></i> Editar
                    </a>
                    <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">
                        <i class="ti ti-arrow-left me-1"></i> Volver
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6 class="fw-semibold">RUT Empresa:</h6>
                        <p>{{ $client->rut_empresa }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="fw-semibold">Razón Social:</h6>
                        <p>{{ $client->razon_social }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6 class="fw-semibold">Rubro:</h6>
                        <p>{{ $client->rubro }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="fw-semibold">Teléfono:</h6>
                        <p>{{ $client->telefono }}</p>
                    </div>
                </div>
                <div class="mb-3">
                    <h6 class="fw-semibold">Dirección:</h6>
                    <p>{{ $client->direccion }}</p>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6 class="fw-semibold">Nombre de Contacto:</h6>
                        <p>{{ $client->nombre_contacto }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="fw-semibold">Email de Contacto:</h6>
                        <p>{{ $client->email_contacto }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6 class="fw-semibold">Fecha de Creación:</h6>
                        <p>{{ $client->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="fw-semibold">Última Actualización:</h6>
                        <p>{{ $client->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection