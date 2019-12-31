<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transporte extends Model
{
    protected $table = "transportes";
    use SoftDeletes;

    public function contactos()
    {
        return $this->hasMany(TransporteContacto::class);
    }

    public function adjuntos()
    {
        return $this->hasMany(TransporteAdjunto::class);
    }

    public function pedidos()
    {
        return $this->hasMany(PedidoProduccion::class, 'transporte_id');
    }
}
