<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cultivo;
use App\CatDiasSemana;
use App\Especiales;
use App\PedidoProduccion;
use App\Prevision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder;
use function foo\func;

class ComercialController extends Controller
{
    //
    public function dashboard(Request $request)
    {
        if (!is_null($request->semana_act)) {
            $data['semana_act'] = intval($request->semana_act);
        } else {
            $data['semana_act'] = intval(date("W"));
        }

        if (!is_null($request->anio_act)) {
            $data['anio_act'] = intval($request->anio_act);
        } else {
            $data['anio_act'] = intval(date("Y"));
        }

        $semana             = CatDiasSemana::orderBy('order', 'ASC')->get();
        $data['semana']     = $semana;
        $especiales         = Especiales::all()->first();
        $data['semana_ini'] = $especiales->semana_ini;
        $data['semana_fin'] = $especiales->semana_fin;
        $data['anio_ini']   = date('Y', strtotime($especiales->created_at));
        $data['anio_fin']   = date('Y');

        $cultivos = Cultivo::all();

        $resumen = array();
        foreach ($cultivos as $c => $cultivo) {

            //CALCULO DE TABLA RESUMEN PREVISIONES, PEDIDOS COMERCIALES.

            $total     = 0;
            $totalPrev = 0;
            $totalPedc = 0;

            foreach ($semana as $d => $dia) {

                $DiaPrev = DB::table('previsiones')->where('anio', $data['anio_act'])->where('semana', $data['semana_act'])->where('dia', $dia->id)->where('variedades.cultivo_id', $cultivo->id)->join('trazabilidad', 'trazabilidad.id', '=', 'previsiones.trazabilidad_id')->join('variedades', 'variedades.id', '=', 'trazabilidad.variedad_id')->sum('previsiones.cantidad');
                $DiaPedc = DB::table('pedidos_comerciales')->where('anio', $data['anio_act'])->where('semana', $data['semana_act'])->where('dia_id', $dia->id)->where('productoscompuestos_cab.cultivo_id', $cultivo->id)->join('productoscompuestos_det', 'productoscompuestos_det.id', '=', 'pedidos_comerciales.producto_id')->join('productoscompuestos_cab', 'productoscompuestos_cab.id', '=', 'productoscompuestos_det.compuesto_id')->sum('pedidos_comerciales.kilos');

                $resumen['prev_dia'][$d]  = number_format($DiaPrev, 2, ',', '.');
                $resumen['pedc_dia'][$d]  = number_format($DiaPedc, 2, ',', '.');
                $resumen['total_dia'][$d] = number_format(($DiaPrev - $DiaPedc), 2, ',', '.');

                $totalPrev = $totalPrev + $DiaPrev;
                $totalPedc = $totalPedc + $DiaPedc;
                $total     = $total + $DiaPrev - $DiaPedc;
            }

            $resumen['total_prev'] = number_format($totalPrev, 2, ',', '.');
            $resumen['total_pedc'] = number_format($totalPedc, 2, ',', '.');
            $resumen['total']      = number_format($total, 2, ',', '.');


            //PROMEDIO DE CULTIVO SEMANA, AÑO.

            $promSemana = 0;
            $promAnio   = 0;
            $promSemana = 0;

            //LLENAR CHART DE PANEL DE VENTA
            $resumen['chart_prevision'] = abs($totalPrev - $totalPedc);
            $resumen['chart_venta']     = $totalPedc;


            for ($i = $data['semana_ini']; $i <= $data['semana_fin']; $i++) {

                $resumenVenta     = DB::table('pedidos_comerciales')->where('anio', $data['anio_act'])->where('semana', $i)->where('productoscompuestos_cab.cultivo_id', $cultivo->id)->join('productoscompuestos_det', 'productoscompuestos_det.id', '=', 'pedidos_comerciales.producto_id')->join('productoscompuestos_cab', 'productoscompuestos_cab.id', '=', 'productoscompuestos_det.compuesto_id')->sum('pedidos_comerciales.kilos');
                $resumenPrecio    = DB::table('pedidos_comerciales')->where('anio', $data['anio_act'])->where('semana', $i)->where('productoscompuestos_cab.cultivo_id', $cultivo->id)->join('productoscompuestos_det', 'productoscompuestos_det.id', '=', 'pedidos_comerciales.producto_id')->join('productoscompuestos_cab', 'productoscompuestos_cab.id', '=', 'productoscompuestos_det.compuesto_id')->avg('pedidos_comerciales.precio');

                $resumen['venta'][$i]     = number_format($resumenVenta, 2, ',', '.');
                $resumen['precio'][$i]    = number_format($resumenPrecio, 2, ',', '.');
            }

            $cultivos[$c]->resumen = $resumen;
        }

        $data['cultivos'] = $cultivos;
        $data['clientes'] = Cliente::all();

        return view('comercial.dashboard.index')->with($data);
    }

    public function ajaxClienteResumenKilos(Request $request)
    {
        $cliente_id   = $request->input('cliente');
        $desde        = $request->input('desde');
        $hasta        = $request->input('hasta');
        $data['data'] = array();

        if (is_null($cliente_id) || is_null($desde) || is_null($hasta)) return response()->json($data);

        $data['desde_dia']    = date('N', strtotime($desde));
        $data['desde_semana'] = date('W', strtotime($desde));
        $data['desde_anio']   = date('Y', strtotime($desde));

        $data['hasta_dia']    = date('N', strtotime($hasta));
        $data['hasta_semana'] = date('W', strtotime($hasta));
        $data['hasta_anio']   = date('Y', strtotime($hasta));

        $data['desde'] = $data['desde_anio'] . $data['desde_semana'] . $data['desde_dia'];
        $data['hasta'] = $data['hasta_anio'] . $data['hasta_semana'] . $data['hasta_dia'];

        $rows = DB::table('pedidos_comerciales')->select('kilos', 'precio')->where('cliente_id', "=", $cliente_id)->whereRaw('CONCAT(anio,semana,valor) >= ' . $data['desde'])->whereRaw('CONCAT(anio,semana,valor) <= ' . $data['hasta'])->join('cat_dias_semana', 'cat_dias_semana.id', 'pedidos_comerciales.dia_id')->orderBy('pedidos_comerciales.id', 'desc')->take(5)->get();

        foreach ($rows as $r => $row) {
            $rows[$r]->kilos  = number_format($row->kilos, 0, ',', '.');
            $rows[$r]->precio = number_format($row->precio, 2, ',', '.');
        }

        $data['data'] = $rows;

        return response()->json($data);
    }

    public function ajaxClienteResumenVentas(Request $request)
    {
        $cliente_id   = $request->input('cliente');
        $desde        = $request->input('desde');
        $hasta        = $request->input('hasta');
        $data['data'] = array();

        if (is_null($cliente_id) || is_null($desde) || is_null($hasta)) return response()->json($data);

        $data['desde_dia']    = date('N', strtotime($desde));
        $data['desde_semana'] = date('W', strtotime($desde));
        $data['desde_anio']   = date('Y', strtotime($desde));

        $data['hasta_dia']    = date('N', strtotime($hasta));
        $data['hasta_semana'] = date('W', strtotime($hasta));
        $data['hasta_anio']   = date('Y', strtotime($hasta));

        $data['desde'] = $data['desde_anio'] . $data['desde_semana'] . $data['desde_dia'];
        $data['hasta'] = $data['hasta_anio'] . $data['hasta_semana'] . $data['hasta_dia'];

        $rows = DB::table('pedidos_comerciales')->select('precio')->selectRaw('CONCAT(productoscompuestos_det.variable," - ", cajas.formato, " - ", cajas.modelo) as formato')->whereRaw('CONCAT(anio,semana,valor) >= ' . $data['desde'])->whereRaw('CONCAT(anio,semana,valor) <= ' . $data['hasta'])->join('cat_dias_semana', 'cat_dias_semana.id', 'pedidos_comerciales.dia_id')->join('productoscompuestos_det', 'productoscompuestos_det.id', 'pedidos_comerciales.producto_id')->join('cajas', 'cajas.id', 'productoscompuestos_det.caja_id')->orderBy('pedidos_comerciales.id', 'desc')->take(5)->get();

        foreach ($rows as $r => $row) {
            $rows[$r]->precio = number_format($row->precio, 2, ',', '.');
        }

        $data['data'] = $rows;

        return response()->json($data);
    }

    public function ajaxClienteResumenPorSemana(Request $request)
    {
        $proveedor_id       = $request->input('proveedor_id');
        $cultivo_id         = $request->input('cultivo_id');
        $anio_act           = $request->input('anio_act');
        $data['data']       = array();
        $data['data'][0][0] = "Kg Vendidos";
        $data['data'][1][0] = "€/Kg";
        $especiales         = Especiales::all()->first();
        $semana_ini         = $especiales->semana_ini;
        $semana_fin         = $especiales->semana_fin;

        if (is_null($proveedor_id)) {
            for ($i = $semana_ini; $i <= $semana_fin; $i++) {
                $data['data'][0][$i] = "-";
                $data['data'][1][$i] = "-";
            }

            return response()->json($data);
        }

        for ($i = $semana_ini; $i <= $semana_fin; $i++) {
            $totalKilos = DB::table('pedidos_comerciales')->where('anio', $anio_act)->where('semana', $i)->where('productoscompuestos_cab.cultivo_id', $cultivo_id)->where('cliente_id', $proveedor_id)->join('productoscompuestos_det', 'productoscompuestos_det.id', '=', 'pedidos_comerciales.producto_id')->join('productoscompuestos_cab', 'productoscompuestos_cab.id', '=', 'productoscompuestos_det.compuesto_id')->sum('pedidos_comerciales.kilos');
            $totalPrecio = DB::table('pedidos_comerciales')->where('anio', $anio_act)->where('semana', $i)->where('productoscompuestos_cab.cultivo_id', $cultivo_id)->where('cliente_id', $proveedor_id)->join('productoscompuestos_det', 'productoscompuestos_det.id', '=', 'pedidos_comerciales.producto_id')->join('productoscompuestos_cab', 'productoscompuestos_cab.id', '=', 'productoscompuestos_det.compuesto_id')->avg('pedidos_comerciales.precio');

            $data['data'][0][$i] = ($totalKilos > 0) ? number_format($totalKilos, 2, ',', '.') : "-";
            $data['data'][1][$i] = ($totalPrecio > 0) ? number_format($totalPrecio, 2, ',', '.') : "-";
        }

        return response()->json($data);
    }

    public function ajaxEstadoPedidosProduccion(Request $request)
    {
        $fecha = $request->input('fecha');
        $data['data'] = array();
        if (is_null($fecha)) return response()->json($data);

        $data['dia']    = date('N', strtotime($fecha));
        $data['semana'] = date('W', strtotime($fecha));
        $data['anio']   = date('Y', strtotime($fecha));

        $fecha = $data['anio'] . $data['semana'] . $data['dia'];

        $data['data'] = DB::table('pedidos_produccion')
            ->select(['nro_orden', 'razon_social as cliente', 'estado'])
            ->selectRaw('CONCAT(productoscompuestos_det.variable," - ", cajas.formato, " - ", cajas.modelo) as formato')
            ->whereRaw('CONCAT(anio,semana,valor) = ' . $fecha)
            ->join('cat_dias_semana', 'cat_dias_semana.id', 'pedidos_produccion.dia_id')
            ->join('productoscompuestos_det', 'productoscompuestos_det.id', 'pedidos_produccion.producto_id')
            ->join('cajas', 'cajas.id', 'productoscompuestos_det.caja_id')
            ->join('clientes', 'clientes.id', 'pedidos_produccion.cliente_id')
            ->join('pedidos_produccion_estados', 'pedidos_produccion_estados.id', 'pedidos_produccion.estado_id')
            ->orderBy('pedidos_produccion.id', 'desc')->get();

        return response()->json($data);
    }
}
