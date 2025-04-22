<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipoMovimiento;
use App\Models\Persona;
use App\Models\MovimientoDetalle;
use App\Models\Producto;

class Movimiento extends Model
{
    use HasFactory;
    protected $table = 'movimiento';
    protected $guarded = [];

    public function tipoMovimiento()
    {
        return $this->belongsTo(TipoMovimiento::class);
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function detalles()
    {
        return $this->hasMany(MovimientoDetalle::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'movimiento_detalle')
                    ->withPivot(['nombre', 'cantidad', 'valor'])
                    ->withTimestamps();
    }
}
