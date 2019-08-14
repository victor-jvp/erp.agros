<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auxiliar;

class AuxiliaresController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $auxiliar = new Auxiliar;

        $auxiliar->modelo  = $request->modelo;
        $auxiliar->save();

        return redirect()->route('materiales')->with('activeNav', 'auxiliares');
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

        $auxiliar          = Auxiliar::find($request->id)->with('activeNav', 'auxiliares');
        $auxiliar->modelo  = $request->modelo;
        $auxiliar->save();

        return redirect()->route('materiales');
    }


    public function delete($id)
    {
        $auxiliar = Auxiliar::find($id);
        $auxiliar->delete();

        return redirect()->route('materiales')->with('activeNav', 'auxiliares');
    }
}
