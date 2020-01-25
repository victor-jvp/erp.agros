<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProduccionCoste extends Model
{
    protected $table = "pedidos_produccion_costes";

    public function pedido()
    {
        return $this->belongsTo(PedidoProduccion::class, 'pedido_id');
    }
}
