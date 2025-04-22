<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MovimientoDetalle;
use App\Models\Movimiento;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'producto';
    protected $guarded = [];

    public function movimientoDetalles()
    {
        return $this->hasMany(MovimientoDetalle::class);
    }

    public function movimientos()
    {
        return $this->belongsToMany(Movimiento::class, 'movimiento_detalle')
                    ->withPivot(['nombre', 'cantidad', 'valor'])
                    ->withTimestamps();
    }
}
