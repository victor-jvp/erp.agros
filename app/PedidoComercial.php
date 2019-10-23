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

        public function palet()
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

    public function variable()
    {
        return $this->belongsTo(ProductoCompuesto_det::class, 'producto_id');
    }

    public function scopeWithCultivos($query, $semana, $anio, $cultivo_id)
    {
        return $query->where('semana', $semana)
                    ->where('anio', $anio)
                    ->where('cultivos.id', $cultivo_id)
                    ->join('productoscompuestos_det', 'productoscompuestos_det.id', '=', 'pedidos_comerciales.producto_id')
                    ->join('productoscompuestos_cab', 'productoscompuestos_cab.id', '=', 'productoscompuestos_det.compuesto_id')
                    ->join('cultivos', 'cultivos.id', '=', 'productoscompuestos_cab.cultivo_id');
    }
}
