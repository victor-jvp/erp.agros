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

    public function pallet_model()
    {
        return $this->belongsTo(PalletModel::class, 'model_id');
    }
}
