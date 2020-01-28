<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProduccionCosteRecoleccion extends Model
{
    protected $table = 'pedidos_produccion_costes_recolecciones';

    public function pedido()
    {
        return $this->belongsTo(PedidoProduccion::class, 'pedido_id');
    }

    public function trazabilidad()
    {
        return $this->belongsTo(Trazabilidad::class, 'trazabilidad_id');
    }
}
