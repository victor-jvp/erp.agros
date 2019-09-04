<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class PedidosCampo extends Model
{
    use SoftDeletes;
    protected $table = "pedidos_campo";

    public function parcela()
    {
        return $this->belongsTo(Parcela::class, 'parcela_id');
    }

    public function fincas()
    {
        return $this->belongsTo(Finca::class, 'finca_id');
    }

    public function getSetSortAttribute()
    {
        $sort = DB::select('SELECT MAX(sort) as sort from pedidos_campo where finca_id = ? AND fecha = ?', [$this->finca_id, $this->fecha]);
        return ($sort[0]->sort + 1);
    }
}
