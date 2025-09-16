@extends('layouts.vuexy')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Productos /</span> Detalles del Producto
    </h4>
    <div class="card">
        <div class="card-header">
            <h4>{{ $product->nombre }}</h4>
        </div>
        <div class="card-body">
            <p><strong>SKU:</strong> {{ $product->sku }}</p>
            <p><strong>Descripción Corta:</strong> {{ $product->descripcion_corta }}</p>
            <p><strong>Descripción Larga:</strong> {{ $product->descripcion_larga }}</p>
            <p><strong>Precio Neto:</strong> ${{ number_format($product->precio_neto, 0, ',', '.') }}</p>
            <p><strong>Precio Venta:</strong> ${{ number_format($product->precio_venta, 0, ',', '.') }}</p>
            <p><strong>Stock Actual:</strong> {{ $product->stock_actual }}</p>
            <p><strong>Stock Mínimo:</strong> {{ $product->stock_minimo }}</p>
            <p><strong>Stock Bajo:</strong> {{ $product->stock_bajo }}</p>
            <p><strong>Stock Alto:</strong> {{ $product->stock_alto }}</p>

            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning mt-3">
                <i class="ti ti-edit"></i> Editar Producto
            </a>
            <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Volver</a>
        </div>
    </div>
</div>
@endsection