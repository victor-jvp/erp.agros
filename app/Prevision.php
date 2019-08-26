<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prevision extends Model
{
    //
    use SoftDeletes;
    protected $table = "previsiones";

    public function trazabilidad()
    {
        return $this->belongsTo(Trazabilidad::class, 'trazabilidad_id');
    }

    public function getdiaAttribute()
    {
        $dia = date("W", strtotime($this->fecha));
        return intval($dia);
    }
}
