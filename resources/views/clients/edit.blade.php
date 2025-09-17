@extends('layouts.vuexy')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Gestión de Clientes /</span> Editar Cliente</h4>

        <div class="card">
            <div class="card-header">
                <h5>Editar Cliente</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('clients.update', $client->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="rut_empresa" class="form-label">RUT Empresa <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('rut_empresa') is-invalid @enderror" id="rut_empresa" 
                                name="rut_empresa" value="{{ old('rut_empresa', $client->rut_empresa) }}" required>
                            @error('rut_empresa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="razon_social" class="form-label">Razón Social <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('razon_social') is-invalid @enderror" id="razon_social" 
                                name="razon_social" value="{{ old('razon_social', $client->razon_social) }}" required>
                            @error('razon_social')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="rubro" class="form-label">Rubro <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('rubro') is-invalid @enderror" id="rubro" 
                                name="rubro" value="{{ old('rubro', $client->rubro) }}" required>
                            @error('rubro')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" 
                                name="telefono" value="{{ old('telefono', $client->telefono) }}" required>
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" 
                            name="direccion" value="{{ old('direccion', $client->direccion) }}" required>
                        @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre_contacto" class="form-label">Nombre de Contacto <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nombre_contacto') is-invalid @enderror" id="nombre_contacto" 
                                name="nombre_contacto" value="{{ old('nombre_contacto', $client->nombre_contacto) }}" required>
                            @error('nombre_contacto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email_contacto" class="form-label">Email de Contacto <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email_contacto') is-invalid @enderror" id="email_contacto" 
                                name="email_contacto" value="{{ old('email_contacto', $client->email_contacto) }}" required>
                            @error('email_contacto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">Actualizar Cliente</button>
                        <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Script para formatear RUT chileno mientras se escribe
        const rutInput = document.getElementById('rut_empresa');
        
        rutInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9kK]/g, '');
            
            if (value.length > 1) {
                let dv = value.slice(-1);
                let rut = value.slice(0, -1);
                
                // Formateamos con puntos
                if (rut.length > 3) {
                    rut = rut.toString().split('').reverse().join('');
                    let rutFormateado = '';
                    for (let i = 0; i < rut.length; i++) {
                        rutFormateado += rut.charAt(i);
                        if (i % 3 === 2 && i < rut.length - 1) {
                            rutFormateado += '.';
                        }
                    }
                    rut = rutFormateado.split('').reverse().join('');
                }
                
                e.target.value = rut + '-' + dv;
            }
        });
    });
</script>
@endsection