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

    public function getTrazaAttribute()
    {
        $parcela_id  = str_pad($this->parcela->id, 2, "0", STR_PAD_LEFT);
        $finca_id    = str_pad($this->parcela->finca->id, 2, "0", STR_PAD_LEFT);
        $cultivo_id  = str_pad($this->variedad->cultivo->id, 2, "0", STR_PAD_LEFT);
        $variedad_id = str_pad($this->variedad->id, 2, "0", STR_PAD_LEFT);
        $traza       = "TZ" . $finca_id . $parcela_id . $cultivo_id . $variedad_id;
        return $traza;
    }
}
