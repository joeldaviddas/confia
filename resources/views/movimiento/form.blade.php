@extends('layouts.app')
@section('titulo', 'Nuevo Movimiento')
@section('contenido')
<div class="container-fluid py-4">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="font-weight-bold mb-0">Nuevo Movimiento</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('movimientos.index') }}" class="text-decoration-none">Movimientos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo Movimiento</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main content -->
    <div class="card form-card">
        <div class="card-body">
            <form action="{{ route('movimientos.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <x-form-select
                            name="tipo_movimiento_id"
                            label="Tipo de Movimiento"
                            :options="$tipo_movimiento"
                            placeholder="Seleccione un tipo de movimiento"
                            required
                            help="Seleccione el tipo de movimiento a realizar."
                        />

                        <x-form-select
                            name="persona_id"
                            label="Persona"
                            :options="$persona"
                            placeholder="Seleccione una persona"
                            required
                            help="Seleccione la persona asociada al movimiento."
                            class="select2"
                        />

                        <x-form-input
                            name="nombre"
                            label="Nombre del Movimiento"
                            placeholder="Ej: Entrada de mercancía"
                            required
                            help="Ingrese un nombre descriptivo para el movimiento."
                        />

                        <x-form-input
                            name="fecha"
                            label="Fecha del Movimiento"
                            type="date"
                            required
                            help="Seleccione la fecha en que se realiza el movimiento."
                        />

                        <div class="form-actions">
                            <a href="{{ route('movimientos.index') }}" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Movimiento
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
