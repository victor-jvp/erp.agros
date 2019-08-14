<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Finca;

class FincasController extends Controller
{
    public function store(Request $request)
    {
        $finca        = new Finca();
        $finca->finca = $request->finca;
        $finca->save();

        return redirect()->route('fincas')->with('activeNav', 'fincas');
    }

    public function update(Request $request, $id)
    {
        //

        $finca        = Finca::find($request->id);
        $finca->finca = $request->finca;
        $finca->save();

        return redirect()->route('fincas')->with('activeNav', 'fincas');
    }


    public function delete($id)
    {
        $finca = Finca::find($id);
        $finca->delete();

        return redirect()->route('fincas')->with('activeNav', 'fincas');
    }
}
