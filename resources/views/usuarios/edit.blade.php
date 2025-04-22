@extends('layouts.app')
@section('titulo', 'Editar Usuario')
@section('contenido')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user-edit me-2"></i>Editar Usuario
                        </h5>
                        <a class="btn btn-outline-secondary" href="{{route('usuarios.index')}}" role="button">
                            <i class="fas fa-arrow-left me-1"></i>Volver
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-1"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form class="needs-validation" action="{{ route('usuarios.update', $usuario->id) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">
                                <i class="fas fa-user me-1"></i>Nombre
                            </label>
                            <div class="col-sm-9">
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $usuario->name) }}" 
                                       required
                                       pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]{2,}"
                                       minlength="2"
                                       maxlength="255">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">
                                        Por favor ingresa un nombre válido (mínimo 2 caracteres)
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label">
                                <i class="fas fa-envelope me-1"></i>Email
                            </label>
                            <div class="col-sm-9">
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $usuario->email) }}" 
                                       required
                                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">
                                        Por favor ingresa un correo electrónico válido
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-sm-3 col-form-label">
                                <i class="fas fa-lock me-1"></i>Nueva Contraseña
                            </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password"
                                           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
                                    <button class="btn btn-outline-secondary" 
                                            type="button" 
                                            onclick="togglePasswordVisibility('password')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback">
                                            La contraseña debe tener al menos 8 caracteres, una mayúscula, 
                                            una minúscula, un número y un símbolo
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-text">
                                    <small>
                                        <i class="fas fa-info-circle"></i>
                                        Dejar en blanco para mantener la contraseña actual. Si se cambia, debe tener al menos 
                                        8 caracteres, una mayúscula, una minúscula, un número y un símbolo
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password_confirmation" class="col-sm-3 col-form-label">
                                <i class="fas fa-lock me-1"></i>Confirmar
                            </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control" 
                                           id="password_confirmation" 
                                           name="password_confirmation">
                                    <button class="btn btn-outline-secondary" 
                                            type="button" 
                                            onclick="togglePasswordVisibility('password_confirmation')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <div class="invalid-feedback">
                                        Las contraseñas no coinciden
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-sm-3 col-form-label">
                                <i class="fas fa-user-tag me-1"></i>Rol
                            </label>
                            <div class="col-sm-9">
                                <select class="form-select @error('role') is-invalid @enderror" 
                                        id="role" 
                                        name="role" 
                                        required>
                                    <option value="">Selecciona un rol</option>
                                    <option value="admin" {{ old('role', $usuario->role) === 'admin' ? 'selected' : '' }}>
                                        <i class="fas fa-user-shield"></i> Administrador
                                    </option>
                                    <option value="user" {{ old('role', $usuario->role) === 'user' ? 'selected' : '' }}>
                                        <i class="fas fa-user"></i> Usuario
                                    </option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">
                                        Por favor selecciona un rol
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Actualizar Usuario
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Validación del lado del cliente
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})()

// Función para mostrar/ocultar contraseña
function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Validación de contraseñas iguales
const password = document.getElementById('password');
const confirmation = document.getElementById('password_confirmation');

function validatePasswords() {
    if (password.value !== confirmation.value) {
        confirmation.setCustomValidity('Las contraseñas no coinciden');
    } else {
        confirmation.setCustomValidity('');
    }
}

password.addEventListener('change', validatePasswords);
confirmation.addEventListener('keyup', validatePasswords);
</script>
@endpush
@endsection
