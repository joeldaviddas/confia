@extends('layouts.app')
@section('titulo', 'Crear Producto')
@section('contenido')
    <div class="row">
        <div class="col-md-12">
            <div class="card form-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Crear nuevo Producto</h4>
                    <a class="btn btn-outline-danger" href="{{ route('productos.index') }}">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </a>
                </div>

                <form action="{{ route('productos.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card-body">
                        <x-form-select
                            name="familia_id"
                            label="Familia"
                            :options="$familia"
                            placeholder="Selecciona una familia"
                            required
                        />

                        <x-form-select
                            name="ubicacion_id"
                            label="Ubicación"
                            :options="$ubicacion"
                            placeholder="Selecciona una ubicación"
                            required
                        />

                        <x-form-input
                            name="nombre"
                            label="Nombre"
                            placeholder="Escriba el nombre del producto"
                            required
                        />

                        <x-form-input
                            name="codigo"
                            label="Código"
                            placeholder="Escriba el código del producto"
                            required
                        />

                        <x-form-input
                            name="valor_compra"
                            label="Valor Compra"
                            type="number"
                            placeholder="Escriba el valor de la compra"
                            required
                        />

                        <x-form-input
                            name="valor_venta"
                            label="Valor Venta"
                            type="number"
                            placeholder="Escriba el valor de la venta"
                            required
                        />

                        <x-form-input
                            name="iva"
                            label="IVA"
                            type="number"
                            placeholder="Escriba el valor del IVA"
                            required
                        />
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Guardar Producto
                        </button>
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
