<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    //
    use softDeletes;
    protected $table = "clientes";

    public function contactos()
    {
        return $this->hasMany(ClienteContactos::class);
    }

    public function adjuntos()
    {
        return $this->hasMany(ClienteAdjunto::class);
    }

    public function destinos()
    {
        return $this->hasMany(ClienteDestinos::class);
    }

    public function pedidos()
    {
        return $this->hasMany(PedidoComercial::class, 'cliente_id');
    }
}
