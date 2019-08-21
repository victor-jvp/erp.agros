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
        $finca_id    = str_pad($this->parcela->finca->id, 2, "0", STR_PAD_LEFT);
        $cultivo_id  = str_pad($this->variedad->cultivo->id, 2, "0", STR_PAD_LEFT);
        $variedad_id = str_pad($this->variedad->id, 2, "0", STR_PAD_LEFT);
        $parcela_id  = $this->parcela->id;
        $traza       = "TZ" . $finca_id . $cultivo_id . $variedad_id . $parcela_id;
        return $traza;
    }
}
