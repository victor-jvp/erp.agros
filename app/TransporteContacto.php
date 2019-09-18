<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransporteContacto extends Model
{
    //
    use SoftDeletes;
    protected $table = "transportes_contactos";
    protected $fillable = ["descripcion", "telefono", "email"];
}
