<?php

namespace App\Http\Controllers;

use App\Auxiliar;
use App\Cultivo;
use App\Caja;
use App\Cubre;
use App\Tarrina;
use App\ProductoCompuesto_auxiliares;
use App\ProductoCompuesto_palets_auxiliares;
use Illuminate\Http\Request;
use App\ProductoCompuesto_cab;
use App\ProductoCompuesto_det;
use App\ProductoCompuesto_tarrinas;

class ProductosCompuestosController extends Controller
{
    //Listar Productos compuestos
    public function index()
    {

        $productos = ProductoCompuesto_cab::all();

        foreach ($productos as $i => $producto) {
            $productos[$i]->detalles = ProductoCompuesto_det::where('compuesto_id', $producto->id)->get();
        }

        $cultivos = Cultivo::all();

        $data = [
            "productos" => $productos,
            "cultivos"  => $cultivos,
        ];

        return view('maestros.productos_compuestos', $data);
    }

    public function show($id)
    {
        $producto = ProductoCompuesto_cab::find($id);
        $detalles = ProductoCompuesto_det::where('compuesto_id', $id)->get();

        foreach ($detalles as $i => $detalle) {
            $detalles[$i]->tarrinas         = ProductoCompuesto_tarrinas::where('det_id', $detalle->id)->get();
            $detalles[$i]->auxiliares       = ProductoCompuesto_auxiliares::where('det_id', $detalle->id)->get();
            $detalles[$i]->euro_auxiliares  = ProductoCompuesto_palets_auxiliares::where('det_id', $detalle->id)->where('palet_model_id', '=', 1)->get();
            $detalles[$i]->grand_auxiliares = ProductoCompuesto_palets_auxiliares::where('det_id', $detalle->id)->where('palet_model_id', '=', 2)->get();
        }

        $cajas      = Caja::all();
        $tarrinas   = Tarrina::all();
        $auxiliares = Auxiliar::all();
        $cubres     = Cubre::all();

        return view('maestros.productos_compuestos_show', [
            'producto'   => $producto,
            'detalles'   => $detalles,
            'cajas'      => $cajas,
            'auxiliares' => $auxiliares,
            'tarrinas'   => $tarrinas,
            'cubres'     => $cubres
        ]);
    }

    //Crea un nuevo producto compuesto CAB
    public function create(Request $request)
    {
        $producto             = new ProductoCompuesto_cab();
        $producto->compuesto  = $request->compuesto;
        $producto->cultivo_id = $request->cultivo;
        $producto->fecha      = date("Y-m-d");
        $producto->save();

        return redirect()->route('productos-compuestos-show', $producto->id);
    }

    public function update(Request $request, $id)
    {
        $producto             = ProductoCompuesto_cab::find($id);
        $producto->compuesto  = $request->compuesto;
        $producto->cultivo_id = $request->cultivo;
        $producto->save();

        return redirect()->route('productos-compuestos.index');
    }

    //Agrega los detalles a productos compuestos
    public function store(Request $request)
    {
        // dd($request);

        if ($request->id == "") $detalle = new ProductoCompuesto_det(); else
            $detalle = ProductoCompuesto_det::find($request->id);

        $detalle->compuesto_id = $request->compuesto_id;
        $detalle->variable     = $request->variable;
        $detalle->caja_id      = $request->caja_id;
        //euro Pallet
        $detalle->euro_cantidad       = $request->euro_cantidad;
        $detalle->euro_kg             = $request->euro_kg;
        $detalle->euro_cantoneras     = $request->euro_cantoneras;
        $detalle->euro_cubre_id       = $request->euro_cubre_id;
        $detalle->euro_cubre_cantidad = $request->euro_cubre_cantidad;
        //Grand Pallet
        $detalle->grand_cantidad       = $request->grand_cantidad;
        $detalle->grand_kg             = $request->grand_kg;
        $detalle->grand_cantoneras     = $request->grand_cantoneras;
        $detalle->grand_cubre_id       = $request->grand_cubre_id;
        $detalle->grand_cubre_cantidad = $request->grand_cubre_cantidad;

        $detalle->save();

        ProductoCompuesto_tarrinas::where('det_id', $detalle->id)->delete();

        if (isset($request->tarrinas_id)) {
            foreach ($request->tarrinas_id as $i => $item) {
                $tarrinas = new ProductoCompuesto_tarrinas();

                $tarrinas->det_id     = $detalle->id;
                $tarrinas->tarrina_id = $request->tarrinas_id[$i];
                $tarrinas->cantidad   = $request->tarrinas_cantidad[$i];
                $tarrinas->save();
            }
        }

        ProductoCompuesto_auxiliares::where('det_id', $detalle->id)->delete();

        if (isset($request->auxiliares_id)) {
            foreach ($request->auxiliares_id as $i => $item) {
                $auxiliar = new ProductoCompuesto_auxiliares();

                $auxiliar->det_id      = $detalle->id;
                $auxiliar->auxiliar_id = $request->auxiliares_id[$i];
                $auxiliar->cantidad    = $request->auxiliares_cantidad[$i];
                $auxiliar->save();
            }
        }

        ProductoCompuesto_palets_auxiliares::where('det_id', $detalle->id)->delete();

        if (isset($request->euro_auxiliares_id)) {
            foreach ($request->euro_auxiliares_id as $i => $item) {
                $auxiliar = new ProductoCompuesto_palets_auxiliares();

                $auxiliar->det_id          = $detalle->id;
                $auxiliar->palet_model_id = 1;
                $auxiliar->auxiliar_id     = $request->euro_auxiliares_id[$i];
                $auxiliar->cantidad        = $request->euro_auxiliares_cantidad[$i];
                $auxiliar->save();
            }
        }

        if (isset($request->grand_auxiliares_id)) {
            foreach ($request->grand_auxiliares_id as $i => $item) {
                $auxiliar = new ProductoCompuesto_palets_auxiliares();

                $auxiliar->det_id          = $detalle->id;
                $auxiliar->palet_model_id = 2;
                $auxiliar->auxiliar_id     = $request->grand_auxiliares_id[$i];
                $auxiliar->cantidad        = $request->grand_auxiliares_cantidad[$i];
                $auxiliar->save();
            }
        }

        return redirect()->route('productos-compuestos-show', $request->compuesto_id);
    }

    //Ajax para obtener detalles de producto
    public function details($id = null)
    {
        if (is_null($id)) return false;

        $detalle                   = ProductoCompuesto_det::find($id);
        $detalle->tarrinas         = ProductoCompuesto_tarrinas::with('tarrina')->where('det_id', $id)->get();
        $detalle->auxiliares       = ProductoCompuesto_auxiliares::with('auxiliar')->where('det_id', $id)->get();
        $detalle->euro_auxiliares  = ProductoCompuesto_palets_auxiliares::with('auxiliar')->where('palet_model_id', '=', 1)->where('det_id', $id)->get();
        $detalle->grand_auxiliares = ProductoCompuesto_palets_auxiliares::with('auxiliar')->where('palet_model_id', '=', 2)->where('det_id', $id)->get();

        return response()->json(['detalle' => $detalle]);
    }

    public function delete($id)
    {
        if (is_null($id)) return false;

        $detalle      = ProductoCompuesto_det::with('auxiliares')->with('tarrinas')->with('palets_auxiliares')->find($id);
        $compuesto_id = $detalle->compuesto_id;
        $detalle->auxiliares()->delete();
        $detalle->tarrinas()->delete();
        $detalle->palets_auxiliares()->delete();
        $detalle->delete();

        return redirect()->route('productos-compuestos-show', $compuesto_id);
    }

    public function ajaxGetCompuesto(Request $request)
    {
        $id = $request->input('id');

        if (is_null($id)) return response()->json(null);

        $data = ProductoCompuesto_cab::where('cultivo_id', $id)->get();

        return response()->json($data);
    }

    public function ajaxGetVariedad(Request $request)
    {
        $id = $request->input('id');

        if (is_null($id)) return response()->json(null);

        $data = ProductoCompuesto_det::where('compuesto_id', $id)->get();

        return response()->json($data);
    }
}
