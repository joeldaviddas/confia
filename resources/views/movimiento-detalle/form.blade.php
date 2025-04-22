@extends('layouts.app')
@section('titulo', 'Nuevo Detalle de Movimiento')
@section('contenido')
<div class="container-fluid py-4">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="font-weight-bold mb-0">Nuevo Detalle de Movimiento</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('movimiento-detalles.index') }}" class="text-decoration-none">Detalles de Movimientos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo Detalle</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main content -->
    <div class="card form-card">
        <div class="card-body">
            <form action="{{ route('movimiento-detalles.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <x-form-select
                            name="movimiento_id"
                            label="Movimiento"
                            :options="$movimiento"
                            placeholder="Seleccione un movimiento"
                            required
                            help="Seleccione el movimiento al que pertenece este detalle."
                            class="select2"
                        />

                        <x-form-select
                            name="producto_id"
                            label="Producto"
                            :options="$producto"
                            placeholder="Seleccione un producto"
                            required
                            help="Seleccione el producto involucrado en este movimiento."
                            class="select2"
                        />

                        <x-form-input
                            name="nombre"
                            label="Descripción"
                            placeholder="Ej: Entrada de mercancía - Lote A"
                            required
                            help="Ingrese una descripción breve para este detalle de movimiento."
                        />

                        <x-form-input
                            name="cantidad"
                            label="Cantidad"
                            type="number"
                            placeholder="Ej: 100"
                            required
                            help="Ingrese la cantidad de unidades del producto."
                            min="1"
                            step="1"
                        />

                        <x-form-input
                            name="valor"
                            label="Valor Unitario"
                            type="number"
                            placeholder="Ej: 50000"
                            required
                            help="Ingrese el valor unitario del producto."
                            min="0"
                            step="0.01"
                        />

                        <div class="form-actions">
                            <a href="{{ route('movimiento-detalles.index') }}" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Detalle
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // Initialize Select2
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%'
            });
        });

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
