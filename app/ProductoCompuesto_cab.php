<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoCompuesto_cab extends Model
{
    protected $table = "productoscompuestos_cab";

    public function dets()
    {
        return $this->hasMany(App\ProductoCompuesto_det::class);
    }
}
