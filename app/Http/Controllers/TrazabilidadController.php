<?php

namespace App\Http\Controllers;

use App\Cultivo;
use App\Finca;
use App\Marca;
use App\Parcela;
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
            'cultivos' => Cultivo::all()
        );

        return view('maestros.trazabilidad', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
