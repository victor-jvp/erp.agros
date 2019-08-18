<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pallet extends Model
{
    //
    use SoftDeletes;
    protected $table = "pallets";

    public function modelo()
    {
        return $this->belongsTo(PalletModel::class);
    }

    public function entradas()
    {
        return $this->hasMany(Entrada::class, 'pallet_id');
    }

    public function salidas()
    {
        return $this->hasMany(Salida::class, 'pallet_id');
    }


}
