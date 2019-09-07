<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    //
    use SoftDeletes;
    protected $table = "proveedores";

    public function entradas()
    {
        return $this->hasMany(Entrada::class);
    }

    public function contactos()
    {
        return $this->hasMany(ProveedorContactos::class);
    }

    public function adjuntos()
    {
        return $this->hasMany(ProveedorAdjunto::class);
    }
}
