<?php

namespace App\Http\Controllers;

use App\Caja;
use App\Entrada;
use App\Pallet;
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
            'entradas'   => $entradas,
            "categorias" => $categorias,
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
        //
        dd($request);

        $entrada                      = new Entrada();
        $entrada->nro_lote            = $request->nro_lote;
        $entrada->fecha               = $request->fecha;
        $entrada->cantidad            = $request->cantidad;
        $entrada->categoria           = $request->categoria;
        $entrada->material            = $request->material;
        $entrada->formato             = $request->formato;
        $entrada->nro_albaran         = $request->nro_albaran;
        $entrada->fecha_albaran       = $request->fecha_albaran;
        $entrada->transporte_adecuado = (isset($request->transporte_adecuado)) ? true : false;
        $entrada->control_plagas      = (isset($request->control_plagas)) ? true : false;
        $entrada->estado_pallets      = (isset($request->estado_pallets)) ? true : false;
        $entrada->ficha_tecnica       = (isset($request->ficha_tecnica)) ? true : false;
        $entrada->material_daniado    = (isset($request->material_daniado)) ? true : false;
        $entrada->material_limpio     = (isset($request->material_limpio)) ? true : false;

        $entrada->save();

        return redirect()->route('entrada-productos.index');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function selectMaterial(Request $request)
    {
        $categoria = $request->input('categoria');

        if(is_null($categoria)) return response()->json(null);

        $data = array();
        if($categoria == "cajas"){
            $data = Caja::all('id', 'formato');
        }
        if($categoria == "pallets"){
            $data = Pallet::all('id', 'formato');
        }

        return response()->json($data); // How do I return in json? in case of an error message?
    }
}
