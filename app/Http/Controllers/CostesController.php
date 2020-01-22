<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use App\PedidoProduccion;

class CostesController extends Controller
{
    //
    public function index()
    {
        $data['pedidos'] = PedidoProduccion::with([
            'tarrinas.tarrina',
            'auxiliares.auxiliar',
            'palet_auxiliares.auxiliar',
            'palet.modelo',
            'variable.caja'
        ])->where('estado_id', 3)
        ->orderBy('pedidos_produccion.id', 'desc')->get();

        $data['clientes'] = Cliente::all();

//        dd($data);

        return view('costes.index')->with($data);
    }
}
