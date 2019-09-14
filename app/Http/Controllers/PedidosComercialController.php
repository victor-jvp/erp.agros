<?php

namespace App\Http\Controllers;

use App\CatDiasSemana;
use App\Cultivo;
use Illuminate\Http\Request;

class PedidosComercialController extends Controller
{
    public function index(Request $request)
    {
        $fecha_act          = (is_null($request->fecha_act)) ? date('Y-m-d') : date("Y-m-d", strtotime($request->fecha_act));
        if (!is_null($request->semana_act)) {
            $data['semana_act'] = intval($request->semana_act);
        } else {
            $data['semana_act'] = intval(date("W"));
        }
        $data['semana']     = CatDiasSemana::orderBy('order', 'ASC')->get();
        $data['semana_ini'] = 1;
        $data['semana_fin'] = 50;

        $cultivos = Cultivo::all();

        $data['fecha_act'] = $fecha_act;
        $data["cultivos"]  = $cultivos;

        return view("comercial.pedidos-comercial.index")->with($data);
    }
}
