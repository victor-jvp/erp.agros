<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TzCliente;
use Illuminate\Support\Facades\Auth;

class TzClientesController extends Controller
{
    //
    public function index(Request $request)
    {
         //PERMISO DE ACCESO
        if (!Auth::user()->can('Trazabilidad - Clientes | Acceso')) {
            return redirect()->route('home');
        }

        $data = array(
            "clientes" => TzCliente::all(),
        );

        return view('trazabilidad.clientes.index', $data);
    }

    public function create(Request $request)
    {
        //dd($request);
        $cliente = new TzCliente();

        $cliente->cliente   = $request->cliente;
        $cliente->cif       = $request->cif;
        $cliente->domicilio = $request->domicilio;
        $cliente->poblacion = $request->poblacion;

        $cliente->save();

        return redirect()->route('trazabilidad.clientes.show', $cliente->id);
    }

    public function show($id)
    {

    }
}
