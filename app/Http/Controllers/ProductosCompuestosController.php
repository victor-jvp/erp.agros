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

        $detalle->compuesto_id    = $request->compuesto_id;
        $detalle->variable        = $request->variable;
        $detalle->caja_id         = $request->caja_id;
        $detalle->euro_cantidad   = $request->euro_cantidad;
        $detalle->euro_kg         = $request->euro_kg;
        $detalle->euro_pallet_id  = $request->euro_pallet_id;
        $detalle->grand_cantidad  = $request->grand_cantidad;
        $detalle->grand_kg        = $request->grand_kg;
        $detalle->grand_pallet_id = $request->grand_pallet_id;
        $detalle->cantoneras      = $request->cantoneras;
        $detalle->cubre_id        = $request->cubre_id;
        $detalle->cubre_cantidad  = $request->cubre_cantidad;
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

        return redirect()->route('productos-compuestos-show', $request->compuesto_id);
    }

    //Ajax para obtener detalles de producto
    public function details($id = null)
    {
        if (is_null($id)) return false;

        $detalle = ProductoCompuesto_det::with('tarrinas.tarrina')->with('auxiliares.auxiliar')->find($id);

        return response()->json(['detalle' => $detalle]);
    }

    public function delete($id)
    {
        if (is_null($id)) return false;

        $detalle      = ProductoCompuesto_det::with('tarrinas')->with('auxiliares')->find($id);
        $compuesto_id = $detalle->compuesto_id;
        $detalle->tarrinas()->delete();
        $detalle->auxiliares()->delete();
        $detalle->delete();

        return redirect()->route('productos-compuestos-show', $compuesto_id);
    }
}
