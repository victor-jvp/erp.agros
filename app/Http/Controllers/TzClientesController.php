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

        return redirect()->route('tz.clientes.show', $cliente->id);
    }

    public function show($id)
    {

        //PERMISO DE ACCESO
        if (!Auth::user()->can('Trazabilidad - Clientes | Acceso') || !Auth::user()->can('Trazabilidad - Clientes | Modificar')) {
            return redirect()->route('home');
        }

        $data['cliente'] = TzCliente::find($id);

        return view('trazabilidad.clientes.show', $data);
    }

    public function update(Request $request, $id)
    {
        $cliente = TzCliente::find($id);

        $cliente->cliente   = $request->cliente;
        $cliente->cif       = $request->cif;
        $cliente->domicilio = $request->domicilio;
        $cliente->poblacion = $request->poblacion;

        $cliente->save();

        return redirect()->route('tz.clientes.show', $cliente->id);
    }

    public function delete($id)
    {
        $cliente = TzCliente::find($id);
        $cliente->delete();

        return redirect()->route('tz.clientes.index');
    }
}
