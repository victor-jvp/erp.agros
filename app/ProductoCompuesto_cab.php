<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoCompuesto_cab extends Model
{
    protected $table = "productoscompuestos_cab";

    public function cultivo()
    {
        return $this->belongsTo(Cultivo::class, 'cultivo_id');
    }

    public function det()
    {
        return $this->belongsTo(ProductoCompuesto_cab::class, 'compuesto_id');
    }
}