@extends('layouts.app')
@section('titulo', 'Nuevo Tipo de Movimiento')
@section('contenido')
<div class="container-fluid py-4">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="font-weight-bold mb-0">Nuevo Tipo de Movimiento</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('tipo-movimiento.index') }}" class="text-decoration-none">Tipos de Movimiento</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo Tipo</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main content -->
    <div class="card form-card">
        <div class="card-body">
            <form action="{{ route('tipo-movimiento.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <x-form-input
                            name="nombre"
                            label="Nombre del Movimiento"
                            placeholder="Ej: Entrada por Compra"
                            required
                            help="Ingrese un nombre descriptivo para el tipo de movimiento."
                        />

                        <x-form-input
                            name="suma"
                            type="number"
                            label="Valor de Suma"
                            placeholder="1 para entrada, -1 para salida"
                            required
                            help="Ingrese 1 para movimientos que suman al inventario (entradas) o -1 para los que restan (salidas)."
                            min="-1"
                            max="1"
                            step="2"
                        />

                        <div class="form-actions">
                            <a href="{{ route('tipo-movimiento.index') }}" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Tipo
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
