<?php

namespace App\Http\Controllers;

use App\Auxiliar;
use App\Caja;
use App\Cubre;
use App\Pallet;
use App\Salida;
use App\Contador;
use App\Tarrina;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalidaProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['salidas']    = Salida::where("tipo_mov", "S")->get();
        $data['nro_salida'] = Contador::next_nro_salida();
        return view('almacen.salidas', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $salida               = new Salida();
        $salida->tipo_mov     = "S";
        $salida->cnv_fact     = -1;
        $salida->nro_lote     = Contador::save_nro_salida();
        $salida->fecha        = $request->fecha;
        $salida->categoria    = $request->categoria;
        $salida->categoria_id = $request->material;
        $salida->cantidad     = $request->cantidad;
        $salida->save();

        return redirect()->route("salida-productos.index");
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $salida = Salida::find($id);
        $salida->delete();

        return redirect()->route('salida-productos.index');
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $salida               = Salida::find($id);
        $salida->tipo_mov     = "S";
        $salida->cnv_fact     = -1;
        $salida->nro_lote     = $request->nro_salida;
        $salida->fecha        = $request->fecha;
        $salida->categoria    = $request->categoria;
        $salida->categoria_id = $request->material;
        $salida->cantidad     = $request->cantidad;
        $salida->save();

        return redirect()->route("salida-productos.index");
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
}
