<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosFiscales extends Model
{
    //
    protected $table = "config_datos_fiscales";
    protected $fillable = [
        "cif",
        "razon_social",
        "nombre_comercial",
        "direccion",
        "telefono",
        "email"
    ];
}
