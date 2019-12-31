<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProveedorAdjunto extends Model
{
    protected $table = "proveedores_adjuntos";

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
}
