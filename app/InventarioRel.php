<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InventarioRel extends Model
{
    //
    protected $table = "inventario_rel";

    public function scopeEntrada($query)
    {
        return $query->leftJoin('inventario as entrada', 'entrada.id', '=', 'inventario_rel.entrada_id');
    }

    public function scopeSalida($query)
    {
        return $query->leftJoin('inventario as salida', 'salida.id', '=', 'inventario_rel.salida_id');
    }
}
