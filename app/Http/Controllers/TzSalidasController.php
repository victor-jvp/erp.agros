<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\ProductoCompuesto_det;
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
        if (!Auth::user()->can('AgroAlfaro - Salidas | Acceso')) {
            return redirect()->route('home');
        }

        $data = array(
            "proveedores" => TzProveedor::all(),
            "compuestos"  => ProductoCompuesto_det::with('compuesto')->get(),
            "clientes"    => Cliente::all(),
            "salidas"     => TzSalida::all()
        );

        return view('agroAlfaro.salidas.index', $data);
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
        $salida->producto_id        = $request->producto_id;
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
        return view('agroAlfaro.salidas.show');
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
            'salidas.producto.compuesto'
        ])->find($request->get('entrada_id'));

        $data['data'] = $entrada->salidas;

        return response()->json($data);
    }
}
