<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Cliente;
use App\InventarioRel;
use App\PedidoProduccionCoste;
use App\PedidoProduccionCosteRecoleccion;
use App\ProductoCompuesto_det;
use App\Trazabilidad;
use Carbon\Carbon;
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
        ])->where('estado_id', 3)->orderBy('pedidos_produccion.id', 'desc')->get();

        foreach ($pedidos as $p => $pedido) {
            $pedidos[$p]->precio_mp = DB::table('inventario_rel')->join('inventario', 'inventario.id', '=', 'inventario_rel.entrada_id')->where('entrada_id', '!=', 'NULL')->where('pedido_id', $pedido->id)->sum(DB::RAW('inventario.precio * inventario_rel.cantidad'));
        }

        $data['pedidos']        = $pedidos;
        $data['clientes']       = Cliente::all();
        $data['trazabilidades'] = Trazabilidad::all();
        $data['categorias']     = Categoria::all();
        $data['compuestos']     = ProductoCompuesto_det::with('caja')->get();

        return view('costes.index')->with($data);
    }

    public function update(Request $request)
    {
//        dd($request);
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

        $pedido = PedidoProduccion::find($id);
        $pedido->trazabilidades()->delete();
        $pedido->save();

        if (isset($request->trazabilidades)) {
            for ($i = 0; $i < count($request->trazabilidades); $i++) {
                $reco                  = new PedidoProduccionCosteRecoleccion();
                $reco->pedido_id       = $id;
                $reco->trazabilidad_id = $request->trazabilidades[$i];
                $reco->precio          = $request->precios[$i];
                $reco->save();
            }
        }

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
            'cliente',
            'trazabilidades.trazabilidad',
        ])->find($id);

        if (is_null($pedido->coste)) {
            $coste = new PedidoProduccionCoste();
            $pedido->coste()->save($coste);

            $pedido = PedidoProduccion::with([
                'variable.caja',
                'coste',
                'inventario',
                'pedido_comercial',
                'cliente',
                'trazabilidades.trazabilidad',
            ])->find($id);
        }

        if (!is_null($pedido)) {
            $pedido->precio_mp = DB::table('inventario_rel')->join('inventario', 'inventario.id', '=', 'inventario_rel.entrada_id')->where('entrada_id', '!=', 'NULL')->where('pedido_id', $id)->sum(DB::RAW('inventario.precio * inventario_rel.cantidad'));

            $pedido->recoleccion = PedidoProduccionCosteRecoleccion::where('pedido_id', $id)->sum('precio');
        }

        return response()->json($pedido);
    }

    public function pdf_list(Request $request)
    {

        $desde     = $request->get('desde');
        $hasta     = $request->get('hasta');
        $cliente   = $request->get('cliente');
        $compuesto = $request->get('compuesto');
        $categoria = $request->get('categoria');
        $vista     = $request->get('vista');

        dd($request);

        $query = PedidoProduccionCoste::with([
            'pedido.cliente',
            'pedido.variable.caja',
            'pedido.pedido_comercial',
        ]);

        if (!is_null($desde) && !is_null($hasta)){
            $query = $query->where('');
        }

        $query = $query->get();

        $data['costes'] = $query;

        $pdf = \PDF::loadView('costes.print.list', $data)->setPaper('A4', 'landscape');

        return $pdf->stream('Costes.pdf');
    }
}
