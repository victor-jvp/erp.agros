<?php

namespace App\Http\Controllers;

use App\Caja;
use App\Pallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListadoInventarioController extends Controller
{
    public function index()
    {
//        $pallets = Pallet::with([
//            'entradas',
//            'salidas',
//        ])->get();
//
//        $cajas = Caja::with([
//            'entradas',
//            'salidas'
//        ])->get();
//
//        dd($cajas);

        $data['inventario'] = DB::select("
SELECT
    'Caja' as categoria,
    cajas.formato,
    SUM( entradas.cantidad ) AS entradas,
    SUM( salidas.cantidad ) AS salidas,
    SUM( entradas.cantidad ) - SUM( salidas.cantidad ) AS total 
FROM
    cajas
    INNER JOIN entradas ON entradas.caja_id = cajas.id
    INNER JOIN salidas ON salidas.caja_id = cajas.id 
WHERE
    entradas.deleted_at IS NULL 
    AND salidas.deleted_at IS NULL 
GROUP BY
    cajas.formato UNION
SELECT
    'Palet' as categoria,
    pallets.formato,
    SUM( entradas.cantidad ) AS entradas,
    SUM( salidas.cantidad ) AS salidas,
    SUM( entradas.cantidad ) - SUM( salidas.cantidad ) AS total 
FROM
    pallets
    INNER JOIN entradas ON entradas.caja_id = pallets.id
    INNER JOIN salidas ON salidas.caja_id = pallets.id 
WHERE
    entradas.deleted_at IS NULL 
    AND salidas.deleted_at IS NULL 
GROUP BY
    pallets.formato;");

        return view('almacen.inventario', $data);
    }
}
