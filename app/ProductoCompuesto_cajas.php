<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoCompuesto_cajas extends Model
{
    //
    protected $table = "productoscompuestos_cajas";

    public function caja()
    {
        return $this->belongsTo(Caja::class);
    }
}
