<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    //
    protected $table = "modulos";

    public function secciones()
    {
        return $this->hasMany(ModuloSeccion::class, 'modulo_id');
    }
}
