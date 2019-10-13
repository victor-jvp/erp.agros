<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoCompuesto_tarrinas extends Model
{
    //
    protected $table = "productoscompuestos_tarrinas";

    public function tarrina()
    {
        return $this->belongsTo(Tarrina::class);
    }
}
