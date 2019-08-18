<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salida extends Model
{
    use SoftDeletes;
    protected $table = "salidas";

    public function pallet()
    {
        return $this->belongsTo(Pallet::class, 'pallet_id');
    }

    public function caja()
    {
        return $this->belongsTo(Caja::class, 'caja_id');
    }
}
