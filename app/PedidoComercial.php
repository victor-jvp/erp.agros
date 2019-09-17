<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoComercial extends Model
{
    //
    protected $table = "pedidos_comerciales";

    public function estado()
    {
        return $this->belongsTo(PedidoComercialEstado::class, 'estado_id');
    }

    public function cancelado()
    {
        return $this->belongsTo(PedidoComercialCatCancelado::class, 'cancelado_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function dia()
    {
        return $this->belongsTo(CatDiasSemana::class, 'dia_id');
    }
}
