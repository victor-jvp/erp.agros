<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProduccionPaletAuxiliar extends Model
{
    //
    protected $table = "pedidos_produccion_palets_auxiliares";

    public function auxiliar()
    {
        return $this->belongsTo(Auxiliar::class);
    }

    public function pedido(){
        return $this->belongsTo(PedidoProduccion::class, 'pedido_id');
    }
}
