<?php

namespace App\Http\Controllers;

use App\Caja;
use App\Entrada;
use App\Pallet;
use App\Proveedor;
use App\Contador;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EntradaProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entradas     = Entrada::with('proveedor')->with('pallet.modelo')->get();
        $categorias[] = array(
            "value" => "cajas",
            "text"  => "Cajas"
        );
        $categorias[] = array(
            "value" => "pallets",
            "text"  => "Pallets"
        );

        $data = array(
            'entradas'    => $entradas,
            "categorias"  => $categorias,
            "proveedores" => Proveedor::all('id', 'razon_social'),
            "nro_lote"    => Contador::next_nro_lote(),
        );

        return view('almacen.entradas', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);

        $entrada           = new Entrada();
        $entrada->nro_lote = Contador::save_nro_lote();
        $entrada->fecha    = $request->fecha;
        $entrada->cantidad = $request->cantidad;

        if ($request->categoria == "cajas") {
            $entrada->caja_id   = $request->material;
            $entrada->pallet_id = null;
        } else {
            $entrada->pallet_id = $request->material;
            $entrada->caja_id   = null;
        }


        $entrada->nro_albaran         = $request->nro_albaran;
        $entrada->fecha_albaran       = Carbon::parse($request->fecha_albaran)->toDateTimeString();
        $entrada->proveedor_id        = $request->proveedor;
        $entrada->transporte_adecuado = (isset($request->transporte_adecuado)) ? true : false;
        $entrada->control_plagas      = (isset($request->control_plagas)) ? true : false;
        $entrada->estado_pallets      = (isset($request->estado_pallets)) ? true : false;
        $entrada->ficha_tecnica       = (isset($request->ficha_tecnica)) ? true : false;
        $entrada->material_daniado    = (isset($request->material_daniado)) ? true : false;
        $entrada->material_limpio     = (isset($request->material_limpio)) ? true : false;
        $entrada->control_grapas      = (isset($request->control_grapas)) ? true : false;
        $entrada->cantidad_conforme   = (isset($request->cantidad_conforme)) ? true : false;

        $entrada->save();

        return redirect()->route('entrada-productos.index');
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $entrada           = Entrada::find($id);
        $entrada->fecha    = $request->fecha;
        $entrada->cantidad = $request->cantidad;

        if ($request->categoria == "cajas") {
            $entrada->caja_id   = $request->material;
            $entrada->pallet_id = null;
        } else {
            $entrada->pallet_id = $request->material;
            $entrada->caja_id   = null;
        }

        $entrada->nro_albaran         = $request->nro_albaran;
        $entrada->fecha_albaran       = Carbon::parse($request->fecha_albaran)->toDateTimeString();
        $entrada->proveedor_id        = $request->proveedor;
        $entrada->transporte_adecuado = (isset($request->transporte_adecuado)) ? true : false;
        $entrada->control_plagas      = (isset($request->control_plagas)) ? true : false;
        $entrada->estado_pallets      = (isset($request->estado_pallets)) ? true : false;
        $entrada->ficha_tecnica       = (isset($request->ficha_tecnica)) ? true : false;
        $entrada->material_daniado    = (isset($request->material_daniado)) ? true : false;
        $entrada->material_limpio     = (isset($request->material_limpio)) ? true : false;
        $entrada->control_grapas      = (isset($request->control_grapas)) ? true : false;
        $entrada->cantidad_conforme   = (isset($request->cantidad_conforme)) ? true : false;

        $entrada->save();

        return redirect()->route('entrada-productos.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $entrada = Entrada::find($id);
        $entrada->delete();

        return redirect()->route('entrada-productos.index');
    }

    public function selectMaterial(Request $request)
    {
        $categoria = $request->input('categoria');

        if (is_null($categoria)) return response()->json(null);

        $data = array();
        if ($categoria == "cajas") {
            $data = Caja::all('id', 'formato');
        }
        if ($categoria == "pallets") {
            $data = Pallet::all('id', 'formato');
        }

        return response()->json($data); // How do I return in json? in case of an error message?
    }

    public function GetEntrada(Request $request)
    {
        $id = $request->input('id');

        if (is_null($id)) return response()->json(null);

        $data = Entrada::find($id);

        return response()->json($data); // How do I return in json? in case of an error message?
    }
}
