<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProduccionAuxiliar extends Model
{
    protected $table = "pedidos_produccion_auxiliares";

    public function auxiliar()
    {
        return $this->belongsTo(Auxiliar::class);
    }

    public function pedido(){
        return $this->belongsTo(PedidoProduccion::class, 'pedido_id');
    }
}
