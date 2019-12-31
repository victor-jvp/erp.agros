<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoCompuesto_palets_auxiliares extends Model
{
    //
    protected $table = "productoscompuestos_palets_auxiliares";

    public function auxiliar()
    {
        return $this->belongsTo(Auxiliar::class);
    }
}
