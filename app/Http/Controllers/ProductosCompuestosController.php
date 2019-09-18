<?php

namespace App\Http\Controllers;

use App\ProductoCompuesto_auxiliares;
use Illuminate\Http\Request;
use App\ProductoCompuesto_cab;
use App\ProductoCompuesto_det;
use App\ProductoCompuesto_tarrinas;

class ProductosCompuestosController extends Controller
{
    //Crea un nuevo producto compuesto CAB
    public function create(Request $request)
    {
        $producto            = new ProductoCompuesto_cab();
        $producto->compuesto = $request->compuesto;
        $producto->fecha     = date("Y-m-d");
        $producto->save();

        return redirect()->route('productos-compuestos-show', $producto->id);
    }

    //Agrega los detalles a productos compuestos
    public function store(Request $request)
    {
//        dd($request);

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

        if (isset($request->euro_tarrinas_id)) {
            foreach ($request->euro_tarrinas_id as $i => $item) {
                $tarrinas = new ProductoCompuesto_tarrinas();

                $tarrinas->det_id     = $detalle->id;
                $tarrinas->model_id   = 1;
                $tarrinas->tarrina_id = $request->euro_tarrinas_id[$i];
                $tarrinas->cantidad   = $request->euro_tarrinas_cantidad[$i];
                $tarrinas->save();
            }
        }

        if (isset($request->grand_tarrinas_id)) {
            foreach ($request->grand_tarrinas_id as $i => $item) {
                $tarrinas = new ProductoCompuesto_tarrinas();

                $tarrinas->det_id     = $detalle->id;
                $tarrinas->model_id   = 2;
                $tarrinas->tarrina_id = $request->grand_tarrinas_id[$i];
                $tarrinas->cantidad   = $request->grand_tarrinas_cantidad[$i];
                $tarrinas->save();
            }
        }

        ProductoCompuesto_auxiliares::where('det_id', $detalle->id)->delete();

        if (isset($request->euro_auxiliares_id)) {
            foreach ($request->euro_auxiliares_id as $i => $item) {
                $auxiliar = new ProductoCompuesto_auxiliares();

                $auxiliar->det_id      = $detalle->id;
                $auxiliar->model_id    = 1;
                $auxiliar->auxiliar_id = $request->euro_auxiliares_id[$i];
                $auxiliar->cantidad    = $request->euro_auxiliares_cantidad[$i];
                $auxiliar->save();
            }
        }

        if (isset($request->grand_auxiliares_id)) {
            foreach ($request->grand_auxiliares_id as $i => $item) {
                $auxiliar = new ProductoCompuesto_auxiliares();

                $auxiliar->det_id      = $detalle->id;
                $auxiliar->model_id    = 2;
                $auxiliar->auxiliar_id = $request->grand_auxiliares_id[$i];
                $auxiliar->cantidad    = $request->grand_auxiliares_cantidad[$i];
                $auxiliar->save();
            }

        }

        return redirect()->route('productos-compuestos-show', $request->compuesto_id);
    }

    //Ajax para obtener detalles de producto
    public function details($id = null)
    {
        if (is_null($id)) return false;

        $detalle = ProductoCompuesto_det::with('euro_tarrinas.tarrina')
            ->with('euro_auxiliares.auxiliar')
            ->with('grand_tarrinas.tarrina')
            ->with('grand_auxiliares.auxiliar')
            ->find($id);

        return response()->json(['detalle' => $detalle]);
    }

    public function delete($id)
    {
        if (is_null($id)) return false;

        $detalle      = ProductoCompuesto_det::with('euro_tarrinas')
                                             ->with('euro_auxiliares')
                                             ->with('grand_tarrinas')
                                             ->with('grand_auxiliares')
                                             ->find($id);
        $compuesto_id = $detalle->compuesto_id;
        $detalle->euro_tarrinas()->delete();
        $detalle->euro_auxiliares()->delete();
        $detalle->grand_tarrinas()->delete();
        $detalle->grand_auxiliares()->delete();
        $detalle->delete();

        return redirect()->route('productos-compuestos-show', $compuesto_id);
    }

    public function ajaxGetDetalles(Request $request)
    {
        $id = $request->input('id');

        if (is_null($id)) return response()->json(null);

        $data = ProductoCompuesto_det::where('compuesto_id', $id)->get();

        return response()->json($data);
    }
}
