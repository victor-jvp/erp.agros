<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProveedorContactos extends Model
{
    use SoftDeletes;
    protected $table = "proveedores_contactos";
    protected $fillable = [
        'descripcion',
        'telefono',
        'email'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
}
