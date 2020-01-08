<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Entrada extends Model
{
    //
    use SoftDeletes;
    protected $table = "inventario";
    protected $fillable = [
        "tipo_mov",
        "nro_lote",
        "fecha",
        "categoria",
        "categoria_id",
        "cantidad",
        "nro_albaran",
        "fechga_albaran",
        "transporte_adecuado",
        "control_plagas",
        "estado_pallets",
        "ficha_tecnica",
        "material_daniado",
        "material_limpio",
        "control_grapas",
        "cantidad_conforme",
        "proveedor_id"
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function getmaterialAttribute()
    {
        $material = "";
        if ($this->categoria == "Caja") {
            $material = DB::table('cajas')->where('id', $this->categoria_id)->first()->formato;
        } elseif ($this->categoria == "Palet") {
            $material = DB::table('pallets')->where('id', $this->categoria_id)->first()->formato;
        } elseif ($this->categoria == "Cubre") {
            $material = DB::table('cubres')->where('id', $this->categoria_id)->first()->formato;
        } elseif ($this->categoria == "Auxiliar") {
            $material = DB::table('auxiliares')->where('id', $this->categoria_id)->first()->modelo;
        } elseif ($this->categoria == "Tarrina") {
            $material = DB::table('tarrinas')->where('id', $this->categoria_id)->first()->modelo;
        }
        return $material;
    }
}
