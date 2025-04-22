<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movimiento;
use App\Models\Producto;

class MovimientoDetalle extends Model
{
    use HasFactory;
    protected $table = 'movimiento_detalle';
    protected $guarded = [];

    public function movimiento()
    {
        return $this->belongsTo(Movimiento::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
