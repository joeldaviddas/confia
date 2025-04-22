@extends('layouts.app')
@section('titulo', 'Dashboard')
@section('contenido')
<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body p-4">
                    <h4 class="mb-2">¡Bienvenido al Sistema de Gestión!</h4>
                    <p class="mb-0">Administra tus productos, inventario y movimientos de manera eficiente.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                                <i class="fas fa-box fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-1">Total Productos</h6>
                            <h4 class="mb-0">{{ App\Models\Producto::count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="rounded-circle bg-success bg-opacity-10 p-3">
                                <i class="fas fa-users fa-2x text-success"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-1">Total Personas</h6>
                            <h4 class="mb-0">{{ App\Models\Persona::count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                                <i class="fas fa-exchange-alt fa-2x text-warning"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-1">Movimientos</h6>
                            <h4 class="mb-0">{{ App\Models\Movimiento::count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="rounded-circle bg-info bg-opacity-10 p-3">
                                <i class="fas fa-building fa-2x text-info"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-1">Empresas</h6>
                            <h4 class="mb-0">{{ App\Models\Empresa::count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-12 col-xl-8 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Últimos Movimientos</h5>
                    <a href="{{ route('movimientos.index') }}" class="btn btn-sm btn-primary">Ver Todos</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Persona</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\Movimiento::latest()->take(5)->get() as $movimiento)
                                <tr>
                                    <td>{{ $movimiento->created_at->format('d/m/Y') }}</td>
                                    <td>{{ optional($movimiento->tipoMovimiento)->nombre }}</td>
                                    <td>{{ optional($movimiento->persona)->nombre }}</td>
                                    <td>
                                        <span class="badge bg-success">Completado</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Accesos Rápidos</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('productos.create') }}" class="btn btn-outline-primary">
                            <i class="fas fa-plus-circle me-2"></i>Nuevo Producto
                        </a>
                        <a href="{{ route('movimientos.create') }}" class="btn btn-outline-success">
                            <i class="fas fa-exchange-alt me-2"></i>Nuevo Movimiento
                        </a>
                        <a href="{{ route('personas.create') }}" class="btn btn-outline-info">
                            <i class="fas fa-user-plus me-2"></i>Nueva Persona
                        </a>
                        <a href="{{ route('inventarios.index') }}" class="btn btn-outline-warning">
                            <i class="fas fa-boxes me-2"></i>Ver Inventario
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Add any dashboard-specific JavaScript here
    });
</script>
@endpush
@endsection
