<?php

namespace App\Http\Controllers;

use App\Transporte;
use Illuminate\Http\Request;

class TransporteController extends Controller
{
    //

    public function index()
    {
        $transportes = Transporte::all();
        return view('comercial.transportes.index', ['transportes' => $transportes]);
    }

    public function store(Request $request)
    {
        $transporte = new Transporte();

        $transporte->cif          = $request->cif;
        $transporte->razon_social = $request->razon_social;
        $transporte->save();

        return redirect()->route('transportes.show', $transporte->id);
    }

    public function show(Request $request, $id)
    {
        $transporte = Transporte::find($id);

        $data = array(
            'transporte' => $transporte,
            "tab"        => ($request->session()->get('tab')) ? $request->session()->get('tab') : "datos-fiscales",
        );

        return view('comercial.transportes.show', $data);
    }

    public function update(Request $request, $id)
    {
        //

        $transporte = Transporte::find($request->id);

        //Datos Fiscales
        if ($request->_tab == "datos-fiscales") {
            $transporte->cif              = $request->cif;
            $transporte->razon_social     = $request->razon_social;
            $transporte->nombre_comercial = $request->nombre_comercial;
            $transporte->pais             = $request->pais;
            $transporte->localidad        = $request->localidad;
            $transporte->provincia        = $request->provincia;
            $transporte->direccion        = $request->direccion;
            $transporte->telefono         = $request->telefono;
            $transporte->email            = $request->email;

            $transporte->save();
        }

        $data = array(
            'id' => $transporte->id,
        );

        $request->session()->flash('tab', $request->_tab);
        $request->session()->keep(['tab']);

        return redirect()->route('transportes.show', $data);
    }
}
