<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cultivo;

class CultivosController extends Controller
{
    
    public function store(Request $request)
    {
    	$cultivo = new Cultivo();

    	$cultivo->cultivo = $request->cultivo;
        $cultivo->save();

        return redirect()->route('familias-marcas')->with('activeNav', 'cultivos');
    }

    public function update(Request $request, $id)
    {
        //

        $cultivo          = Cultivo::find($request->id);
        $cultivo->cultivo = $request->cultivo;
        $cultivo->save();

        return redirect()->route('familias-marcas')->with('activeNav', 'cultivos');
    }


    public function delete($id)
    {
        $cultivo = Cultivo::find($id);
        $cultivo->delete();

        return redirect()->route('familias-marcas')->with('activeNav', 'cultivos');
    }
}
