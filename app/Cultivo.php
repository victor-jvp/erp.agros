<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

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
