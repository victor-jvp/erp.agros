<?php

namespace App\Http\Controllers;

use App\CatDiasSemana;
use App\Cliente;
use App\ClienteDestinos;
use App\Contador;
use App\Cultivo;
use App\Pallet;
use App\PalletModel;
use App\PedidoComercial;
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

        foreach ($cultivos as $c => $cultivo) {
            $pedidos = PedidoComercial::where('cultivo_id', $cultivo->id)
                ->where('anio', $data['anio_act'])
                ->where('semana', $data['semana_act'])
                ->get();
            $cultivos[$c]->pedidos = $pedidos;
        }

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
        $data['nro_orden']  = date('dmY') . "-" . $nro_orden;

        return view("comercial.pedidos-comercial.index")->with($data);
    }

    public function store(Request $request)
    {
//        dd($request);
        $data = array();
        foreach ($request->dias as $dia) {
            $pedido = new PedidoComercial();

            $pedido->nro_orden           = date('dmY')."-".Contador::Save_nro_pedido_comercial();
            $pedido->anio                = $request->anio;
            $pedido->semana              = $request->semana;
            $pedido->dia_id              = $dia;
            $pedido->cliente_id          = $request->cliente;
            //$pedido->destino_comercial = $request->destino_comercial;
            $pedido->cultivo_id          = $request->cultivo;
            $pedido->producto_id         = $request->producto_compuesto;
            $pedido->pallet_id           = $request->formato_palet;
            $pedido->cantidad            = $request->cantidad;
            $pedido->etiqueta            = $request->etiqueta;
            $pedido->precio              = $request->precio;
            $pedido->kilos               = $request->kilos;
            $pedido->comentarios         = $request->comentario;
            $pedido->estado_id           = 1;

            $pedido->save();
            $data['anio_act']   = $request->anio;
            $data['semana_act'] = $request->semana;
        }

        return redirect()->route('pedidos-comercial.index')->with($data);
    }

    public function update(Request $request, $id)
    {
    }

    public function ajaxGetDestinosComerciales(Request $request)
    {
        $id = $request->input('id');

        if (is_null($id)) return response()->json(null);

        $data = array();
        $data = ClienteDestinos::where('cliente_id', $id)->get();

        return response()->json($data);
    }
}
