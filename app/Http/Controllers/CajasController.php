<?php

namespace App\Http\Controllers;

use DemeterChain\C;
use Illuminate\Http\Request;
use App\Caja;

class CajasController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $caja = new Caja;

        $caja->formato = $request->formato;
        $caja->modelo  = $request->modelo;
        $caja->kg      = $request->kg;
        $caja->save();

        return redirect()->route('materiales')->with('activeNav', 'cajas');
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

        $caja          = Caja::find($request->id);
        $caja->formato = $request->formato;
        $caja->modelo  = $request->modelo;
        $caja->kg      = $request->kg;
        $caja->save();

        return redirect()->route('materiales')->with('activeNav', 'cajas');
    }


    public function delete($id)
    {
        $caja = Caja::find($id);
        $caja->delete();

        return redirect()->route('materiales')->with('activeNav', 'cajas');
    }
}
