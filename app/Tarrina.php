<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Tarrina extends Model
{
    //
    use SoftDeletes;
    protected $table = "tarrinas";

    public function scopeDisponibles($query)
    {
        return $query->selectRaw('tarrinas.*')
            ->selectRaw('IFNULL(cnv_fact * cantidad, 0) as disponible')
            ->leftJoin('inventario', function ($join) {
                $join->on('inventario.categoria_id', 'tarrinas.id');
                $join->where('inventario.categoria', '=', 'Tarrina');
            });
    }
}
