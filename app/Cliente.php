<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    //
    use softDeletes;
    protected $table = "clientes";
    
    public function datosComerciales()
    {
        return $this->hasMany(ClienteDatosComerciales::class, 'cliente_id');
    }
}
