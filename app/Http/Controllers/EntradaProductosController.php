<?php

namespace App\Http\Controllers;

use App\Auxiliar;
use App\Caja;
use App\Cubre;
use App\Entrada;
use App\Pallet;
use App\Proveedor;
use App\Contador;
use App\Tarrina;
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
        $entradas = Entrada::where("tipo_mov", "E")->with('proveedor')->get();

        $data = array(
            'entradas'    => $entradas,
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

        $entrada               = new Entrada();
        $entrada->tipo_mov     = "E";
        $entrada->cnv_fact     = 1;
        $entrada->nro_lote     = Contador::save_nro_lote();
        $entrada->fecha        = $request->fecha;
        $entrada->cantidad     = $request->cantidad;
        $entrada->costo_unit   = $request->costo_unit;
        $entrada->categoria    = $request->categoria;
        $entrada->categoria_id = $request->material;


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
        $entrada             = Entrada::find($id);
        $entrada->tipo_mov   = "E";
        $entrada->cnv_fact   = 1;
        $entrada->fecha      = $request->fecha;
        $entrada->cantidad   = $request->cantidad;
        $entrada->costo_unit = $request->costo_unit;

        $entrada->categoria    = $request->categoria;
        $entrada->categoria_id = $request->material;

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
        if ($categoria == "Caja") {
            $data = Caja::all('id', 'formato', 'modelo');
        }
        if ($categoria == "Palet") {
            $data = Pallet::all('id', 'formato');
        }
        if ($categoria == "Cubre") {
            $data = Cubre::all('id', 'formato');
        }
        if ($categoria == "Auxiliar") {
            $data = Auxiliar::all('id', 'modelo as formato');
        }
        if ($categoria == "Tarrina") {
            $data = Tarrina::all('id', 'modelo as formato');
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
