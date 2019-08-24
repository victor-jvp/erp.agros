<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        if($this->categoria == "Caja")
        {
            $material = Caja::find($this->categoria_id)->formato;
        }
        elseif($this->categoria == "Palet")
        {
            $material = Pallet::find($this->categoria_id)->formato;
        }
        elseif($this->categoria == "Cubre")
        {
            $material = Cubre::find($this->categoria_id)->formato;
        }
        elseif($this->categoria == "Auxiliar")
        {
            $material = Auxiliar::find($this->categoria_id)->modelo;
        }
        elseif($this->categoria == "Tarrina")
        {
            $material = Tarrina::find($this->categoria_id)->modelo;
        }
        return $material;
    }
}
