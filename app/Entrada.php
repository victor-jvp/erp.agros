<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entrada extends Model
{
    //
    use SoftDeletes;
    protected $table = "entradas";

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
