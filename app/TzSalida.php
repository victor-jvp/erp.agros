<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TzSalida extends Model
{
    //
    use SoftDeletes;
    protected $table = "tz_salidas";

    public function proveedor()
    {
        return $this->belongsTo(TzProveedor::class, 'proveedor_id');
    }

    public function articulo()
    {
        return $this->belongsTo(TzArticulo::class, 'articulo_id');
    }

    public function cliente()
    {
        return $this->belongsTo(TzCliente::class, 'cliente_id');
    }

    public function entrada()
    {
        return $this->belongsTo(TzEntrada::class, 'entrada_id');
    }
}
