<?php

namespace App\Http\Controllers;

use App\Auxiliar;
use App\CatDiasSemana;
use App\Cliente;
use App\ClienteDestinos;
use App\Contador;
use App\Cubre;
use App\Cultivo;
use App\PalletModel;
use App\PedidoComercial;
use App\PedidoComercialAuxiliar;
use App\PedidoComercialEstado;
use App\PedidoComercialTarrina;
use App\ProductoCompuesto_auxiliares;
use App\ProductoCompuesto_cab;
use App\ProductoCompuesto_det;
use App\ProductoCompuesto_tarrinas;
use App\Tarrina;
use App\Transporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosComercialController extends Controller
{
    public function index(Request $request)
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

        $cultivos    = Cultivo::all();
        $clientes    = Cliente::all();
        $transportes = Transporte::all();
        $estados     = PedidoComercialEstado::all();
        $productos   = ProductoCompuesto_cab::with('det')->get();
        $modelos     = PalletModel::all();
        $nro_orden   = Contador::Next_nro_pedido_comercial();
        $tarrinas    = Tarrina::all();
        $auxiliares  = Auxiliar::all();
        $cubres      = Cubre::all();
        $variedades  = ProductoCompuesto_det::with('compuesto.cultivo')->get();

        $compuestos = array();
        foreach ($variedades as $v => $variedad) {
            $compuestos[$v]['id']          = $variedad->id;
            $cultivo =  (!is_null($variedad->compuesto->cultivo )) ? $variedad->compuesto->cultivo->cultivo." - " : "";
            $compuestos[$v]['descripcion'] = $cultivo.$variedad->variable;
        }

        foreach ($cultivos as $c => $cultivo) {
            $pedidos               = PedidoComercial::where('cultivo_id', $cultivo->id)->where('anio', $data['anio_act'])->where('semana', $data['semana_act'])->get();
            $cultivos[$c]->pedidos = $pedidos;
        }

        $data['semana']      = CatDiasSemana::orderBy('order', 'ASC')->get();
        $data['semana_ini']  = 1;
        $data['semana_fin']  = 50;
        $data['anio_ini']    = 2019;
        $data['anio_fin']    = Date('Y');
        $data["cultivos"]    = $cultivos;
        $data['clientes']    = $clientes;
        $data['transportes'] = $transportes;
        $data['estados']     = $estados;
        $data['productos']   = $productos;
        $data['modelos']     = $modelos;
        $data['tarrinas']    = $tarrinas;
        $data['auxiliares']  = $auxiliares;
        $data['cubres']      = $cubres;
        $data['variedades']  = $variedades;
        $data['nro_orden']   = date('dmY') . "-" . $nro_orden;
        $data['compuestos']  = $compuestos;

        return view("comercial.pedidos-comercial.index")->with($data);
    }

    public function details(Request $request)
    {
        $id = $request->input('id');

        if (is_null($id)) return response()->json(null);

        $data = PedidoComercial::with([
            'compuesto',
            'tarrinas.tarrina',
            'auxiliares.auxiliar'
        ])->find($id);

        return response()->json($data);
    }

    public function store(Request $request)
    {
        //        dd($request);
        $data = array();
        foreach ($request->dias as $dia) {
            $pedido = new PedidoComercial();

            $pedido->nro_orden   = date('dmY') . "-" . Contador::Save_nro_pedido_comercial();
            $pedido->anio        = $request->anio;
            $pedido->semana      = $request->semana;
            $pedido->dia_id      = $dia;
            $pedido->cliente_id  = $request->cliente;
            $pedido->destino_id  = $request->destino_comercial;
            $pedido->cultivo_id  = $request->cultivo;
            $pedido->producto_id = $request->producto_compuesto;
            $pedido->pallet_id   = $request->formato_palet;
            $pedido->cantidad    = $request->cantidad;
            $pedido->etiqueta    = $request->etiqueta;
            $pedido->precio      = $request->precio;
            $pedido->kilos       = $request->kilos;
            $pedido->comentarios = $request->comentario;
            $pedido->estado_id   = $request->estado;
            $pedido->modelo_id   = $request->modelo_palet;

            $pedido->save();
            $data['anio_act']   = $request->anio;
            $data['semana_act'] = $request->semana;

            if ($request->modelo_palet == "1") { // Es un Europalet
                $pedido->formato_cantidad = $request->euro_cantidad;
                $pedido->formato_kilos    = $request->euro_kg;
                $pedido->cubre_id         = null;
                $pedido->cubre_cantidad   = null;

                $pedido->save();

                if (count($request->euro_tarrinas_id) > 0) {
                    foreach ($request->euro_tarrinas_id as $e => $euro_tarrina) {
                        $tarrina                   = new PedidoComercialTarrina();
                        $tarrina->tarrina_id       = $euro_tarrina;
                        $tarrina->cantidad         = $request->euro_tarrinas_cantidad[$e];
                        $tarrina->cantidad_inicial = $request->euro_tarrinas_inicial[$e];

                        $pedido->tarrinas()->save($tarrina);
                    }
                }

                if (count($request->euro_auxiliares_id) > 0) {
                    foreach ($request->euro_auxiliares_id as $e => $euro_auxiliar) {
                        $auxiliar                   = new PedidoComercialAuxiliar();
                        $auxiliar->auxiliar_id      = $euro_auxiliar;
                        $auxiliar->cantidad         = $request->euro_auxiliares_cantidad[$e];
                        $auxiliar->cantidad_inicial = $request->euro_auxiliares_inicial[$e];

                        $pedido->auxiliares()->save($auxiliar);
                    }
                }
            } else { // Es un palet Grande
                $pedido->formato_cantidad = $request->grand_cantidad;
                $pedido->formato_kilos    = $request->grand_kg;
                $pedido->cubre_id         = $request->grand_cubre_id;
                $pedido->cubre_cantidad   = $request->grand_cubre_cantidad;

                $pedido->save();

                if (count($request->grand_tarrinas_id) > 0) {
                    foreach ($request->grand_tarrinas_id as $e => $grand_tarrina) {
                        $tarrina                   = new PedidoComercialTarrina();
                        $tarrina->tarrina_id       = $grand_tarrina;
                        $tarrina->cantidad         = $request->grand_tarrinas_cantidad[$e];
                        $tarrina->cantidad_inicial = $request->grand_tarrinas_inicial[$e];

                        $pedido->tarrinas()->save($tarrina);
                    }
                }

                if (count($request->grand_auxiliares_id) > 0) {
                    foreach ($request->grand_auxiliares_id as $e => $grand_auxiliar) {
                        $auxiliar                   = new PedidoComercialAuxiliar();
                        $auxiliar->auxiliar_id      = $grand_auxiliar;
                        $auxiliar->cantidad         = $request->grand_auxiliares_cantidad[$e];
                        $auxiliar->cantidad_inicial = $request->grand_auxiliares_inicial[$e];

                        $pedido->auxiliares()->save($auxiliar);
                    }
                }
            }
        }

        return redirect()->route('pedidos-comercial.index')->with($data);
    }

    public function update(Request $request, $id)
    {
        $data   = array();
        $pedido = PedidoComercial::find($id);

        $pedido->cliente_id  = $request->cliente;
        $pedido->destino_id  = $request->destino_comercial;
        $pedido->cultivo_id  = $request->cultivo;
        $pedido->producto_id = $request->producto_compuesto;
        $pedido->pallet_id   = $request->formato_palet;
        $pedido->cantidad    = $request->cantidad;
        $pedido->etiqueta    = $request->etiqueta;
        $pedido->precio      = $request->precio;
        $pedido->kilos       = $request->kilos;
        $pedido->comentarios = $request->comentario;
        $pedido->estado_id   = $request->estado;
        $pedido->modelo_id   = $request->modelo_palet;

        $pedido->save();
        $data['anio_act']   = $request->anio;
        $data['semana_act'] = $request->semana;

        $pedido->tarrinas()->delete();
        $pedido->auxiliares()->delete();

        if ($request->modelo_palet == "1") { // Es un Europalet
            $pedido->formato_cantidad = $request->euro_cantidad;
            $pedido->formato_kilos    = $request->euro_kg;
            $pedido->cubre_id         = null;
            $pedido->cubre_cantidad   = null;

            $pedido->save();

            if (count($request->euro_tarrinas_id) > 0) {
                foreach ($request->euro_tarrinas_id as $e => $euro_tarrina) {
                    $tarrina                   = new PedidoComercialTarrina();
                    $tarrina->tarrina_id       = $request->euro_tarrina;
                    $tarrina->cantidad         = $request->euro_tarrinas_cantidad[$e];
                    $tarrina->cantidad_inicial = $request->euro_tarrinas_inicial[$e];

                    $pedido->tarrinas()->save($tarrina);
                }
            }

            if (count($request->euro_auxiliares_id) > 0) {
                foreach ($request->euro_auxiliares_id as $e => $euro_auxiliar) {
                    $auxiliar                   = new PedidoComercialAuxiliar();
                    $auxiliar->auxiliar_id      = $euro_auxiliar;
                    $auxiliar->cantidad         = $request->euro_auxiliares_cantidad[$e];
                    $auxiliar->cantidad_inicial = $request->euro_auxiliares_inicial[$e];

                    $pedido->auxiliares()->save($auxiliar);
                }
            }
        } else { // Es un palet Grande
            $pedido->formato_cantidad = $request->grand_cantidad;
            $pedido->formato_kilos    = $request->grand_kg;
            $pedido->cubre_id         = $request->grand_cubre_id;
            $pedido->cubre_cantidad   = $request->grand_cubre_cantidad;

            $pedido->save();

            if (count($request->grand_tarrinas_id) > 0) {
                foreach ($request->grand_tarrinas_id as $e => $grand_tarrina) {
                    $tarrina                   = new PedidoComercialTarrina();
                    $tarrina->tarrina_id       = $grand_tarrina;
                    $tarrina->cantidad         = $request->grand_tarrinas_cantidad[$e];
                    $tarrina->cantidad_inicial = $request->grand_tarrinas_inicial[$e];

                    $pedido->tarrinas()->save($tarrina);
                }
            }

            if (count($request->grand_auxiliares_id) > 0) {
                foreach ($request->grand_auxiliares_id as $e => $grand_auxiliar) {
                    $auxiliar                   = new PedidoComercialAuxiliar();
                    $auxiliar->auxiliar_id      = $grand_auxiliar;
                    $auxiliar->cantidad         = $request->grand_auxiliares_cantidad[$e];
                    $auxiliar->cantidad_inicial = $request->grand_auxiliares_inicial[$e];

                    $pedido->auxiliares()->save($auxiliar);
                }
            }
        }

        return redirect()->route('pedidos-comercial.index')->with($data);
    }

    public function ajaxGetDestinosComerciales(Request $request)
    {
        $id = $request->input('id');

        if (is_null($id)) return response()->json(null);

        $data           = array();
        $clienteDestino = ClienteDestinos::find($id);
        $pais           = $clienteDestino->pais;
        $data           = DB::table('pedidos_comerciales')->join('clientes_destinos', 'clientes_destinos.id', '=', 'pedidos_comerciales.destino_id')->join('clientes', 'clientes.id', '=', 'clientes_destinos.cliente_id')->where('clientes_destinos.pais', 'like', '%' . $pais . '%')->select('precio', 'kilos', 'clientes.razon_social as cliente', 'clientes_destinos.pais')->get();

        return response()->json($data);
    }

    public function ajaxGetDestinosComercialesForCliente(Request $request)
    {
        $id = $request->input('id');

        if (is_null($id)) return response()->json(null);

        $data = array();
        $data = ClienteDestinos::where('cliente_id', $id)->get();

        return response()->json($data);
    }

    public function ajaxLoadPaletsForCaja(Request $request)
    {
        $id             = $request->input('id');
        $cantidad_cajas = $request->input('cantidad');
        $tipo_palet     = $request->input('tipo_palet');

        if (is_null($id)) return response()->json(null);

        $data     = array();
        $variedad = ProductoCompuesto_det::with('tarrinas')->with('auxiliares')->find($id);

        if ($tipo_palet == 1) // si es un euro pallet
        {
            if ($variedad->euro_cantidad > 0) {
                $cantidad_palets = $cantidad_cajas / $variedad->euro_cantidad;
            } else {
                $cantidad_palets = 1;
            }
        } else { // si es un pallet grande
            if ($variedad->grand_cantidad > 0) {
                $cantidad_palets = $cantidad_cajas / $variedad->grand_cantidad;
            } else {
                $cantidad_palets = 1;
            }
        }

        $tarrinas   = ProductoCompuesto_tarrinas::with('tarrina')->where('det_id', $variedad->id)->get();
        $auxiliares = ProductoCompuesto_auxiliares::with('auxiliar')->where('det_id', $variedad->id)->get();
        $compuestos = array();

        foreach ($auxiliares as $auxiliar) {
            $sub['tipo']        = "Auxiliar";
            $sub['id']          = $auxiliar->auxiliar_id;
            $sub['cantidad']    = $auxiliar->cantidad;
            $sub['descripcion'] = $auxiliar->auxiliar->modelo;
            $compuestos[]       = $sub;
        }

        foreach ($tarrinas as $tarrina) {
            $sub['tipo']        = "Tarrina";
            $sub['id']          = $tarrina->tarrina_id;
            $sub['cantidad']    = $tarrina->cantidad;
            $sub['descripcion'] = $tarrina->tarrina->modelo;
            $compuestos[]       = $sub;
        }

        $data = array(
            'palets'     => $cantidad_palets,
            'compuestos' => $compuestos,
        );

        $view['html'] = view('comercial.pedidos-comercial.palets')->with($data)->render();

        return response()->json($view);
    }
}
