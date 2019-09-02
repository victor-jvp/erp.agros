<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidosCampo extends Model
{
    use SoftDeletes;
    protected $table = "pedidos_campo";

    public function parcela()
    {
        return $this->belongsTo(Parcela::class, 'parcela_id');
    }
}
