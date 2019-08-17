<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoCompuesto_auxiliares extends Model
{
    //
     protected $table = "productoscompuestos_auxiliares";

    public function auxiliar()
    {
        return $this->belongsTo(Auxiliar::class);
    }

    public function pallet_model()
    {
        return $this->belongsTo(PalletModel::class, 'model_id');
    }
}
