@extends('layouts.app')
@section('titulo', 'Nueva Persona')
@section('contenido')
<div class="container-fluid py-4">
    <!-- Page header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="font-weight-bold mb-0">Nueva Persona</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}" class="text-decoration-none">Personas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nueva Persona</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main content -->
    <div class="card form-card">
        <div class="card-body">
            <form action="{{ route('personas.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <x-form-select
                            name="tipo_persona_id"
                            label="Tipo de Persona"
                            :options="$tipo_persona"
                            placeholder="Seleccione un tipo de persona"
                            required
                            help="Seleccione la categoría o tipo de persona."
                            class="select2"
                        />

                        <div class="row">
                            <div class="col-md-6">
                                <x-form-input
                                    name="nombre"
                                    label="Nombre"
                                    placeholder="Ej: Juan"
                                    required
                                    help="Ingrese el nombre de la persona."
                                />
                            </div>
                            <div class="col-md-6">
                                <x-form-input
                                    name="apellido"
                                    label="Apellido"
                                    placeholder="Ej: Pérez"
                                    required
                                    help="Ingrese el apellido de la persona."
                                />
                            </div>
                        </div>

                        <x-form-input
                            name="documento"
                            label="Documento de Identidad"
                            placeholder="Ej: 1234567890"
                            required
                            help="Ingrese el número de documento de identidad."
                            pattern="[0-9]*"
                        />

                        <x-form-input
                            name="celular"
                            label="Teléfono Celular"
                            type="tel"
                            placeholder="Ej: 3001234567"
                            required
                            help="Ingrese el número de teléfono celular."
                            pattern="[0-9]*"
                        />

                        <x-form-input
                            name="email"
                            label="Correo Electrónico"
                            type="email"
                            placeholder="Ej: juan.perez@ejemplo.com"
                            required
                            help="Ingrese un correo electrónico válido."
                        />

                        <x-form-input
                            name="password"
                            label="Contraseña"
                            type="password"
                            placeholder="********"
                            required
                            help="Ingrese una contraseña segura (mínimo 8 caracteres)."
                            minlength="8"
                        />

                        <div class="form-actions">
                            <a href="{{ route('personas.index') }}" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Persona
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
