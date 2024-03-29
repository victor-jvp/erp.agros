<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contador extends Model
{

    protected $table      = "contadores";
    public    $timestamps = false;

    #region Entrada
    public function scopeNext_nro_lote()
    {
        $nro_lote = $this->where('contador', '=', 'nro_lote')->first(['valor'])->valor + 1;
        $nro_lote = str_pad($nro_lote, 8, "0", STR_PAD_LEFT);
        return $nro_lote;
    }

    public function scopeSave_nro_lote()
    {
        $nro_lote = $this->where('contador', '=', 'nro_lote')->first(['valor'])->valor + 1;
        DB::table('contadores')->where('contador', 'nro_lote')->update(['valor' => $nro_lote]);
        $nro_lote = str_pad($nro_lote, 8, "0", STR_PAD_LEFT);
        return $nro_lote;
    }
    #endregion

    #region Salida
    public function scopeNext_nro_salida()
    {
        $nro_salida = $this->where('contador', '=', 'nro_salida')->first(['valor'])->valor + 1;
        $nro_salida = str_pad($nro_salida, 8, "0", STR_PAD_LEFT);
        return $nro_salida;
    }

    public function scopeSave_nro_salida()
    {
        $nro_salida = $this->where('contador', '=', 'nro_salida')->first(['valor'])->valor + 1;
        DB::table('contadores')->where('contador', 'nro_salida')->update(['valor' => $nro_salida]);
        $nro_salida = str_pad($nro_salida, 8, "0", STR_PAD_LEFT);
        return $nro_salida;
    }
    #endregion

    #region Lote de Pedido
    public function scopeNext_nro_lote_pedido()
    {
        $nro_lote_pedido = $this->where('contador', '=', 'nro_lote_pedido')->first(['valor'])->valor + 1;
        return $nro_lote_pedido;
    }

    public function scopeSave_nro_lote_pedido()
    {
        $nro_lote_pedido = $this->where('contador', '=', 'nro_lote_pedido')->first(['valor'])->valor + 1;
        DB::table('contadores')->where('contador', 'nro_lote_pedido')->update(['valor' => $nro_lote_pedido]);
        return $nro_lote_pedido;
    }
    #endregion

    #region Pedidos comerciales
    public function scopeNext_nro_pedido_comercial()
    {
        $nro_pedido_comercial = $this->where('contador', '=', 'nro_pedido_comercial')->first(['valor'])->valor + 1;
        return $nro_pedido_comercial;
    }

    public function scopeSave_nro_pedido_comercial()
    {
        $nro_pedido_comercial = $this->where('contador', '=', 'nro_pedido_comercial')->first(['valor'])->valor + 1;
        DB::table('contadores')->where('contador', 'nro_pedido_comercial')->update(['valor' => $nro_pedido_comercial]);
        return $nro_pedido_comercial;
    }
    #endregion

    #region Pedidos Producción

    public function scopeNext_nro_pedido_produccion()
    {
        $nro_pedido_produccion = $this->where('contador', '=', 'nro_pedido_produccion')->first(['valor'])->valor + 1;
        return $nro_pedido_produccion;
    }

    public function scopeSave_nro_pedido_produccion()
    {
        $nro_pedido_produccion = $this->where('contador', '=', 'nro_pedido_produccion')->first(['valor'])->valor + 1;
        DB::table('contadores')->where('contador', 'nro_pedido_produccion')->update(['valor' => $nro_pedido_produccion]);
        return $nro_pedido_produccion;
    }
    #endregion
}
