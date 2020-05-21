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

        $salida->traza              = $request->traza;
        $salida->fecha              = $request->fecha;
        $salida->proveedor_id       = $request->proveedor_id;
        $salida->articulo_id        = $request->articulo_id;
        $salida->entrada_id         = $request->entrada_id;
        $salida->cantidad           = $request->cantidad;
        $salida->cajas              = $request->cajas;
        $salida->precio             = $request->precio;
        $salida->cliente_id         = $request->cliente_id;
        $salida->coste              = $request->coste;
        $salida->comision           = $request->comision;
        $salida->precio_liquidacion = $request->precio_liquidacion;
        $salida->pagada             = (isset($request->pagada)) ? true : false;

        $salida->save();

        return redirect()->route('tz.salidas.index');
    }

    public function show($id)
    {
        return view('trazabilidad.salidas.show');
    }

    public function getByEntrada(Request $request)
    {
        if (is_null($request->get('entrada_id'))) {
            return response()->json(array('data' => []));
        }

        $data = array();
        $entrada = TzEntrada::with([
            'salidas.proveedor',
            'salidas.cliente',
            'salidas.articulo'
        ])->find($request->get('entrada_id'));

        $data['data'] = $entrada->salidas;

        return response()->json($data);
    }
}
