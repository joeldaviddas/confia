@extends('layouts.app')

@section('titulo', 'Gestión de Usuarios')

@push('styles')
<style>
    .user-table th {
        font-weight: 600;
        color: var(--gray-700);
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }

    .user-table td {
        vertical-align: middle;
        color: var(--gray-700);
    }

    .user-table tr:hover {
        background-color: var(--gray-50);
    }

    .badge {
        font-weight: 500;
        padding: 0.5rem 0.75rem;
        border-radius: 9999px;
    }

    .badge-admin {
        background-color: #818CF8;
        color: #fff;
    }

    .badge-user {
        background-color: #6B7280;
        color: #fff;
    }

    .btn-icon {
        padding: 0.5rem;
        border-radius: 9999px;
        transition: all 0.2s;
    }

    .btn-icon:hover {
        transform: translateY(-1px);
    }

    .empty-state {
        padding: 3rem 0;
        text-align: center;
    }

    .empty-state-icon {
        font-size: 3rem;
        color: var(--gray-400);
        margin-bottom: 1rem;
    }

    .empty-state-text {
        color: var(--gray-500);
        font-size: 1rem;
    }

    .card {
        border: none;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border-radius: 0.75rem;
    }

    .card-header {
        background-color: transparent;
        border-bottom: 1px solid var(--gray-200);
        padding: 1.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .table-container {
        margin: -1.5rem;
    }

    .user-email {
        color: var(--gray-600);
        text-decoration: none;
        transition: color 0.2s;
    }

    .user-email:hover {
        color: var(--primary-color);
    }

    .timestamp {
        color: var(--gray-500);
        font-size: 0.875rem;
    }

    .action-buttons {
        gap: 0.5rem;
    }

    .btn-action {
        padding: 0.5rem;
        border-radius: 0.5rem;
        transition: all 0.2s;
    }

    .btn-action:hover {
        transform: translateY(-1px);
    }

    .btn-action i {
        font-size: 0.875rem;
    }
</style>
@endpush

@section('contenido')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-users text-primary me-3 fa-lg"></i>
                            <h5 class="card-title mb-0">Usuarios del Sistema</h5>
                        </div>
                        <a class="btn btn-primary d-flex align-items-center gap-2" href="{{route('usuarios.create')}}">
                            <i class="fas fa-user-plus"></i>
                            <span class="d-none d-md-inline">Nuevo Usuario</span>
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 user-table">
                            <thead>
                                <tr>
                                    <th scope="col" class="ps-4">#</th>
                                    <th scope="col">
                                        <i class="fas fa-user me-2 text-gray-400"></i>Nombre
                                    </th>
                                    <th scope="col">
                                        <i class="fas fa-envelope me-2 text-gray-400"></i>Email
                                    </th>
                                    <th scope="col">
                                        <i class="fas fa-user-tag me-2 text-gray-400"></i>Rol
                                    </th>
                                    <th scope="col">
                                        <i class="fas fa-calendar me-2 text-gray-400"></i>Registro
                                    </th>
                                    <th scope="col">
                                        <i class="fas fa-clock me-2 text-gray-400"></i>Actualización
                                    </th>
                                    <th scope="col" class="text-center pe-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($usuarios as $usuario)
                                    <tr>
                                        <td class="ps-4">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($usuario->name) }}&background=4F46E5&color=fff" 
                                                     alt="{{ $usuario->name }}" 
                                                     class="rounded-circle me-2"
                                                     width="32"
                                                     height="32">
                                                <span>{{ $usuario->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $usuario->email }}" class="user-email">
                                                {{ $usuario->email }}
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge {{ $usuario->role === 'admin' ? 'badge-admin' : 'badge-user' }}">
                                                <i class="fas fa-{{ $usuario->role === 'admin' ? 'user-shield' : 'user' }} me-1"></i>
                                                {{ $usuario->role === 'admin' ? 'Administrador' : 'Usuario' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="timestamp">{{ $usuario->created_at->format('d/m/Y') }}</span>
                                                <small class="text-muted" title="{{ $usuario->created_at->format('H:i:s') }}">
                                                    {{ $usuario->created_at->format('H:i') }}
                                                </small>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="timestamp">{{ $usuario->updated_at->diffForHumans() }}</span>
                                                <small class="text-muted" title="{{ $usuario->updated_at->format('d/m/Y H:i:s') }}">
                                                    {{ $usuario->updated_at->format('d/m/Y') }}
                                                </small>
                                            </div>
                                        </td>
                                        <td class="pe-4">
                                            <div class="d-flex justify-content-center action-buttons">
                                                <a href="{{ route('usuarios.edit', $usuario->id) }}" 
                                                   class="btn btn-action btn-light"
                                                   data-bs-toggle="tooltip"
                                                   title="Editar usuario">
                                                    <i class="fas fa-edit text-primary"></i>
                                                </a>
                                                @if($usuario->id !== auth()->id() && $usuario->id !== 1)
                                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" 
                                                          method="POST" 
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-action btn-light"
                                                                data-bs-toggle="tooltip"
                                                                title="Eliminar usuario"
                                                                onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.')">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="empty-state">
                                                <i class="fas fa-users empty-state-icon"></i>
                                                <p class="empty-state-text">No hay usuarios registrados en el sistema</p>
                                                <a href="{{ route('usuarios.create') }}" class="btn btn-primary mt-3">
                                                    <i class="fas fa-user-plus me-2"></i>
                                                    Agregar el primer usuario
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar tooltips
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(tooltip => {
        new bootstrap.Tooltip(tooltip);
    });

    // Animación suave al eliminar usuarios
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (this.method.toLowerCase() === 'post' && this.querySelector('[name="_method"][value="DELETE"]')) {
                const row = this.closest('tr');
                if (row) {
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(20px)';
                }
            }
        });
    });
});
</script>
@endpush
