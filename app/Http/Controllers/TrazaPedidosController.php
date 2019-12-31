<?php

namespace App\Http\Controllers;

use App\Inventario;
use App\InventarioRel;
use App\PedidoProduccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrazaPedidosController extends Controller
{
    //
    public function index()
    {

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
            'auxiliares.auxiliar',
            'palet_auxiliares.auxiliar',
            'tarrinas.tarrina'
        ])->find($id);

        $materiales = array();

        if (count($data->tarrinas) > 0) {
            foreach ($data->tarrinas as $detalle) {
                $material['material'] = $detalle->tarrina->modelo;
                $material['cantidad'] = "";

                $entradas = $this->movimiento_inventario("entrada_id", $id, "Tarrina", $detalle->tarrina_id);

                $material['entradas'] = "";
                foreach ($entradas as $entrada)
                {
                    $material['entradas'] .= $entrada->nro_lote."<br>";
                }

                $salidas = $this->movimiento_inventario("salida_id", $id, "Tarrina", $detalle->tarrina_id);

                $material['salidas']  = "";
                foreach ($salidas as $salida)
                {
                    $material['salidas'] .= $salida->nro_lote."<br>";
                    $material['cantidad'] .= $salida->cantidad."<br>";
                }

                $materiales[] = $material;
            }
        }

        if (count($data->auxiliares) > 0) {
            foreach ($data->auxiliares as $detalle) {
                $material['material'] = $detalle->auxiliar->modelo;
                $material['cantidad'] = "";
                $entradas = $this->movimiento_inventario("entrada_id", $id, "Auxiliar", $detalle->auxiliar_id);

                $material['entradas'] = "";
                foreach ($entradas as $entrada)
                {
                    $material['entradas'] .= $entrada->nro_lote."<br>";
                }

                $salidas = $this->movimiento_inventario("salida_id", $id, "Auxiliar", $detalle->auxiliar_id);

                $material['salidas']  = "";

                foreach ($salidas as $salida)
                {
                    $material['salidas'] .= $salida->nro_lote."<br>";
                    $material['cantidad'] .= $salida->cantidad."<br>";
                }

                $materiales[] = $material;
            }
        }

        if (count($data->palet_auxiliares) > 0) {
            foreach ($data->palet_auxiliares as $detalle) {
                $material['material'] = $detalle->auxiliar->modelo;
                $material['cantidad'] = "";
                $entradas = $this->movimiento_inventario("entrada_id", $id, "Auxiliar", $detalle->auxiliar_id);

                $material['entradas'] = "";
                foreach ($entradas as $entrada)
                {
                    $material['entradas'] .= $entrada->nro_lote."<br>";
                }

                $salidas = $this->movimiento_inventario("salida_id", $id, "Auxiliar", $detalle->auxiliar_id);
                $material['salidas']  = "";

                foreach ($salidas as $salida)
                {
                    $material['salidas'] .= $salida->nro_lote."<br>";
                    $material['cantidad'] .= $salida->cantidad."<br>";
                }

                $materiales[] = $material;
            }
        }

        $data->materiales = $materiales;

        return response()->json($data);
    }

    private  function movimiento_inventario($rel_id, $pedido_id, $categoria, $categoria_id)
    {
        return DB::table('inventario_rel')
          ->select('inventario.nro_lote', 'inventario_rel.cantidad')
          ->join('inventario', 'inventario.id', '=', 'inventario_rel.'.$rel_id)
          ->where('pedido_id', $pedido_id)
          ->where('categoria', $categoria)
          ->where('categoria_id', $categoria_id)
          ->get();
    }
}
