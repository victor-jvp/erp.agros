<?php

namespace App\Http\Controllers;

use App\TzSalida;
use App\TzProveedor;
use App\ProductoCompuesto_det;
use App\TzEntrada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TzLiquidacionesController extends Controller
{
    //
    public function index()
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('AgroAlfaro - Salidas | Acceso')) {
            return redirect()->route('home');
        }

        $data = array(
            "proveedores"   => TzProveedor::all(),
            "compuestos"    => ProductoCompuesto_det::with('compuesto')->get(),
            "liquidaciones" => TzSalida::with('entrada')->where('pagada', '=', false)->get(),
            "albaranes" => TzEntrada::select('id', 'albaran')->groupBy('albaran', 'id')->get(),
        );

        return view('agroAlfaro.liquidaciones.index', $data);
    }

    public function marcar_pagada(Request $request)
    {
        $result = false;
        $id     = $request->get('id');
        if (!is_null($id)) {
            $salida         = TzSalida::find($id);
            $salida->pagada = true;
            $salida->save();
            $result = true;
        }

        return response()->json($result);
    }
}
