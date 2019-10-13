<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoCompuesto_det extends Model
{
    protected $table = "productoscompuestos_det";

    public function caja()
    {
        return $this->belongsTo(Caja::class);
    }

    public function euro_cubre()
    {
        return $this->belongsTo(Cubre::class, 'euro_cubre_id');
    }

    public function grand_cubre()
    {
        return $this->belongsTo(Cubre::class, 'grand_cubre_id');
    }

    public function tarrinas()
    {
        return $this->hasMany(ProductoCompuesto_tarrinas::class, 'det_id');
    }

    public function auxiliares()
    {
        return $this->hasMany(ProductoCompuesto_auxiliares::class, 'det_id');
    }

    public function palets_auxiliares()
    {
        return $this->hasMany(ProductoCompuesto_palets_auxiliares::class, 'det_id');
    }
}
