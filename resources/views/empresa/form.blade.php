@extends('layouts.app')
@section('titulo', 'Nueva Empresa')
@section('contenido')
<div class="container-fluid py-4">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="font-weight-bold mb-0">Nueva Empresa</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('empresa.index') }}" class="text-decoration-none">Empresas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nueva Empresa</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main content -->
    <div class="card form-card">
        <div class="card-body">
            <form action="{{ route('empresa.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <x-form-input
                            name="nombre"
                            label="Nombre de la Empresa"
                            placeholder="Ej: Empresa ABC S.A.S"
                            required
                            autofocus
                            help="Ingrese el nombre completo de la empresa."
                        />

                        <x-form-input
                            name="nit"
                            label="NIT"
                            type="number"
                            placeholder="Ej: 900123456"
                            required
                            help="Número de Identificación Tributaria sin dígito de verificación."
                        />

                        <x-form-input
                            name="regimen"
                            label="Régimen"
                            placeholder="Ej: Común, Simplificado"
                            required
                            help="Especifique el régimen tributario de la empresa."
                        />

                        <x-form-input
                            name="representante_legal"
                            label="Representante Legal"
                            placeholder="Ej: Juan Pérez"
                            required
                            help="Nombre completo del representante legal de la empresa."
                        />

                        <x-form-input
                            name="documento_representante_legal"
                            label="Documento Representante Legal"
                            type="number"
                            placeholder="Ej: 1234567890"
                            required
                            help="Número de documento de identidad del representante legal."
                        />

                        <x-form-input
                            name="direccion"
                            label="Dirección"
                            placeholder="Ej: Calle 123 #45-67, Ciudad"
                            required
                            help="Dirección completa de la empresa incluyendo ciudad."
                        />

                        <x-form-input
                            name="telefono"
                            label="Teléfono"
                            type="tel"
                            placeholder="Ej: 3001234567"
                            required
                            help="Número de teléfono principal de contacto."
                        />

                        <div class="form-actions">
                            <a href="{{ route('empresa.index') }}" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Empresa
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
