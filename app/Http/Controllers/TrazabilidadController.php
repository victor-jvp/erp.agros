<?php

namespace App\Http\Controllers;

use App\Cultivo;
use App\Finca;
use App\Marca;
use App\Parcela;
use App\Trazabilidad;
use App\Variedad;
use Illuminate\Http\Request;

class TrazabilidadController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = array(
            'fincas'   => Finca::all(),
            'cultivos' => Cultivo::all(),
            'trazabilidades' => Trazabilidad::all(),
        );

        return view('maestros.trazabilidad', $data);
    }

    public function store(Request $request)
    {
        //dd($request);

        $trazabilidad = new Trazabilidad();

        $trazabilidad->fecha       = $request->fecha;
        $trazabilidad->parcela_id  = $request->parcela_id;
        $trazabilidad->variedad_id = $request->variedad_id;
        $trazabilidad->marca_id    = $request->marca_id;

        $trazabilidad->save();

        return redirect()->route('trazabilidad.index');
    }

    public function delete($id)
    {
        $trazabilidad = Trazabilidad::find($id);
        $trazabilidad->delete();

        return redirect()->route('trazabilidad.index');
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $trazabilidad = Trazabilidad::find($request->id);

        $trazabilidad->fecha       = $request->fecha;
        $trazabilidad->parcela_id  = $request->parcela_id;
        $trazabilidad->variedad_id = $request->variedad_id;
        $trazabilidad->marca_id    = $request->marca_id;

        $trazabilidad->save();

        return redirect()->route('trazabilidad.index');
    }

    public function ajaxSelectParcela(Request $request)
    {
        $id = $request->input('id');

        if (is_null($id)) return response()->json(null);

        $data = Parcela::where('finca_id', "=", $id)->get([
            'id',
            'parcela'
        ]);

        return response()->json($data);
    }

    public function ajaxSelectByCultivo(Request $request)
    {
        $id = $request->input('id');

        if (is_null($id)) return response()->json(null);

        $data['variedades'] = Variedad::where('cultivo_id', "=", $id)->get([
            'id',
            'variedad'
        ]);

        $data['marcas'] = Marca::where('cultivo_id', "=", $id)->get([
            'id',
            'marca'
        ]);

        return response()->json($data);
    }
}
