<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarrina;

class TarrinasController extends Controller
{
    public function store(Request $request)
    {
        $tarrina = new Tarrina();
        $tarrina->modelo = $request->modelo;
        $tarrina->save();

        return redirect()->route('materiales');
    }

    public function update(Request $request, $id)
    {
        $tarrina = Tarrina::find($request->id);
        $tarrina->modelo = $request->modelo;
        $tarrina->save();

        return redirect()->route('materiales');
    }

    public function delete($id)
    {
        $tarrina = Tarrina::find($id);
        $tarrina->delete();

        return redirect()->route('materiales');
    }
}
