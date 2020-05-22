<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TzEntrada extends Model
{
    //
    use SoftDeletes;
    protected $table = "tz_entradas";

    public function proveedor()
    {
        return $this->belongsTo(TzProveedor::class, 'proveedor_id');
    }

    public function producto()
    {
        return $this->belongsTo(ProductoCompuesto_det::class, 'producto_id');
    }

    public function salidas()
    {
        return $this->hasMany(TzSalida::class, 'entrada_id');
    }
}
