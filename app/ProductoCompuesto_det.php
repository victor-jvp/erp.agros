<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoCompuesto_det extends Model
{
    protected $table = "productosCompuestos_det";

    public function cab()
    {
        return $this->belongsTo(App\ProductoCompuesto_cab::class);
    }
}
