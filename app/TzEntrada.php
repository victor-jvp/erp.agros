<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class TzEntrada extends Model
{
    //
    use SoftDeletes;
    protected $table = "tz_entradas";

    public function proveedor()
    {
        return $this->belongsTo(TzProveedor::class, 'proveedor_id');
    }

    public function producto()
    {
        return $this->belongsTo(ProductoCompuesto_det::class, 'producto_id');
    }

    public function salidas()
    {
        return $this->hasMany(TzSalida::class, 'entrada_id');
    }

     public function scopeNew_traza()
    {
        $fecha = Carbon::now()->format("ymd");
        $traza = "AGF-".$fecha;
        $count = $this->where('traza', 'LIKE', '%'.$traza.'%')->count() + 1;
        $traza = "AGF-" . date('y') . date('m') . date('d') . str_pad($count, 3, "0", STR_PAD_LEFT);
        return $traza;
    }
}
