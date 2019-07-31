<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marca;

class MarcasController extends Controller
{
    //
    //
    public function store(Request $request)
    {
        $marca = new Marca();
        $marca->marca = $request->marca;
        $marca->cultivo_id = $request->cultivo_id;
        $marca->save();

        return redirect()->route('familias-marcas');
    }

    public function update(Request $request, $id)
    {
        $marca = Marca::find($request->id);
        $marca->marca = $request->marca;
        $marca->cultivo_id = $request->cultivo_id;
        $marca->save();

        return redirect()->route('familias-marcas');
    }

    public function delete($id)
    {
        $marca = Marca::find($id);
        $marca->delete();

        return redirect()->route('familias-marcas');
    }
}
