<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoComercialAuxiliar extends Model
{
    //
    protected $table = "pedidos_comerciales_auxiliares";

    public function auxiliar()
    {
        return $this->belongsTo(Auxiliar::class);
    }

    public function pedido(){
        return $this->belongsTo(PedidoComercial::class, 'pedido_id');
    }
}
