<?php

namespace App\Http\Controllers;

use App\CatDiasSemana;
use App\Cliente;
use App\Contador;
use App\Cultivo;
use App\Pallet;
use App\PalletModel;
use App\PedidoComercialEstado;
use App\ProductoCompuesto_cab;
use Illuminate\Http\Request;

class PedidosComercialController extends Controller
{
    public function index(Request $request)
    {
        if (!is_null($request->semana_act)) {
            $data['semana_act'] = intval($request->semana_act);
        } else {
            $data['semana_act'] = intval(date("W"));
        }

        if (!is_null($request->anio_act)) {
            $data['anio_act'] = intval($request->anio_act);
        } else {
            $data['anio_act'] = intval(date("Y"));
        }

        $cultivos  = Cultivo::all();
        $clientes  = Cliente::all();
        $estados   = PedidoComercialEstado::all();
        $productos = ProductoCompuesto_cab::with('det')->get();
        $modelos   = PalletModel::all();
        $nro_orden = Contador::Next_nro_pedido_comercial();

        $data['semana']     = CatDiasSemana::orderBy('order', 'ASC')->get();
        $data['semana_ini'] = 1;
        $data['semana_fin'] = 50;
        $data['anio_ini']   = 2019;
        $data['anio_fin']   = Date('Y');
        $data["cultivos"]   = $cultivos;
        $data['clientes']   = $clientes;
        $data['estados']    = $estados;
        $data['productos']  = $productos;
        $data['modelos']    = $modelos;
        $data['nro_orden']  = date('dmY')."-".$nro_orden;

        return view("comercial.pedidos-comercial.index")->with($data);
    }

    public function store(Request $request)
    { }

    public function update(Request $request, $id)
    { }
}
