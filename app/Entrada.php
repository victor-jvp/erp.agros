<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    //

    protected $table = "entradas";

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function pallet()
    {
        return $this->belongsTo(Pallet::class, 'pallet_id');
    }
}
