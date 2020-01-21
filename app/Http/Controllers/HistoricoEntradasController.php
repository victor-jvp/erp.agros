<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use App\Contador;
use App\Entrada;
use Illuminate\Support\Facades\Auth;

class HistoricoEntradasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Almacen | Acceso') || !Auth::user()->can('Almacen - Histórico | Acceso')) {
            return redirect()->route('home');
        }

        $entradas = Entrada::where("tipo_mov", "E")->with('proveedor')->get();

        $data = array(
            'entradas'    => $entradas,
            "proveedores" => Proveedor::all('id', 'razon_social'),
            "nro_lote"    => Contador ::next_nro_lote(),
        );

        return view('almacen.historico.index', $data);
    }
}
