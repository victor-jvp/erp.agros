<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finca extends Model
{
    //
    use SoftDeletes;
    protected $table = "fincas";

    public function parcelas()
    {
        return $this->hasMany(Variedad::class);
    }
}
