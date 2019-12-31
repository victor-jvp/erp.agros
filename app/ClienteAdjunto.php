<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteAdjunto extends Model
{
    protected $table = "clientes_adjuntos";

    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'cliente_id');
    }
}
