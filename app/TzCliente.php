<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TzCliente extends Model
{
    //
    use SoftDeletes;
    protected $table = "tz_clientes";
    protected $fillable = [
        "cliente",
        "domicilio",
        "poblacion",
        "cif"
    ];
}
