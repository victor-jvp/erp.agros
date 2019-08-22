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
    IFNULL(SUM( entradas.cantidad ), 0) AS entradas,
    IFNULL(SUM( salidas.cantidad ), 0) AS salidas,
    IFNULL(SUM( entradas.cantidad ), 0) - IFNULL(SUM( salidas.cantidad ), 0) AS total 
FROM
    cajas
    LEFT JOIN entradas ON entradas.caja_id = cajas.id
    LEFT JOIN salidas ON salidas.caja_id = cajas.id 
WHERE
    entradas.deleted_at IS NULL 
    AND salidas.deleted_at IS NULL 
GROUP BY
    cajas.formato
UNION
SELECT
    'Palet' as categoria,
    pallets.formato,
    IFNULL(SUM( entradas.cantidad ), 0) AS entradas,
    IFNULL(SUM( salidas.cantidad ), 0) AS salidas,
    IFNULL(SUM( entradas.cantidad ), 0) - IFNULL(SUM( salidas.cantidad ), 0) AS total 
FROM
    pallets
    LEFT JOIN entradas ON entradas.pallet_id = pallets.id
    LEFT JOIN salidas ON salidas.pallet_id = pallets.id 
WHERE
    entradas.deleted_at IS NULL AND salidas.deleted_at IS NULL 
GROUP BY
    pallets.formato");

        return view('almacen.inventario', $data);
    }
}
