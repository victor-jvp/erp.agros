<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoComercialTarrina extends Model
{
    //
    protected $table = "pedidos_comerciales_tarrinas";

    public function tarrina()
    {
        return $this->belongsTo(Tarrina::class);
    }

    public function pedido(){
        return $this->belongsTo(PedidoComercial::class, 'pedido_id');
    }
}
