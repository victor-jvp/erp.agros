<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoCompuesto_cab extends Model
{
    protected $table = "productoscompuestos_cab";

    public function det()
    {
        return $this->belongsTo(ProductoCompuesto_cab::class, 'compuesto_id');
    }
}