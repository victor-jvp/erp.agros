<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contador extends Model
{

    protected $table      = "contadores";
    public    $timestamps = false;

    public function scopeNext_nro_lote()
    {
        $nro_lote = $this->where('contador', '=', 'nro_lote')->first(['valor'])->valor + 1;
        $nro_lote = str_pad($nro_lote, 8, "0", STR_PAD_LEFT);
        return $nro_lote;
    }

    public function scopeSave_nro_lote()
    {
        $nro_lote = $this->where('contador', '=', 'nro_lote')->first(['valor'])->valor + 1;
        DB::table('contadores')->where('contador', 'nro_lote')->update(['valor' => $nro_lote]);
        $nro_lote = str_pad($nro_lote, 8, "0", STR_PAD_LEFT);
        return $nro_lote;
    }
}
