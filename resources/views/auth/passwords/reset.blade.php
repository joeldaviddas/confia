@extends('layouts.auth')

@section('titulo', 'Restablecer Contraseña')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="auth-logo">
            <h1>Restablecer Contraseña</h1>
            <p class="auth-subtitle">Ingresa tu nueva contraseña para continuar</p>
        </div>

        <div class="auth-body">
            <form method="POST" action="{{ route('password.update') }}" class="needs-validation" novalidate>
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Email -->
                <div class="form-floating mb-3">
                    <input 
                        id="email" 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ $email ?? old('email') }}" 
                        placeholder="nombre@ejemplo.com"
                        required 
                        autocomplete="email" 
                        autofocus
                    >
                    <label for="email">Correo electrónico</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-floating mb-3">
                    <input 
                        id="password" 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        name="password" 
                        placeholder="Contraseña"
                        required 
                        autocomplete="new-password"
                        minlength="8"
                    >
                    <label for="password">Nueva contraseña</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @else
                        <div class="form-text">La contraseña debe tener al menos 8 caracteres.</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-floating mb-4">
                    <input 
                        id="password-confirm" 
                        type="password" 
                        class="form-control" 
                        name="password_confirmation" 
                        placeholder="Confirmar contraseña"
                        required 
                        autocomplete="new-password"
                        minlength="8"
                    >
                    <label for="password-confirm">Confirmar contraseña</label>
                </div>

                <!-- Submit Button -->
                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-key me-2"></i>Restablecer contraseña
                    </button>
                </div>

                <!-- Links -->
                <div class="auth-links text-center">
                    <a href="{{ route('login') }}" class="d-block">
                        <i class="fas fa-arrow-left me-1"></i>Volver al inicio de sesión
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.auth-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
}

.auth-card {
    width: 100%;
    max-width: 420px;
    background: white;
    border-radius: 1rem;
    box-shadow: 0 0 40px rgba(0,0,0,0.1);
    overflow: hidden;
}

.auth-header {
    padding: 2rem;
    text-align: center;
    background: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
}

.auth-logo {
    height: 60px;
    margin-bottom: 1rem;
}

.auth-header h1 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #212529;
    margin-bottom: 0.5rem;
}

.auth-subtitle {
    color: #6c757d;
    margin-bottom: 0;
}

.auth-body {
    padding: 2rem;
}

.auth-links a {
    color: #0d6efd;
    text-decoration: none;
    transition: color 0.15s ease-in-out;
}

.auth-links a:hover {
    color: #0a58ca;
    text-decoration: underline;
}

.form-floating > .form-control:focus,
.form-floating > .form-control:not(:placeholder-shown) {
    padding-top: 1.625rem;
    padding-bottom: 0.625rem;
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label {
    opacity: .65;
    transform: scale(.85) translateY(-0.5rem) translateX(0.15rem);
}

.btn-primary {
    padding: 0.8rem 1.5rem;
    font-weight: 500;
}

.invalid-feedback,
.form-text {
    font-size: 0.875rem;
}

@media (max-width: 576px) {
    .auth-container {
        padding: 1rem;
    }

    .auth-card {
        border-radius: 0.5rem;
    }

    .auth-header,
    .auth-body {
        padding: 1.5rem;
    }
}
</style>
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

        // Password confirmation validation
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password-confirm');

        function validatePassword() {
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity('Las contraseñas no coinciden');
            } else {
                confirmPassword.setCustomValidity('');
            }
        }

        password.addEventListener('change', validatePassword);
        confirmPassword.addEventListener('keyup', validatePassword);
    })();
</script>
@endpush
