<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrevisionComentarios extends Model
{
    //
    protected $table = "previsiones_comentarios";
    
    public function finca()
    {
        return $this->belongsTo(Finca::class, 'finca_id');
    }

    public function cultivo()
    {
        return $this->belongsTo(Cultivo::class, 'cultivo_id');
    }
}
