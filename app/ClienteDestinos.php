<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteDestinos extends Model
{
    //
    protected $table = "clientes_destinos";
    protected $fillable = ['descripcion', 'direccion', 'poblacion', 'ciudad', 'pais'];
}
