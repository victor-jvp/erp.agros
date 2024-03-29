<?php

namespace App\Http\Controllers;

use App\Cultivo;
use App\Finca;
use App\Parcela;
use App\Trazabilidad;
use App\Variedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrazabilidadController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Maestros | Acceso') || !Auth::user()->can('Maestros - Trazabilidad | Acceso')) {
            return redirect()->route('home');
        }

        $data = array(
            'fincas'         => Finca::all(),
            'cultivos'       => Cultivo::all(),
            'trazabilidades' => Trazabilidad::all(),
        );

        return view('maestros.trazabilidad', $data);
    }

    public function store(Request $request)
    {
        //dd($request);

        $trazabilidad = new Trazabilidad();

        $trazabilidad->parcela_id  = $request->parcela_id;
        $trazabilidad->variedad_id = $request->variedad_id;

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

        $trazabilidad->parcela_id  = $request->parcela_id;
        $trazabilidad->variedad_id = $request->variedad_id;

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

        return response()->json($data);
    }

    public function ajaxTrazabilidadExist(Request $request)
    {
        $variedad_id = $request->input('variedad_id');
        $parcela_id  = $request->input('parcela_id');

        $data['IsValid'] = Trazabilidad::IsValid($variedad_id, $parcela_id);

        return response()->json($data);
    }
}
