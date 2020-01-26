<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\InventarioRel;
use App\PedidoProduccionCoste;
use App\ProductoCompuesto_det;
use http\Env\Response;
use Illuminate\Http\Request;
use App\PedidoProduccion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        $pedidos = PedidoProduccion::with([
            'palet.modelo',
            'variable.caja',
            'coste',
            'pedido_comercial',
            'inventario',
        ])->where('estado_id', 3)
          ->orderBy('pedidos_produccion.id', 'desc')
          ->get();

        foreach ($pedidos as $p => $pedido)
        {
            $pedidos[$p]->precio_mp = DB::table('inventario_rel')
                                      ->join('inventario', 'inventario.id' ,'=','inventario_rel.entrada_id')
                                      ->where('entrada_id', '!=', 'NULL')
                                      ->where('pedido_id', $pedido->id)
                                      ->sum('inventario.precio');
        }

        $data['pedidos']    = $pedidos;
        $data['clientes']   = Cliente::all();
        $data['compuestos'] = ProductoCompuesto_det::with('caja')->get();

        return view('costes.index')->with($data);
    }

    public function update(Request $request)
    {
        $id    = $request->id;
        $coste = PedidoProduccionCoste::where('pedido_id', $id)->first();

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

        return redirect()->route('costes.index');
    }

    public function details(Request $request)
    {
        $id = $request->get('id');

        $pedido = PedidoProduccion::with([
            'variable.caja',
            'coste',
            'inventario',
            'pedido_comercial',
            'cliente'
        ])->find($id);

        if (is_null($pedido->coste)) {
            $coste = new PedidoProduccionCoste();
            $pedido->coste()->save($coste);

            $pedido = PedidoProduccion::with([
                'variable.caja',
                'coste',
                'inventario',
                'pedido_comercial',
            ])->find($id);
        }

        if (!is_null($pedido)){
            $pedido->precio_mp = DB::table('inventario_rel')
              ->join('inventario', 'inventario.id' ,'=','inventario_rel.entrada_id')
              ->where('entrada_id', '!=', 'NULL')
              ->where('pedido_id', $id)
              ->sum('inventario.precio');
        }

        return response()->json($pedido);
    }
}
