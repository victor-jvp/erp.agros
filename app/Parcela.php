<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parcela extends Model
{
    //
    use SoftDeletes;
    protected $table = "parcelas";

    public function finca()
    {
        return $this->belongsTo(Finca::class);
    }
}
