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

    public function destino()
    {
        return $this->belongsTo(ClienteDestinos::class, 'destino_id');
    }

    public function formato()
    {
        return $this->belongsTo(Pallet::class, 'pallet_id');
    }

    public function transporte()
    {
        return $this->belongsTo(Transporte::class, 'transporte_id');
    }

    public function dia()
    {
        return $this->belongsTo(CatDiasSemana::class, 'dia_id');
    }

    public function auxiliares()
    {
        return $this->hasMany(PedidoComercialAuxiliar::class, 'pedido_id');
    }

    public function tarrinas()
    {
        return $this->hasMany(PedidoComercialTarrina::class, 'pedido_id');
    }
}
