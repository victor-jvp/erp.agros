<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inventario extends Model
{
    protected $fillable = [
        'categoria',
        'categoria_id',
        'material',
        'entradas',
        'salidas',
        'total'
    ];

    public function scopeStock($query)
    {
        return DB::select('call fn_stock');
    }
}
