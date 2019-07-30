<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cultivo extends Model
{
    //
    use SoftDeletes;
    protected $table = "cultivos";

    public function variedades()
    {
        return $this->hasMany(Variedad::class);
    }
}
