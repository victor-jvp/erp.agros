<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProduccionTarrina extends Model
{
    protected $table = "pedidos_produccion_tarrinas";

    public function tarrina()
    {
        return $this->belongsTo(Tarrina::class);
    }

    public function pedido(){
        return $this->belongsTo(PedidoProduccion::class, 'pedido_id');
    }
}
