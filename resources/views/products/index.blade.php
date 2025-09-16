@extends('layouts.vuexy')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Gestión de Productos /</span> Lista de Productos</h4>
        <div class="card">
            <h5 class="card-header">Productos Registrados</h5>
            <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
                <i class="ti ti-plus"></i> Agregar Nuevo Producto
            </a>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>SKU</th>
                            <th>Nombre</th>
                            <th>Precio Neto</th>
                            <th>Stock Actual</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->nombre }}</td>
                                <td>${{ number_format($product->precio_neto, 0, ',', '.') }}</td>
                                <td>{{ $product->stock_actual }}</td>
                                <td>
                                    {{-- Botones de acción --}}
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-icon btn-info">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-icon btn-warning">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-danger"
                                            onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection