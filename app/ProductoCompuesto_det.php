<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoCompuesto_det extends Model
{
    protected $table = "productoscompuestos_det";

    public function tarrinas()
    {
        return $this->hasMany(ProductoCompuesto_tarrinas::class);
    }

    public function caja()
    {
        return $this->belongsTo(Caja::class);
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
