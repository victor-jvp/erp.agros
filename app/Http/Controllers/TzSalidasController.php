<?php

namespace App\Http\Controllers;

use App\TzArticulo;
use App\TzCliente;
use App\TzEntrada;
use App\TzProveedor;
use App\TzSalida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TzSalidasController extends Controller
{
    public function index()
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Trazabilidad - Salidas | Acceso')) {
            return redirect()->route('home');
        }

        $data = array(
            "proveedores" => TzProveedor::all(),
            "articulos"   => TzArticulo::all(),
            "clientes"    => TzCliente::all(),
            "salidas"     => TzSalida::all()
        );

        return view('trazabilidad.salidas.index', $data);
    }

    public function store(Request $request)
    {
        if (is_null($request->salida_id)) {
            $salida = new TzSalida();
        }
        else {
            $salida = TzSalida::find($request->salida_id);
        }

        if (is_null($salida)) {
            return redirect()->route('tz.salidas.index');
        }

        $salida->fecha        = $request->fecha;
        $salida->albaran      = $request->albaran;
        $salida->traza        = $request->traza;
        $salida->proveedor_id = $request->proveedor_id;
        $salida->articulo_id  = $request->articulo_id;
        $salida->cantidad     = $request->cantidad;
        $salida->variedad     = $request->variedad;

        $salida->save();

        return redirect()->route('tz.salidas.index');
    }

    public function show($id)
    {
        return view('trazabilidad.salidas.show');
    }
}
