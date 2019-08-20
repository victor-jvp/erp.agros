<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClienteDatosComerciales extends Model
{
    use SoftDeletes;
    protected $table = "clientes_datoscomerciales";

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
