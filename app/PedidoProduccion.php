<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoProduccion extends Model
{
    //
    protected $table = "pedidos_produccion";
    use SoftDeletes;

    public function getFechaOrdenAttribute()
    {
        $nro_orden = explode('-', $this->nro_orden);
        $anio      = substr($nro_orden[0], 4, 4);
        $mes       = substr($nro_orden[0], 2, 2);
        $dia       = substr($nro_orden[0], 0, 2);
        $fecha     = $anio . "-" . $mes . "-" . $dia;
        return $fecha;
    }

    public function estado()
    {
        return $this->belongsTo(PedidoProduccionEstado::class, 'estado_id');
    }

    public function cancelado()
    {
        return $this->belongsTo(PedidoProduccionCatCancelado::class, 'cancelado_id');
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
        return $this->hasMany(PedidoProduccionAuxiliar::class, 'pedido_id');
    }

    public function palet_auxiliares()
    {
        return $this->hasMany(PedidoProduccionPaletAuxiliar::class, 'pedido_id');
    }

    public function tarrinas()
    {
        return $this->hasMany(PedidoProduccionTarrina::class, 'pedido_id');
    }

    public function variable()
    {
        return $this->belongsTo(ProductoCompuesto_det::class, 'producto_id');
    }

    public function scopeWithCultivos($query, $semana, $anio, $cultivo_id)
    {
        return $query->select('pedidos_produccion.*')
                     ->where('semana', $semana)
                     ->where('anio', $anio)
                     ->where('cultivos.id', $cultivo_id)
                     ->join('productoscompuestos_det', 'productoscompuestos_det.id', '=', 'pedidos_produccion.producto_id')
                     ->join('productoscompuestos_cab', 'productoscompuestos_cab.id', '=', 'productoscompuestos_det.compuesto_id')
                     ->join('cultivos', 'cultivos.id', '=', 'productoscompuestos_cab.cultivo_id');
    }
}
