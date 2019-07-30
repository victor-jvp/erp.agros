<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Variedad;

class VariedadesController extends Controller
{
    //
    public function store(Request $request)
    {
        $variedad = new Variedad();
        $variedad->variedad = $request->variedad;
        $variedad->cultivo_id = $request->cultivo_id;
        $variedad->save();

        return redirect()->route('familias-marcas');
    }

    public function update(Request $request, $id)
    {
        $variedad = Variedad::find($request->id);
        $variedad->variedad = $request->variedad;
        $variedad->cultivo_id = $request->cultivo_id;
        $variedad->save();

        return redirect()->route('familias-marcas');
    }

    public function delete($id)
    {
        $variedad = Variedad::find($id);
        $variedad->delete();

        return redirect()->route('familias-marcas');
    }
}
