<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuloSeccion extends Model
{
    //
    protected $table = "modulos_secciones";

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }
}
