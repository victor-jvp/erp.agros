<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClienteContactos extends Model
{
    use SoftDeletes;
    protected $table = "clientes_contactos";
    protected $fillable = [
        'descripcion',
        'telefono',
        'email'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
