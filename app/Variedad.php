<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variedad extends Model
{
    //
    use SoftDeletes;
    protected $table = "variedades";

    public function cultivo()
    {
        return $this->belongsTo(Cultivo::class);
    }
}
