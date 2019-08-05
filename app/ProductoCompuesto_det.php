<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoCompuesto_det extends Model
{
    protected $table = "productoscompuestos_det";

    public function cab()
    {
        return $this->belongsTo(App\ProductoCompuesto_cab::class);
    }

    public function tarrinas()
    {
        return $this->hasMany(App\ProductoCompueso_tarrinas::class);
    }
}
