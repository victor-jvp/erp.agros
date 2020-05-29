<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\ProductoCompuesto_det;
use App\TzEntrada;
use App\TzProveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TzEntradasController extends Controller
{
    //
    public function index()
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('AgroAlfaro - Entradas | Acceso')) {
            return redirect()->route('home');
        }

        $data = array(
            "proveedores" => TzProveedor::all(),
            "compuestos"  => ProductoCompuesto_det::with('compuesto')->get(),
            "clientes"    => Cliente::all(),
            "entradas"    => TzEntrada::with('salidas')->get()
        );

        return view('agroAlfaro.entradas.index', $data);
    }

    public function store(Request $request)
    {

        if (is_null($request->entrada_id)) {
            $entrada        = new TzEntrada();
            $entrada->traza = TzEntrada::new_traza();
        }
        else {
            $entrada = TzEntrada::find($request->entrada_id);
        }

        if (is_null($entrada)) {
            return redirect()->route('tz.entradas.index');
        }

        $entrada->fecha        = date("Y-m-d", strtotime($request->fecha));
        $entrada->albaran      = $request->albaran;
        $entrada->proveedor_id = $request->proveedor_id;
        $entrada->producto_id  = $request->producto_id;
        $entrada->cantidad     = $request->cantidad;
        $entrada->variedad     = $request->variedad;

        $entrada->save();

        return redirect()->route('tz.entradas.index');
    }

    public function show($id)
    {
        return view('agroAlfaro.entradas.show');
    }

    public function generar_merma(Request $request)
    {
        $result = false;
        $id = $request->get('id');
        if (!is_null($id)) {
            $entrada        = TzEntrada::find($id);
            $merma          = $entrada->cantidad - $entrada->salidas()->sum('cantidad');
            $entrada->merma = $merma;
            $entrada->save();
            $result         = true;
        }

        return response()->json($result);
    }


    public function ajaxCount(Request $request)
    {
        $result = TzEntrada::where('fecha', $request->get('fecha'))->withTrashed()->count() + 1;
        $result = str_pad($result, 3, "0", STR_PAD_LEFT);
        return response()->json($result);
    }
}
