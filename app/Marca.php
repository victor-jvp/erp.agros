<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marca extends Model
{
    //
    use SoftDeletes;
    protected $table = "marcas";

    public function cultivo()
    {
        return $this->belongsTo(Cultivo::class);
    }
}
