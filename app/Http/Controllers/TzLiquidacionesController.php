<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\TzSalida;
use App\TzEntrada;
use App\TzProveedor;
use App\ProductoCompuesto_det;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TzLiquidacionesController extends Controller
{
    //
    public function index()
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('AgroAlfaro - Salidas | Acceso')) {
            return redirect()->route('home');
        }

        $data = array(
            "proveedores" => TzProveedor::all(),
            "compuestos"  => ProductoCompuesto_det::with('compuesto')->get(),
            "salidas"     => TzSalida::all()
        );

        return view('agroAlfaro.liquidaciones.index', $data);
    }
}
