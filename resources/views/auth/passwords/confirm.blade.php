@extends('layouts.auth')

@section('titulo', 'Confirmar Contraseña')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="auth-logo">
            <h1>Confirmar Contraseña</h1>
            <p class="auth-subtitle">Por favor, confirma tu contraseña para continuar</p>
        </div>

        <div class="auth-body">
            <form method="POST" action="{{ route('password.confirm') }}" class="needs-validation" novalidate>
                @csrf

                <!-- Password -->
                <div class="form-floating mb-4">
                    <input 
                        id="password" 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        name="password" 
                        placeholder="Contraseña"
                        required 
                        autocomplete="current-password"
                        autofocus
                    >
                    <label for="password">Contraseña</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-lock me-2"></i>Confirmar contraseña
                    </button>
                </div>

                <!-- Links -->
                <div class="auth-links text-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="d-block mb-2">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
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

.invalid-feedback {
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
    })();
</script>
@endpush
