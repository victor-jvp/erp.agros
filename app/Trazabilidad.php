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

    public function marca()
    {
        return $this->belongsTo( Marca::class);
    }

    public function getTrazaAttribute()
    {
        $traza_id = str_pad($this->id, 2, "0", STR_PAD_LEFT);
        $parcela_id = str_pad($this->parcela->id, 2, "0", STR_PAD_LEFT);
        $fecha = date("dmy", strtotime($this->fecha));
        $traza = "TZ".$traza_id.$parcela_id.$fecha;
        return $traza;
    }
}
