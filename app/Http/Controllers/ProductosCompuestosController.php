<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductoCompuesto_cab;
use App\ProductoCompuesto_det;

class ProductosCompuestosController extends Controller
{
    //Crea un nuevo producto compuesto CAB
    public function create(Request $request)
    {
        $producto = new ProductoCompuesto_cab();
        $producto->compuesto = $request->compuesto;
        $producto->fecha = date("Y-m-d");
        $producto->save();

        return redirect()->route('productos-compuestos-show', $producto->id);
    }

    //Agrega los detalles a productos compuestos
    public function store(Request $request, $id)
    {
//        dd($request);

        $detalle = new ProductoCompuesto_det();
        $detalle->compuesto_id = $request->id;
        $detalle->variable = $request->variable;
        $detalle->caja_id = $request->caja_id;
        $detalle->euro_cantidad = $request->euro_cantidad;
        $detalle->euro_kg = $request->euro_kg;
        $detalle->euro_pallet_id = $request->euro_pallet_id;
        $detalle->grand_cantidad = $request->grand_cantidad;
        $detalle->grand_kg = $request->grand_kg;
        $detalle->grand_pallet_id = $request->grand_pallet_id;
        $detalle->cestas = $request->cestas;
        $detalle->tapas = $request->tapas;
        $detalle->cantoneras = $request->cantoneras;
        $detalle->cubre_id = $request->cubre_id;
        $detalle->save();

        return redirect()->route('productos-compuestos-show', $id);
    }
}
