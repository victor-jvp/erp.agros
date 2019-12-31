<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Auxiliar extends Model
{
    //
    use SoftDeletes;
    protected $table = 'auxiliares';

    public function scopeDisponibles($query)
    {
        return $query->selectRaw('auxiliares.*')
            ->selectRaw('IFNULL(cnv_fact * cantidad, 0) as disponible')
            ->leftJoin('inventario', function ($join) {
                $join->on('inventario.categoria_id', 'auxiliares.id');
                $join->where('inventario.categoria', '=', 'Auxiliar');
            });
    }
}
