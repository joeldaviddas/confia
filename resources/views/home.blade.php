@extends('layouts.app')

@section('titulo', 'Dashboard')

@section('contenido')
<div class="container-fluid">
    <!-- Estadísticas -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <h6 class="dashboard-card-title">Productos</h6>
                    <div class="dashboard-card-icon">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
                <h3 class="dashboard-card-value">{{ number_format($stats['productos']) }}</h3>
                <p class="dashboard-card-subtitle">Total de productos registrados</p>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <h6 class="dashboard-card-title">Movimientos</h6>
                    <div class="dashboard-card-icon">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                </div>
                <h3 class="dashboard-card-value">{{ number_format($stats['movimientos']) }}</h3>
                <p class="dashboard-card-subtitle">Total de movimientos realizados</p>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <h6 class="dashboard-card-title">Personas</h6>
                    <div class="dashboard-card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <h3 class="dashboard-card-value">{{ number_format($stats['personas']) }}</h3>
                <p class="dashboard-card-subtitle">Total de personas registradas</p>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <h6 class="dashboard-card-title">Empresas</h6>
                    <div class="dashboard-card-icon">
                        <i class="fas fa-building"></i>
                    </div>
                </div>
                <h3 class="dashboard-card-value">{{ number_format($stats['empresas']) }}</h3>
                <p class="dashboard-card-subtitle">Total de empresas registradas</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Movimientos Recientes -->
        <div class="col-12 col-xl-8">
            <div class="table-container">
                <div class="table-header">
                    <h5 class="table-title">
                        <i class="fas fa-history"></i>
                        Movimientos Recientes
                    </h5>
                    <a href="{{ route('movimientos.index') }}" class="btn btn-primary btn-sm">
                        Ver Todos
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Persona</th>
                                <th>Tipo</th>
                                <th>Cantidad</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($movimientosRecientes as $movimiento)
                                @foreach($movimiento->detalles as $detalle)
                                <tr>
                                    <td>{{ $detalle->producto->nombre }}</td>
                                    <td>{{ $movimiento->persona->nombre }}</td>
                                    <td>
                                        <span class="badge {{ $movimiento->tipo === 'entrada' ? 'badge-success' : 'badge-danger' }}">
                                            {{ ucfirst($movimiento->tipo) }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($detalle->cantidad) }}</td>
                                    <td>{{ $movimiento->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Productos con Bajo Stock -->
        <div class="col-12 col-xl-4">
            <div class="table-container">
                <div class="table-header">
                    <h5 class="table-title">
                        <i class="fas fa-box text-primary"></i>
                        Productos Recientes
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Código</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productosBajoStock as $producto)
                                <tr>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ $producto->codigo }}</td>
                                    <td>{{ number_format($producto->valor_venta) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Movimientos -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <h5 class="dashboard-card-title">
                        <i class="fas fa-chart-line"></i>
                        Movimientos por Mes
                    </h5>
                </div>
                <div class="chart-container" style="height: 300px;">
                    <canvas id="movimientosChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('movimientosChart').getContext('2d');
    const data = @json($movimientosPorMes);
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.map(item => item.mes),
            datasets: [{
                label: 'Movimientos',
                data: data.map(item => item.total),
                borderColor: '#4F46E5',
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection
