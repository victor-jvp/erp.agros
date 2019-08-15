<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trazabilidad extends Model
{
    //
    use SoftDeletes;
    protected $table = 'trazabilidad';

    public function parcela()
    {
        return $this->belongsTo(Parcela::class);
    }

    public function variedad()
    {
        return $this->belongsTo(Variedad::class);
    }
}
