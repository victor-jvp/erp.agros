<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prevision extends Model
{
    //
    use SoftDeletes;
    protected $table = "previsiones";

    public function trazabilidades()
    {
        return $this->hasMany(Prevision::class, 'traza_id');
    }
}
