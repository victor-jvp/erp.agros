<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parcela;

class ParcelasController extends Controller
{
    public function store(Request $request)
    {
        $parcela = new Parcela();
        $parcela->parcela = $request->parcela;
        $parcela->finca_id = $request->finca_id;
        $parcela->save();

        return redirect()->route('fincas');
    }

    public function update(Request $request, $id)
    {
        $parcela = Parcela::find($request->id);
        $parcela->parcela = $request->parcela;
        $parcela->finca_id = $request->finca_id;
        $parcela->save();

        return redirect()->route('fincas');
    }

    public function delete($id)
    {
        $parcela = Parcela::find($id);
        $parcela->delete();

        return redirect()->route('fincas');
    }
}
