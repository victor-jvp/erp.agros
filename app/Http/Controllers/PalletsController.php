<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pallet;

class PalletsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $pallet = new Pallet();

        $pallet->formato = $request->formato;
        $pallet->modelo_id = 1;
        $pallet->save();

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

        $pallet          = Pallet::find($request->id);
        $pallet->formato = $request->formato;
        $pallet->modelo_id = 1;
        $pallet->save();

        return redirect()->route('materiales');
    }


    public function delete($id)
    {
        $pallet = Pallet::find($id);
        $pallet->delete();

        return redirect()->route('materiales');
    }
}
