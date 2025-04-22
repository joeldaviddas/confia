@extends('layouts.app')
@section('titulo', 'Nuevo Inventario')
@section('contenido')
<div class="container-fluid py-4">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="font-weight-bold mb-0">Nuevo Inventario</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('inventario.index') }}" class="text-decoration-none">Inventarios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo Inventario</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main content -->
    <div class="card form-card">
        <div class="card-body">
            <form action="{{ route('inventario.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <x-form-select
                            name="producto_id"
                            label="Producto"
                            :options="$producto"
                            placeholder="Seleccione un producto"
                            required
                            help="Seleccione el producto para registrar en inventario."
                        />

                        <x-form-input
                            name="saldo"
                            label="Saldo Inicial"
                            type="number"
                            placeholder="Ej: 100"
                            required
                            help="Ingrese la cantidad inicial disponible del producto."
                            min="0"
                        />

                        <div class="form-actions">
                            <a href="{{ route('inventario.index') }}" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Inventario
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link href="{{ asset('css/forms.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script>
        // Form validation
        (function() {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
@endpush
