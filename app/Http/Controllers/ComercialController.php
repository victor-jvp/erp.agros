<?php

namespace App\Http\Controllers;

use App\Cultivo;
use App\CatDiasSemana;
use Illuminate\Http\Request;

class ComercialController extends Controller
{
    //
    public function dashboard(Request $request)
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

        $data['semana']      = CatDiasSemana::orderBy('order', 'ASC')->get();
        $data['semana_ini']  = 1;
        $data['semana_fin']  = 50;
        $data['anio_ini']    = 2019;
        $data['anio_fin']    = Date('Y');

        $data['cultivos'] = Cultivo::all();

        return view('comercial.dashboard.index')->with($data);
    }
}
