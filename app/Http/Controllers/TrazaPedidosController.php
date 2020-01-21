<?php

namespace App\Http\Controllers;

use App\Inventario;
use App\InventarioRel;
use App\PedidoProduccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrazaPedidosController extends Controller
{
    //
    public function index()
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Almacen | Acceso') || !Auth::user()->can('Almacen - Traza de Pedidos | Acceso')) {
            return redirect()->route('home');
        }

        $data['pedidos'] = PedidoProduccion::with([
            'cliente'
        ])->where('estado_id', '=', 3)->get();

        return view('almacen.traza-pedidos.index')->with($data);
    }

    public function details(Request $request)
    {
        $id = $request->input('id');

        $data = array();
        if (is_null($id)) return response()->json($data);

        $data = PedidoProduccion::with([
            'cliente',
            'variable.caja',
            'auxiliares.auxiliar',
            'palet_auxiliares.auxiliar',
            'tarrinas.tarrina',
            'palet.modelo'
        ])->find($id);

        $materiales = array();

        // Palets
        $material['material']      = $data->palet->modelo->modelo . " - " . $data->palet->formato;
        $material['cantidad']      = "";
        $entradas                  = $this->movimiento_inventario("entrada_id", $id, "Palet", $data->pallet_id);
        $material['entradas']      = "";
        $material['proveedor']    = "";
        $material['nro_albaran']   = "";
        $material['fecha_albaran'] = "";
        foreach ($entradas as $entrada) {
            $material['entradas']      .= $entrada->nro_lote . "<br>";
            $material['proveedor']    .= $entrada->razon_social . "<br>";
            $material['nro_albaran']   .= $entrada->nro_albaran . "<br>";
            $material['fecha_albaran'] .= (!is_null($entrada->fecha_albaran)) ? date('d/m/Y', strtotime($entrada->fecha_albaran)) . "<br>" : "";
        }
        $salidas             = $this->movimiento_inventario("salida_id", $id, "Palet", $data->pallet_id);
        $material['salidas'] = "";
        foreach ($salidas as $salida) {
            $material['salidas']  .= $salida->nro_lote . "<br>";
            $material['cantidad'] .= $salida->cantidad . "<br>";
        }
        $materiales[] = $material;

        // Cajas
        $material['material']      = $data->variable->caja->formato . " - " . $data->variable->caja->modelo;
        $material['cantidad']      = "";
        $entradas                  = $this->movimiento_inventario("entrada_id", $id, "Caja", $data->variable->caja_id);
        $material['entradas']      = "";
        $material['proveedor']    = "";
        $material['nro_albaran']   = "";
        $material['fecha_albaran'] = "";
        foreach ($entradas as $entrada) {
            $material['entradas']      .= $entrada->nro_lote . "<br>";
            $material['proveedor']    .= $entrada->razon_social . "<br>";
            $material['nro_albaran']   .= $entrada->nro_albaran . "<br>";
            $material['fecha_albaran'] .= (!is_null($entrada->fecha_albaran)) ? date('d/m/Y', strtotime($entrada->fecha_albaran)) . "<br>" : "";
        }
        $salidas             = $this->movimiento_inventario("salida_id", $id, "Caja", $data->variable->caja_id);
        $material['salidas'] = "";
        foreach ($salidas as $salida) {
            $material['salidas']  .= $salida->nro_lote . "<br>";
            $material['cantidad'] .= $salida->cantidad . "<br>";
        }
        $materiales[] = $material;

        if (count($data->tarrinas) > 0) {
            foreach ($data->tarrinas as $detalle) {
                $material['material'] = $detalle->tarrina->modelo;
                $material['cantidad'] = "";

                $entradas = $this->movimiento_inventario("entrada_id", $id, "Tarrina", $detalle->tarrina_id);

                $material['entradas']      = "";
                $material['proveedor']    = "";
                $material['nro_albaran']   = "";
                $material['fecha_albaran'] = "";
                foreach ($entradas as $entrada) {
                    $material['entradas']      .= $entrada->nro_lote . "<br>";
                    $material['proveedor']    .= $entrada->razon_social . "<br>";
                    $material['nro_albaran']   .= $entrada->nro_albaran . "<br>";
                    $material['fecha_albaran'] .= (!is_null($entrada->fecha_albaran)) ? date('d/m/Y', strtotime($entrada->fecha_albaran)) . "<br>" : "";
                }

                $salidas = $this->movimiento_inventario("salida_id", $id, "Tarrina", $detalle->tarrina_id);

                $material['salidas'] = "";
                foreach ($salidas as $salida) {
                    $material['salidas']  .= $salida->nro_lote . "<br>";
                    $material['cantidad'] .= $salida->cantidad . "<br>";
                }

                $materiales[] = $material;
            }
        }

        if (count($data->auxiliares) > 0) {
            foreach ($data->auxiliares as $detalle) {
                $material['material'] = $detalle->auxiliar->modelo;
                $material['cantidad'] = "";
                $entradas             = $this->movimiento_inventario("entrada_id", $id, "Auxiliar", $detalle->auxiliar_id);

                $material['entradas']      = "";
                $material['proveedor']    = "";
                $material['nro_albaran']   = "";
                $material['fecha_albaran'] = "";
                foreach ($entradas as $entrada) {
                    $material['entradas']      .= $entrada->nro_lote . "<br>";
                    $material['proveedor']    .= $entrada->razon_social . "<br>";
                    $material['nro_albaran']   .= $entrada->nro_albaran . "<br>";
                    $material['fecha_albaran'] .= (!is_null($entrada->fecha_albaran)) ? date('d/m/Y', strtotime($entrada->fecha_albaran)) . "<br>" : "";
                }

                $salidas = $this->movimiento_inventario("salida_id", $id, "Auxiliar", $detalle->auxiliar_id);

                $material['salidas'] = "";

                foreach ($salidas as $salida) {
                    $material['salidas']  .= $salida->nro_lote . "<br>";
                    $material['cantidad'] .= $salida->cantidad . "<br>";
                }

                $materiales[] = $material;
            }
        }

        if (count($data->palet_auxiliares) > 0) {
            foreach ($data->palet_auxiliares as $detalle) {
                $material['material'] = $detalle->auxiliar->modelo;
                $material['cantidad'] = "";
                $entradas             = $this->movimiento_inventario("entrada_id", $id, "Auxiliar", $detalle->auxiliar_id);

                $material['entradas']      = "";
                $material['proveedor']    = "";
                $material['nro_albaran']   = "";
                $material['fecha_albaran'] = "";
                foreach ($entradas as $entrada) {
                    $material['entradas']      .= $entrada->nro_lote . "<br>";
                    $material['proveedor']    .= $entrada->razon_social . "<br>";
                    $material['nro_albaran']   .= $entrada->nro_albaran . "<br>";
                    $material['fecha_albaran'] .= (!is_null($entrada->fecha_albaran)) ? date('d/m/Y', strtotime($entrada->fecha_albaran)) . "<br>" : "";
                }

                $salidas             = $this->movimiento_inventario("salida_id", $id, "Auxiliar", $detalle->auxiliar_id);
                $material['salidas'] = "";

                foreach ($salidas as $salida) {
                    $material['salidas']  .= $salida->nro_lote . "<br>";
                    $material['cantidad'] .= $salida->cantidad . "<br>";
                }

                $materiales[] = $material;
            }
        }

        $data->materiales = $materiales;

        return response()->json($data);
    }

    private function movimiento_inventario($rel_id, $pedido_id, $categoria, $categoria_id)
    {
        return DB::table('inventario_rel')->select('inventario.nro_lote', 'inventario_rel.cantidad', 'proveedores.razon_social', 'inventario.nro_albaran', 'inventario.fecha_albaran')->join('inventario', 'inventario.id', '=', 'inventario_rel.' . $rel_id)->leftJoin('proveedores', 'proveedores.id', '=', 'inventario.proveedor_id')->where('pedido_id', $pedido_id)->where('categoria', $categoria)->where('categoria_id', $categoria_id)->get();
    }
}
