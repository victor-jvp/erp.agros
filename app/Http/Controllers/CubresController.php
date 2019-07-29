<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cubre;

class CubresController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $cubre = new Cubre();

        $cubre->formato = $request->formato;
        $cubre->save();

        return redirect()->route('materiales');
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

        $cubre          = Cubre::find($request->id);
        $cubre->formato = $request->formato;
        $cubre->save();

        return redirect()->route('materiales');
    }


    public function delete($id)
    {
        $cubre = Cubre::find($id);
        $cubre->delete();

        return redirect()->route('materiales');
    }
}
