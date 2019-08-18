<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caja extends Model
{
    //
    use SoftDeletes;
    protected $table = 'cajas';

    public function entradas()
    {
        return $this->hasMany(Entrada::class, 'caja_id');
    }

    public function salidas()
    {
        return $this->hasMany(Salida::class, 'caja_id');
    }
}
