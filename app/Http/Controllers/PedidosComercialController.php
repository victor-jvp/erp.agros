<?php

namespace App\Http\Controllers;

use App\Auxiliar;
use App\CatDiasSemana;
use App\Cliente;
use App\ClienteDestinos;
use App\Contador;
use App\Cubre;
use App\Cultivo;
use App\Especiales;
use App\Inventario;
use App\Pallet;
use App\PalletModel;
use App\PedidoComercial;
use App\PedidoComercialAuxiliar;
use App\PedidoComercialCatCancelado;
use App\PedidoComercialEstado;
use App\PedidoComercialTarrina;
use App\PedidoProduccion;
use App\PedidoProduccionAuxiliar;
use App\PedidoProduccionPaletAuxiliar;
use App\PedidoProduccionTarrina;
use App\ProductoCompuesto_auxiliares;
use App\ProductoCompuesto_cab;
use App\ProductoCompuesto_det;
use App\ProductoCompuesto_tarrinas;
use App\Tarrina;
use App\Transporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder;

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
        $productos   = ProductoCompuesto_det::with('compuesto')->get();
        $palets      = Pallet::with('modelo')->get();
        $nro_orden   = Contador::Next_nro_pedido_comercial();
        $tarrinas    = Tarrina::all();
        $auxiliares  = Auxiliar::all();
        $cubres      = Cubre::all();
        $compuestos  = ProductoCompuesto_det::with('compuesto')->with('caja')->get();

        foreach ($cultivos as $c => $cultivo) {
            $pedidos = PedidoComercial::select(['pedidos_comerciales.*'])->with([
                'cliente',
                'destino',
                'palet.modelo',
                'transporte',
                'variable.compuesto',
            ])->WithCultivos($data['semana_act'], $data['anio_act'], $cultivo->id)->get();

            $cultivos[$c]->pedidos = $pedidos;
        }

        //dd($cultivos);

        $data['semana']             = CatDiasSemana::orderBy('order', 'ASC')->get();
        $especiales                 = Especiales::all()->first();
        $data['semana_ini']         = $especiales->semana_ini;
        $data['semana_fin']         = $especiales->semana_fin;
        $data['anio_ini']           = date('Y', strtotime($especiales->created_at));
        $data['anio_fin']           = Date('Y');
        $data["cultivos"]           = $cultivos;
        $data['clientes']           = $clientes;
        $data['transportes']        = $transportes;
        $data['estados']            = $estados;
        $data['productos']          = $productos;
        $data['palets']             = $palets;
        $data['tarrinas']           = $tarrinas;
        $data['auxiliares']         = $auxiliares;
        $data['cubres']             = $cubres;
        $data['nro_orden']          = date('dmY') . "-" . $nro_orden;
        $data['compuestos']         = $compuestos;
        $data['motivos_cancelados'] = PedidoComercialCatCancelado::all();

        return view("comercial.pedidos-comercial.index")->with($data);
    }

    public function details(Request $request)
    {
        $id = $request->input('id');

        if (is_null($id)) return response()->json(null);

        $data = PedidoComercial::with([
            'cliente',
            'destino',
            'palet.modelo',
            'transporte',
            'variable.compuesto',
            'variable.caja',
            'dia',
            'estado'
        ])->find($id);

        return response()->json($data);
    }

    public function delete(Request $request, $id)
    {
        if ($request->ajax()) {
            $id     = $request->get('id');
            $pedido = PedidoComercial::find($id);
            if (!is_null($pedido)) {
                $pedido->delete();
                return response()->json(true);
            }

            return response()->json(false);
        }

        $pedido = PedidoComercial::find($id);

        if (!is_null($pedido)) {
            $pedido->delete();
        }

        return redirect()->route('pedidos-comercial.index');
    }

    public function store(Request $request)
    {
        //dd($request);
        $data               = array();
        $data['anio_act']   = $request->anio;
        $data['semana_act'] = $request->semana;
        if (!isset($request->dia)) return redirect()->route('pedidos-comercial.index')->with($data);
        foreach ($request->dia as $i => $dia) {
            $pedido = new PedidoComercial();

            $pedido->nro_orden       = date('dmY') . "-" . Contador::Save_nro_pedido_comercial();
            $pedido->anio            = $request->anio;
            $pedido->semana          = $request->semana;
            $pedido->dia_id          = $dia;
            $pedido->cliente_id      = $request->cliente;
            $pedido->destino_id      = $request->destino[$i];
            $pedido->producto_id     = $request->compuesto[$i];
            $pedido->pallet_id       = $request->palet_model[$i];
            $pedido->pallet_cantidad = $request->palet_cantidad[$i];
            $pedido->cajas           = $request->cajas[$i];
            $pedido->precio          = $request->precio[$i];
            $pedido->kilos           = $request->kilos[$i];
            $pedido->etiqueta        = $request->etiqueta[$i];
            $pedido->transporte_id   = (isset($request->transporte[$i]) && $request->transporte[$i] != "") ? $request->transporte[$i] : NULL;
            $pedido->comentarios     = $request->comentario[$i];
            $pedido->estado_id       = 1;

            $pedido->save();

        }

        return redirect('comercial/pedidos-comercial?anio_act=' . $request->anio . '&semana_act=' . $request->semana);
    }

    public function update(Request $request, $id)
    {
        $pedido = PedidoComercial::find($id);

        $pedido->cliente_id      = $request->cliente_id;
        $pedido->producto_id     = $request->producto_id;
        $pedido->cajas           = $request->cajas;
        $pedido->kilos           = $request->kilos;
        $pedido->precio          = $request->precio;
        $pedido->pallet_id       = $request->palet_id;
        $pedido->pallet_cantidad = $request->palet_cantidad;
        $pedido->destino_id      = $request->destino;
        $pedido->transporte_id   = (isset($request->transporte_id) && $request->transporte_id != "") ? $request->transporte_id : NULL;
        $pedido->etiqueta        = $request->etiqueta;
        $pedido->comentarios     = $request->comentario;
        $pedido->estado_id       = $request->estado_id;

        $pedido->save();

        if ($pedido->estado_id == 2) {
            $pedido_p = new PedidoProduccion();

            $pedido_p->comercial_id    = $pedido->id;
            $pedido_p->nro_orden       = date('dmY') . "-" . Contador::Save_nro_pedido_produccion();
            $pedido_p->anio            = $pedido->anio;
            $pedido_p->semana          = $pedido->semana;
            $pedido_p->dia_id          = $pedido->dia_id;
            $pedido_p->cliente_id      = $pedido->cliente_id;
            $pedido_p->producto_id     = $pedido->producto_id;
            $pedido_p->cajas           = $pedido->cajas;
            $pedido_p->kilos           = $pedido->kilos;
            $pedido_p->pallet_id       = $pedido->pallet_id;
            $pedido_p->pallet_cantidad = $pedido->pallet_cantidad;
            $pedido_p->destino_id      = $pedido->destino_id;
            $pedido_p->transporte_id   = $pedido->transporte_id;
            $pedido_p->etiqueta        = $pedido->etiqueta;
            $pedido_p->comentarios     = $pedido->comentario;
            $pedido_p->estado_id       = 1;

            $pedido_p->save();

            $producto = ProductoCompuesto_det::with([
                'tarrinas.tarrina',
                'auxiliares.auxiliar',
                'palets_auxiliares.auxiliar'
            ])->find($pedido_p->producto_id);

            if (!is_null($producto)) {
                if (!is_null($producto->tarrinas())) {
                    foreach ($producto->tarrinas as $tarrina) {
                        $new_tarrina = new PedidoProduccionTarrina();

                        $new_tarrina->tarrina_id       = $tarrina->tarrina_id;
                        $new_tarrina->cantidad         = $tarrina->cantidad;
                        $new_tarrina->cantidad_inicial = $tarrina->cantidad;
                        $pedido_p->tarrinas()->save($new_tarrina);
                    }
                }
                if (!is_null($producto->auxiliares())) {

                    foreach ($producto->auxiliares as $auxiliar) {
                        $new_auxiliar = new PedidoProduccionAuxiliar();

                        $new_auxiliar->auxiliar_id      = $auxiliar->auxiliar_id;
                        $new_auxiliar->cantidad         = $auxiliar->cantidad;
                        $new_auxiliar->cantidad_inicial = $auxiliar->cantidad;
                        $pedido_p->auxiliares()->save($new_auxiliar);
                    }
                }
                if (!is_null($producto->palets_auxiliares())) {
                    foreach ($producto->palets_auxiliares as $auxiliar) {

                        if ($auxiliar->palet_model_id == $pedido_p->palet->modelo_id){
                            $new_auxiliar = new PedidoProduccionPaletAuxiliar();

                            $new_auxiliar->auxiliar_id      = $auxiliar->auxiliar_id;
                            $new_auxiliar->cantidad         = $auxiliar->cantidad;
                            $new_auxiliar->cantidad_inicial = $auxiliar->cantidad;
                            $pedido_p->palet_auxiliares()->save($new_auxiliar);
                        }
                    }
                }

                return redirect('comercial/pedidos-comercial?anio_act=' . $request->anio . '&semana_act=' . $request->semana);
            }
        }

        if ($pedido->estado_id == 3) {

            $pedido->cancelado_id     = $request->cancelado_id;
            $pedido->cancelado_coment = $request->cancelado_coment;

            $pedido->save();
        }

        return redirect('comercial/pedidos-comercial?anio_act=' . $request->anio . '&semana_act=' . $request->semana);
    }

    public function ajaxGetDestinosComerciales(Request $request)
    {
        $id = $request->input('id');

        if (is_null($id)) return response()->json(null);

        $data           = array();
        $clienteDestino = ClienteDestinos::find($id);
        if (!is_null($clienteDestino)) {
            $data = DB::table('pedidos_comerciales')->join('clientes_destinos', 'clientes_destinos.id', '=', 'pedidos_comerciales.destino_id')->join('clientes', 'clientes.id', '=', 'clientes_destinos.cliente_id')->where('clientes_destinos.pais', 'like', '%' . $clienteDestino->pais . '%')->select('precio', 'kilos', 'clientes.razon_social as cliente', 'clientes_destinos.pais')->get();
        } else {
            $data = null;
        }

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

    public function ajaxCheckStock(Request $request)
    {
        $id       = $request->input('id');
        $cantidad = $request->input('cantidad');
        $kilos    = $request->input('kilos');

        $data['data'] = array();
        if (is_null($id)) return response()->json($data);

        $resultado = null;
        $producto  = ProductoCompuesto_det::with([
            'tarrinas.tarrina',
            'auxiliares.auxiliar',
            'palets_auxiliares.auxiliar'
        ])->find($id);
        if (is_null($producto)) return response()->json($data);

        $pedido    = PedidoProduccion::with([
            'tarrinas.tarrina',
            'auxiliares.auxiliar',
            'palet_auxiliares.auxiliar',
            'palet.modelo',
            'variable.caja'
        ])->find($id);
        if (is_null($pedido)) return response()->json($data);

        $resultado = true;

        //Agregar disponibilidad de PALET.
        $stock = DB::table('inventario')
                   ->where('categoria', '=', 'Palet')
                   ->where('categoria_id', $producto ->pallet_id)
                   ->sum(DB::raw('cantidad * cnv_fact'));
        $row['categoria']   = "Palet";
        $row['descripcion'] = $pedido->palet->modelo->modelo.' - '.$pedido->palet->formato;
        $row['id']          = null;
        $row['item_id']     = $pedido->pallet_id;
        $row['default']     = null;
        $row['disponible']  = $stock;
        $row['necesarios']  = $pedido->pallet_cantidad;
        $row['restantes']   = $row['disponible'] - $row['necesarios'];

        if ($row['restantes'] < 0 && $resultado == true) {
            $resultado = false;
        }
        $row['resultado'] = $resultado;
        $data['data'][]   = $row;

        //Agregar disponibilidad de CAJA.
        $stock = DB::table('inventario')
                   ->where('categoria', '=', 'Caja')
                   ->where('categoria_id', $pedido->variable->caja_id)
                   ->sum(DB::raw('cantidad * cnv_fact'));
        $row['categoria']   = "Caja";
        $row['descripcion'] = $pedido->variable->caja->formato . " - " . $pedido->variable->caja->modelo;
        $row['id']          = null;
        $row['item_id']     = $pedido->variable->caja_id;
        $row['default']     = null;
        $row['disponible']  = $stock;
        $row['necesarios']  = $pedido->cajas;
        $row['restantes']   = $row['disponible'] - $row['necesarios'];

        if ($row['restantes'] < 0 && $resultado == true) {
            $resultado = false;
        }
        $row['resultado'] = $resultado;
        $data['data'][]   = $row;

        if (count($producto->auxiliares) > 0) {
            foreach ($producto->auxiliares as $a => $auxiliar) {
                $stock = DB::table('inventario')->where('categoria', '=', 'Auxiliar')->where('categoria_id', $auxiliar->auxiliar->id)->sum(DB::raw('cantidad * cnv_fact'));

                $row['categoria']   = "Auxiliar";
                $row['descripcion'] = $auxiliar->auxiliar->modelo;
                $row['id']          = $auxiliar->auxiliar->id;
                $row['default']     = $auxiliar->cantidad;
                $row['disponible']  = $stock;
                $row['necesarios']  = $auxiliar->cantidad * $cantidad;
                $row['restantes']   = $row['disponible'] - $row['necesarios'];

                if ($row['restantes'] < 0 && $resultado == true) {
                    $resultado = false;
                }
                $row['resultado'] = $resultado;
                $data['data'][]   = $row;
            }
        }

        if (count($producto->tarrinas) > 0) {
            foreach ($producto->tarrinas as $a => $tarrina) {
                $stock = DB::table('inventario')->where('categoria', '=', 'Tarrina')->where('categoria_id', $tarrina->tarrina->id)->sum(DB::raw('cantidad * cnv_fact'));

                $row['descripcion'] = $tarrina->tarrina->modelo;
                $row['categoria']   = "Tarrina";
                $row['id']          = $tarrina->tarrina->id;
                $row['default']     = $tarrina->cantidad;
                $row['disponible']  = $stock;
                $row['necesarios']  = $tarrina->cantidad * $cantidad;
                $row['restantes']   = $row['disponible'] - $row['necesarios'];

                if ($row['restantes'] < 0 && $resultado == true) {
                    $resultado = false;
                }
                $row['resultado'] = $resultado;
                $data['data'][]   = $row;
            }
        }

        if (count($producto->palets_auxiliares) > 0) {
            foreach ($producto->palets_auxiliares as $a => $auxiliar) {
                if($auxiliar->palet_model_id == $pedido->palet->modelo_id){
                    $stock = DB::table('inventario')->where('categoria', '=', 'Auxiliar')->where('categoria_id', $auxiliar->auxiliar->id)->sum(DB::raw('cantidad * cnv_fact'));

                    $row['descripcion'] = $auxiliar->auxiliar->modelo;
                    $row['categoria']   = "Auxiliar Palet";
                    $row['id']          = $auxiliar->auxiliar->id;
                    $row['default']     = $auxiliar->cantidad;
                    $row['disponible']  = $stock;
                    $row['necesarios']  = $auxiliar->cantidad * $cantidad;
                    $row['restantes']   = $row['disponible'] - $row['necesarios'];

                    if ($row['restantes'] < 0 && $resultado == true) {
                        $resultado = false;
                    }
                    $row['resultado'] = $resultado;
                    $data['data'][]   = $row;
                }
            }
        }
        $data['result'] = $resultado;
        //$data['producto'] = $producto;

        return response()->json($data);
    }
}
