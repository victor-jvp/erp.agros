<?php

namespace App\Http\Controllers;

use App\CatDiasSemana;
use App\Cliente;
use App\Cultivo;
use App\PedidoComercialEstado;
use App\ProductoCompuesto_cab;
use Illuminate\Http\Request;

class PedidosComercialController extends Controller
{
    public function index(Request $request)
    {
        $fecha_act = (is_null($request->fecha_act)) ? date('Y-m-d') : date("Y-m-d", strtotime($request->fecha_act));
        if (!is_null($request->semana_act)) {
            $data['semana_act'] = intval($request->semana_act);
        } else {
            $data['semana_act'] = intval(date("W"));
        }

        $cultivos = Cultivo::all();
        $clientes = Cliente::all();
        $estados  = PedidoComercialEstado::all();
        $productos = ProductoCompuesto_cab::with('det')->get();

        $data['semana']     = CatDiasSemana::orderBy('order', 'ASC')->get();
        $data['semana_ini'] = 1;
        $data['semana_fin'] = 50;
        $data['fecha_act'] = $fecha_act;
        $data["cultivos"]  = $cultivos;
        $data['clientes']  = $clientes;
        $data['estados'] = $estados;
        $data['productos'] = $productos;

        return view("comercial.pedidos-comercial.index")->with($data);
    }

    public function store(Request $request)
    { }

    public function update(Request $request, $id)
    { }
}
