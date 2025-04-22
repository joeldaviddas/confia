<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Movimiento;
use App\Models\Persona;
use App\Models\Empresa;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Estadísticas generales
        $stats = [
            'productos' => Producto::count(),
            'movimientos' => Movimiento::count(),
            'personas' => Persona::count(),
            'empresas' => Empresa::count()
        ];

        // Movimientos recientes
        $movimientosRecientes = Movimiento::with(['detalles.producto', 'persona'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Productos recientes en lugar de productos con bajo stock
        $productosBajoStock = Producto::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Gráfico de movimientos por mes
        $movimientosPorMes = Movimiento::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->get()
            ->map(function ($item) {
                return [
                    'mes' => Carbon::create()->month($item->mes)->format('M'),
                    'total' => $item->total
                ];
            });

        return view('home', compact('stats', 'movimientosRecientes', 'productosBajoStock', 'movimientosPorMes'));
    }
}
