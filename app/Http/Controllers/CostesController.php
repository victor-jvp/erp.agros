<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\PedidoProduccionCoste;
use http\Env\Response;
use Illuminate\Http\Request;
use App\PedidoProduccion;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Json;

class CostesController extends Controller
{
    //
    public function index()
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Costes | Acceso')) {
            return redirect()->route('home');
        }

        $data['pedidos'] = PedidoProduccion::with([
            'tarrinas.tarrina',
            'auxiliares.auxiliar',
            'palet_auxiliares.auxiliar',
            'palet.modelo',
            'variable.caja',
            'coste',
        ])->where('estado_id', 3)->orderBy('pedidos_produccion.id', 'desc')->get();

//        dd($data['pedidos']);

        $data['clientes'] = Cliente::all();

        return view('costes.index')->with($data);
    }

    public function update(Request $request, $id)
    {
        $coste = PedidoProduccionCoste::find($id);

        if (is_null($coste)) {
            $coste            = new PedidoProduccionCoste();
            $coste->pedido_id = $id;
        }

        $coste->recoleccion  = $request->recoleccion;
        $coste->manipulacion = $request->manipulacion;
        $coste->comentario1  = $request->comentario1;
        $coste->comentario2  = $request->comentario2;
        $coste->transporte   = $request->transporte;
        $coste->devoluciones = $request->devoluciones;
        $coste->facturado    = (isset($request->facturado)) ? true : false;
        $coste->cobrado      = (isset($request->cobrado)) ? true : false;

        $coste->save();
    }

    public function details(Request $request)
    {
        $id = $request->get('id');

        $pedido = PedidoProduccion::with([
            'variable.caja',
            'coste',
        ])->find($id);

        if (is_null($pedido->coste)){
            $coste = new PedidoProduccionCoste();
            $pedido->coste()->save($coste);

            $pedido = PedidoProduccion::with([
                'variable.caja',
                'coste',
            ])->find($id);
        }

        return response()->json($pedido);
    }
}
