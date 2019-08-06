<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoCompuesto_det extends Model
{
    protected $table = "productoscompuestos_det";

    public function tarrinas()
    {
        return $this->hasMany(ProductoCompuesto_tarrinas::class, 'det_id');
    }

    public function auxiliares()
    {
        return $this->hasMany(ProductoCompuesto_auxiliares::class, 'det_id');
    }

    public function caja()
    {
        return $this->belongsTo(Caja::class);
    }

    public function cubre()
    {
        return $this->belongsTo(Cubre::class);
    }

    public function euro_pallet()
    {
        return $this->belongsTo(Pallet::class);
    }

    public function grand_pallet()
    {
        return $this->belongsTo(Pallet::class);
    }
}
