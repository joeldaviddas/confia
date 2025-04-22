@extends('layouts.app')

@section('titulo', 'Crear Usuario')

@push('styles')
<style>
    .form-card {
        border: none;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border-radius: 1rem;
    }

    .form-card .card-header {
        background: transparent;
        border-bottom: 1px solid var(--gray-200);
        padding: 1.5rem;
    }

    .form-card .card-body {
        padding: 2rem;
    }

    .form-label {
        font-weight: 500;
        color: var(--gray-700);
        margin-bottom: 0.5rem;
    }

    .form-control,
    .form-select {
        border: 1px solid var(--gray-300);
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .input-group .btn {
        padding: 0.75rem;
        border: 1px solid var(--gray-300);
        background: white;
        color: var(--gray-500);
        transition: all 0.2s;
    }

    .input-group .btn:hover {
        background: var(--gray-50);
        color: var(--gray-700);
    }

    .password-requirements {
        margin-top: 0.5rem;
        padding: 1rem;
        background: var(--gray-50);
        border-radius: 0.5rem;
        font-size: 0.875rem;
    }

    .password-requirement {
        color: var(--gray-500);
        margin-bottom: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .password-requirement.valid {
        color: var(--success-color);
    }

    .password-requirement i {
        font-size: 0.75rem;
    }

    .role-option {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .role-option i {
        color: var(--gray-500);
    }

    .btn-submit {
        padding: 0.75rem 2rem;
        font-weight: 500;
    }

    .back-button {
        color: var(--gray-700);
        transition: all 0.2s;
    }

    .back-button:hover {
        color: var(--primary-color);
        transform: translateX(-2px);
    }
</style>
@endpush

@section('contenido')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card form-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-plus text-primary me-3 fa-lg"></i>
                            <h5 class="card-title mb-0">Crear nuevo Usuario</h5>
                        </div>
                        <a class="btn back-button" href="{{route('usuarios.index')}}" title="Volver al listado">
                            <i class="fas fa-arrow-left me-2"></i>
                            <span class="d-none d-md-inline">Volver</span>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form class="needs-validation" action="{{ route('usuarios.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="row g-4">
                            <!-- Nombre -->
                            <div class="col-12">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user text-primary me-2"></i>Nombre
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required
                                       pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]{2,}"
                                       minlength="2"
                                       maxlength="255"
                                       placeholder="Ingresa el nombre completo">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">
                                        Por favor ingresa un nombre válido (mínimo 2 caracteres)
                                    </div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-12">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope text-primary me-2"></i>Email
                                </label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required
                                       pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                       placeholder="ejemplo@dominio.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">
                                        Por favor ingresa un correo electrónico válido
                                    </div>
                                @enderror
                            </div>

                            <!-- Contraseña -->
                            <div class="col-md-6">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock text-primary me-2"></i>Contraseña
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           required
                                           minlength="8"
                                           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
                                    <button class="btn" 
                                            type="button" 
                                            onclick="togglePasswordVisibility('password')"
                                            title="Mostrar/Ocultar contraseña">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback">
                                            La contraseña debe cumplir con todos los requisitos
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">
                                    <i class="fas fa-lock text-primary me-2"></i>Confirmar Contraseña
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           required>
                                    <button class="btn" 
                                            type="button" 
                                            onclick="togglePasswordVisibility('password_confirmation')"
                                            title="Mostrar/Ocultar contraseña">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <div class="invalid-feedback">
                                        Por favor confirma la contraseña
                                    </div>
                                </div>
                            </div>

                            <!-- Requisitos de contraseña -->
                            <div class="col-12">
                                <div class="password-requirements">
                                    <div class="password-requirement" id="length-check">
                                        <i class="fas fa-circle"></i>
                                        Mínimo 8 caracteres
                                    </div>
                                    <div class="password-requirement" id="uppercase-check">
                                        <i class="fas fa-circle"></i>
                                        Al menos una mayúscula
                                    </div>
                                    <div class="password-requirement" id="lowercase-check">
                                        <i class="fas fa-circle"></i>
                                        Al menos una minúscula
                                    </div>
                                    <div class="password-requirement" id="number-check">
                                        <i class="fas fa-circle"></i>
                                        Al menos un número
                                    </div>
                                    <div class="password-requirement" id="special-check">
                                        <i class="fas fa-circle"></i>
                                        Al menos un símbolo (@$!%*?&)
                                    </div>
                                    <div class="password-requirement" id="match-check">
                                        <i class="fas fa-circle"></i>
                                        Las contraseñas coinciden
                                    </div>
                                </div>
                            </div>

                            <!-- Rol -->
                            <div class="col-12">
                                <label for="role" class="form-label">
                                    <i class="fas fa-user-tag text-primary me-2"></i>Rol
                                </label>
                                <select class="form-select @error('role') is-invalid @enderror" 
                                        id="role" 
                                        name="role" 
                                        required>
                                    <option value="">Selecciona un rol</option>
                                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                                        <span class="role-option">
                                            <i class="fas fa-user-shield"></i>
                                            Administrador
                                        </span>
                                    </option>
                                    <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>
                                        <span class="role-option">
                                            <i class="fas fa-user"></i>
                                            Usuario
                                        </span>
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

                            <!-- Botón Submit -->
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary btn-submit">
                                    <i class="fas fa-save me-2"></i>Crear Usuario
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validación del formulario
    const form = document.querySelector('.needs-validation');
    const password = document.getElementById('password');
    const passwordConfirm = document.getElementById('password_confirmation');

    // Elementos de requisitos
    const lengthCheck = document.getElementById('length-check');
    const uppercaseCheck = document.getElementById('uppercase-check');
    const lowercaseCheck = document.getElementById('lowercase-check');
    const numberCheck = document.getElementById('number-check');
    const specialCheck = document.getElementById('special-check');
    const matchCheck = document.getElementById('match-check');

    // Función para validar la contraseña
    function validatePassword() {
        const pass = password.value;
        const confirm = passwordConfirm.value;

        // Validar longitud
        if (pass.length >= 8) {
            lengthCheck.classList.add('valid');
            lengthCheck.querySelector('i').classList.replace('fa-circle', 'fa-check-circle');
        } else {
            lengthCheck.classList.remove('valid');
            lengthCheck.querySelector('i').classList.replace('fa-check-circle', 'fa-circle');
        }

        // Validar mayúscula
        if (/[A-Z]/.test(pass)) {
            uppercaseCheck.classList.add('valid');
            uppercaseCheck.querySelector('i').classList.replace('fa-circle', 'fa-check-circle');
        } else {
            uppercaseCheck.classList.remove('valid');
            uppercaseCheck.querySelector('i').classList.replace('fa-check-circle', 'fa-circle');
        }

        // Validar minúscula
        if (/[a-z]/.test(pass)) {
            lowercaseCheck.classList.add('valid');
            lowercaseCheck.querySelector('i').classList.replace('fa-circle', 'fa-check-circle');
        } else {
            lowercaseCheck.classList.remove('valid');
            lowercaseCheck.querySelector('i').classList.replace('fa-check-circle', 'fa-circle');
        }

        // Validar número
        if (/\d/.test(pass)) {
            numberCheck.classList.add('valid');
            numberCheck.querySelector('i').classList.replace('fa-circle', 'fa-check-circle');
        } else {
            numberCheck.classList.remove('valid');
            numberCheck.querySelector('i').classList.replace('fa-check-circle', 'fa-circle');
        }

        // Validar símbolo especial
        if (/[@$!%*?&]/.test(pass)) {
            specialCheck.classList.add('valid');
            specialCheck.querySelector('i').classList.replace('fa-circle', 'fa-check-circle');
        } else {
            specialCheck.classList.remove('valid');
            specialCheck.querySelector('i').classList.replace('fa-check-circle', 'fa-circle');
        }

        // Validar coincidencia
        if (pass === confirm && pass !== '') {
            matchCheck.classList.add('valid');
            matchCheck.querySelector('i').classList.replace('fa-circle', 'fa-check-circle');
        } else {
            matchCheck.classList.remove('valid');
            matchCheck.querySelector('i').classList.replace('fa-check-circle', 'fa-circle');
        }
    }

    // Eventos para validar la contraseña
    password.addEventListener('input', validatePassword);
    passwordConfirm.addEventListener('input', validatePassword);

    // Validación del formulario antes de enviar
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });
});

// Función para mostrar/ocultar contraseña
function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>
@endpush
