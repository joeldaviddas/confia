@extends('layouts.auth')

@section('titulo', 'Verificar Correo Electrónico')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="auth-logo">
            <h1>Verificar Correo Electrónico</h1>
            <p class="auth-subtitle">Por favor, verifica tu dirección de correo electrónico</p>
        </div>

        <div class="auth-body">
            @if (session('resent'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="text-center mb-4">
                <div class="verification-icon mb-3">
                    <i class="fas fa-envelope"></i>
                </div>
                <p class="mb-3">Antes de continuar, por favor revisa tu correo electrónico para encontrar el enlace de verificación.</p>
                <p class="text-muted">Si no recibiste el correo, puedes solicitar otro:</p>
            </div>

            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-paper-plane me-2"></i>Reenviar correo de verificación
                    </button>
                </div>
            </form>

            <!-- Links -->
            <div class="auth-links text-center">
                <a href="{{ route('login') }}" class="d-block">
                    <i class="fas fa-arrow-left me-1"></i>Volver al inicio de sesión
                </a>
            </div>
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

.verification-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto;
    background: #e9ecef;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.verification-icon i {
    font-size: 28px;
    color: #6c757d;
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

.btn-primary {
    padding: 0.8rem 1.5rem;
    font-weight: 500;
}

.alert {
    border: none;
    border-radius: 0.5rem;
}

.alert-success {
    color: #0f5132;
    background-color: #d1e7dd;
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
