@extends('layouts.vuexy')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Productos /</span> Editar Producto
    </h4>
    <div class="card">
        <div class="card-header">
            <h4>Formulario de Edición</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="sku" class="form-label">SKU</label>
                        <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required>
                        @error('sku') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $product->nombre) }}" required>
                        @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="descripcion_corta" class="form-label">Descripción Corta</label>
                    <textarea class="form-control" id="descripcion_corta" name="descripcion_corta" rows="2">{{ old('descripcion_corta', $product->descripcion_corta) }}</textarea>
                    @error('descripcion_corta') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="descripcion_larga" class="form-label">Descripción Larga</label>
                    <textarea class="form-control" id="descripcion_larga" name="descripcion_larga" rows="4">{{ old('descripcion_larga', $product->descripcion_larga) }}</textarea>
                    @error('descripcion_larga') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="precio_neto" class="form-label">Precio Neto</label>
                        <input type="number" step="0.01" class="form-control" id="precio_neto" name="precio_neto" value="{{ old('precio_neto', $product->precio_neto) }}" required>
                        @error('precio_neto') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="stock_actual" class="form-label">Stock Actual</label>
                        <input type="number" class="form-control" id="stock_actual" name="stock_actual" value="{{ old('stock_actual', $product->stock_actual) }}" required>
                        @error('stock_actual') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="stock_minimo" class="form-label">Stock Mínimo</label>
                        <input type="number" class="form-control" id="stock_minimo" name="stock_minimo" value="{{ old('stock_minimo', $product->stock_minimo) }}" required>
                        @error('stock_minimo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="stock_bajo" class="form-label">Stock Bajo</label>
                        <input type="number" class="form-control" id="stock_bajo" name="stock_bajo" value="{{ old('stock_bajo', $product->stock_bajo) }}" required>
                        @error('stock_bajo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="stock_alto" class="form-label">Stock Alto</label>
                        <input type="number" class="form-control" id="stock_alto" name="stock_alto" value="{{ old('stock_alto', $product->stock_alto) }}" required>
                        @error('stock_alto') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="imagen_url" class="form-label">URL de la Imagen</label>
                    <input type="url" class="form-control" id="imagen_url" name="imagen_url" value="{{ old('imagen_url', $product->imagen_url) }}">
                    @error('imagen_url') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">Actualizar Producto</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection