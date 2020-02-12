<?php

namespace App\Http\Controllers;

use App\Auxiliar;
use App\CatDiasSemana;
use App\Cliente;
use App\ClienteDestinos;
use App\Contador;
use App\Cubre;
use App\Cultivo;
use App\DatosFiscales;
use App\Especiales;
use App\Inventario;
use App\InventarioRel;
use App\Pallet;
use App\PedidoProduccion;
use App\PedidoProduccionAuxiliar;
use App\PedidoProduccionCoste;
use App\PedidoProduccionEstado;
use App\PedidoProduccionPaletAuxiliar;
use App\PedidoProduccionTarrina;
use App\ProductoCompuesto_auxiliares;
use App\ProductoCompuesto_det;
use App\ProductoCompuesto_tarrinas;
use App\Tarrina;
use App\Transporte;
use Barryvdh\DomPDF\PDF;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidosProduccionController extends Controller
{
    //
    public function index(Request $request)
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Almacen | Acceso') || !Auth::user()->can('Almacen - Pedidos Producción | Acceso')) {
            return redirect()->route('home');
        }

        if (!is_null($request->semana_act)) {
            $data['semana_act'] = intval($request->semana_act);
        }
        else {
            $data['semana_act'] = intval(date("W"));
        }

        if (!is_null($request->anio_act)) {
            $data['anio_act'] = intval($request->anio_act);
        }
        else {
            $data['anio_act'] = intval(date("Y"));
        }

        $cultivos    = Cultivo::all();
        $clientes    = Cliente::all();
        $transportes = Transporte::all();
        $estados     = PedidoProduccionEstado::all();
        $productos   = ProductoCompuesto_det::with('compuesto')->get();
        $palets      = Pallet::with('modelo')->get();
        $nro_orden   = Contador::Next_nro_pedido_comercial();
        $tarrinas    = Tarrina::all();
        $auxiliares  = Auxiliar::all();
        $cubres      = Cubre::all();
        $compuestos  = ProductoCompuesto_det::with('compuesto')->with('caja')->get();

        $iniciados = PedidoProduccion::where('estado_id', "=", 2)->with([
            'cliente',
            'variable.compuesto',
            'estado'
        ])->get();

        foreach ($cultivos as $c => $cultivo) {
            $pedidos = PedidoProduccion::select(['pedidos_produccion.*'])->with([
                'cliente',
                'destino',
                'palet.modelo',
                'transporte',
                'variable.compuesto',
            ])->WithCultivos($data['semana_act'], $data['anio_act'], $cultivo->id)->get();

            $cultivos[$c]->pedidos = $pedidos;
        }

        //dd($cultivos);

        $data['semana']      = CatDiasSemana::orderBy('order', 'ASC')->get();
        $especiales          = Especiales::all()->first();
        $data['semana_ini']  = $especiales->semana_ini;
        $data['semana_fin']  = $especiales->semana_fin;
        $data['anio_ini']    = date('Y', strtotime($especiales->created_at));
        $data['anio_fin']    = Date('Y');
        $data["cultivos"]    = $cultivos;
        $data['clientes']    = $clientes;
        $data['transportes'] = $transportes;
        $data['estados']     = $estados;
        $data['productos']   = $productos;
        $data['palets']      = $palets;
        $data['tarrinas']    = $tarrinas;
        $data['auxiliares']  = $auxiliares;
        $data['cubres']      = $cubres;
        $data['nro_orden']   = date('dmY') . "-" . $nro_orden;
        $data['compuestos']  = $compuestos;
        $data['iniciados']   = $iniciados;

        return view("almacen.pedidos-produccion.index")->with($data);
    }

    public function details(Request $request)
    {
        $id = $request->input('id');

        if (is_null($id)) return response()->json(null);

        $data = PedidoProduccion::with([
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

    public function delete($id)
    {
        $pedido = PedidoProduccion::find($id);

        if (!is_null($pedido)) {
            $pedido->delete();
        }

        return redirect()->route('pedidos-produccion.index');
    }

    public function store(Request $request)
    {
        //dd($request);
        $data               = array();
        $data['anio_act']   = $request->anio;
        $data['semana_act'] = $request->semana;
        if (!isset($request->dia)) return redirect()->route('pedidos-produccion.index')->with($data);

        foreach ($request->dia as $i => $dia) {
            $pedido = new PedidoProduccion();

            $pedido->nro_orden       = date('dmY') . "-" . Contador::Save_nro_pedido_produccion();
            $pedido->anio            = $request->anio;
            $pedido->semana          = $request->semana;
            $pedido->dia_id          = $dia;
            $pedido->cliente_id      = $request->cliente;
            $pedido->destino_id      = $request->destino[$i];
            $pedido->producto_id     = $request->compuesto[$i];
            $pedido->pallet_id       = $request->palet_model[$i];
            $pedido->pallet_cantidad = $request->palet_cantidad[$i];
            $pedido->cajas           = $request->cajas[$i];
            $pedido->kilos           = $request->kilos[$i];
            $pedido->etiqueta        = (isset($request->etiqueta[$i])) ? $request->etiqueta[$i] : "";
            $pedido->transporte_id   = (isset($request->transporte[$i])) ? $request->transporte[$i] : "";
            $pedido->comentarios     = (isset($request->comentario[$i])) ? $request->comentario[$i] : "";
            $pedido->estado_id       = 1;

            $pedido->save();

            $producto = ProductoCompuesto_det::with([
                'tarrinas.tarrina',
                'auxiliares.auxiliar',
                'palets_auxiliares.auxiliar'
            ])->find($pedido->producto_id);

            if (!is_null($producto)) {
                if (!is_null($producto->tarrinas())) {
                    foreach ($producto->tarrinas as $tarrina) {
                        $new_tarrina = new PedidoProduccionTarrina();

                        $new_tarrina->tarrina_id       = $tarrina->tarrina_id;
                        $new_tarrina->cantidad         = $tarrina->cantidad;
                        $new_tarrina->cantidad_inicial = $tarrina->cantidad;
                        $pedido->tarrinas()->save($new_tarrina);
                    }
                }
                if (!is_null($producto->auxiliares())) {

                    foreach ($producto->auxiliares as $auxiliar) {
                        $new_auxiliar = new PedidoProduccionAuxiliar();

                        $new_auxiliar->auxiliar_id      = $auxiliar->auxiliar_id;
                        $new_auxiliar->cantidad         = $auxiliar->cantidad;
                        $new_auxiliar->cantidad_inicial = $auxiliar->cantidad;
                        $pedido->auxiliares()->save($new_auxiliar);
                    }
                }
                if (!is_null($producto->palets_auxiliares())) {
                    foreach ($producto->palets_auxiliares as $auxiliar) {
                        $new_auxiliar = new PedidoProduccionPaletAuxiliar();

                        $new_auxiliar->auxiliar_id      = $auxiliar->auxiliar_id;
                        $new_auxiliar->cantidad         = $auxiliar->cantidad;
                        $new_auxiliar->cantidad_inicial = $auxiliar->cantidad;
                        $pedido->palet_auxiliares()->save($new_auxiliar);
                    }
                }
            }
        }

        return redirect('almacen/pedidos-produccion?anio_act=' . $request->anio . '&semana_act=' . $request->semana);
    }

    public function update(Request $request, $id)
    {
        // dd($request);

        DB::beginTransaction();
        try {
            $pedido = PedidoProduccion::find($id);

            $pedido->cliente_id      = $request->cliente_id;
            $pedido->producto_id     = $request->producto_id;
            $pedido->cajas           = $request->cajas;
            $pedido->kilos           = $request->kilos;
            $pedido->pallet_id       = $request->palet_id;
            $pedido->pallet_cantidad = $request->palet_cantidad;
            $pedido->destino_id      = ($request->destino == "") ? null : $request->destino;
            $pedido->transporte_id   = ($request->transporte_id == "") ? null : $request->transporte_id;
            $pedido->etiqueta        = $request->etiqueta;
            $pedido->comentarios     = $request->comentario;
            $pedido->estado_id       = $request->estado_id;

            $pedido->save();

            if ($pedido->estado_id == 3) { // Si el Pedido es Finalizado, procesar inventario.
                $this->StoreInventario($id);
                $this->StoreCoste($id);
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            //$data['error'] = $ex->getMessage();
            $request->session()->flash('error', $ex->getMessage());
        }

        return redirect('almacen/pedidos-produccion?anio_act=' . $request->anio . '&semana_act=' . $request->semana);
    }

    private function StoreInventario($id = null)
    {
        $pedido = PedidoProduccion::with([
            'tarrinas',
            'auxiliares',
            'palet_auxiliares',
            'variable',
        ])->find($id);

        //dd($pedido);

        if (is_null($pedido)) return null;

        // Salida de Cajas
        if (!is_null($pedido->cajas) && $pedido->producto_id > 0) {

            $salida               = new Inventario();
            $salida->tipo_mov     = 'S';
            $salida->fecha        = date('Y-m-d H:i:s');
            $salida->nro_lote     = Contador::save_nro_salida();
            $salida->categoria    = 'Caja';
            $salida->categoria_id = $pedido->variable->caja_id;
            $salida->cnv_fact     = -1;
            $salida->cantidad     = $pedido->cajas;
            $salida->save();

            $isCompleted = false;

            $porSalir = $salida->cantidad;

            // Validar si existe alguna entrada de Caja
            $hasEntries = Inventario::where('categoria', '=', 'Caja')
                                   ->where('tipo_mov', '=', 'E')
                                   ->where('isDisp', '=', true)
                                   ->where('categoria_id', $pedido->variable->caja_id)
                                   ->count();

            if ($hasEntries > 0)
            {
                do {
                    $entrada = Inventario::where('categoria', '=', 'Caja')
                                         ->where('tipo_mov', '=', 'E')
                                         ->where('isDisp', '=', true)
                                         ->where('categoria_id', $pedido->variable->caja_id)
                                         ->orderBy('id', 'asc')->first();

                    if (is_null($entrada)) {
                        $isCompleted = true;
                        break;
                    }

                    $entradasRel = InventarioRel::where('entrada_id', $entrada->id)->sum('cantidad');

                    $dispEntrada = $entrada->cantidad - $entradasRel;

                    if ($dispEntrada > 0) {

                        if ($dispEntrada >= $porSalir) {
                            $isCompleted = true;
                        }
                        else {
                            $porSalir = $porSalir - $dispEntrada;
                        }

                        $rel             = new InventarioRel();
                        $rel->entrada_id = $entrada->id;
                        $rel->salida_id  = $salida->id;
                        $rel->pedido_id  = $pedido->id;
                        $rel->cantidad   = $porSalir;
                        $rel->save();
                    }

                    if ($entrada->cantidad <= $entradasRel) {
                        $entrada->isDisp = false;
                        $entrada->save();
                    }

                } while (!$isCompleted);
            }
            else{
                $rel             = new InventarioRel();
                $rel->entrada_id = null;
                $rel->salida_id  = $salida->id;
                $rel->pedido_id  = $pedido->id;
                $rel->cantidad   = $porSalir;
                $rel->save();
            }
        }

        /* Salida de Palets */
        if (!is_null($pedido->pallet_cantidad) && $pedido->pallet_cantidad > 0) {
            $salida               = new Inventario();
            $salida->tipo_mov     = 'S';
            $salida->fecha        = date('Y-m-d H:i:s');
            $salida->nro_lote     = Contador::save_nro_salida();
            $salida->categoria    = 'Palet';
            $salida->categoria_id = $pedido->pallet_id;
            $salida->cnv_fact     = -1;
            $salida->cantidad     = $pedido->pallet_cantidad;
            $salida->save();

            $isCompleted = false;

            $porSalir = $salida->cantidad;

            // Validar si existe alguna entrada
            $hasEntries = Inventario::where('categoria', '=', 'Palet')
                                 ->where('tipo_mov', '=', 'E')
                                 ->where('isDisp', '=', true)
                                 ->where('categoria_id', $pedido->pallet_id)
                                 ->count();

            if ($hasEntries > 0) {

                do {
                    $entrada = Inventario::where('categoria', '=', 'Palet')
                                         ->where('tipo_mov', '=', 'E')
                                         ->where('isDisp', '=', true)
                                         ->where('categoria_id', $pedido->pallet_id)
                                         ->orderBy('id', 'asc')
                                         ->first();

                    if (is_null($entrada)) {
                        $isCompleted = true;
                        break;
                    }

                    $entradasRel = InventarioRel::where('entrada_id', $entrada->id)->sum('cantidad');

                    $dispEntrada = $entrada->cantidad - $entradasRel;

                    if ($dispEntrada > 0) {

                        if ($dispEntrada >= $porSalir) {
                            $isCompleted = true;
                        }
                        else {
                            $porSalir = $porSalir - $dispEntrada;
                        }

                        $rel             = new InventarioRel();
                        $rel->entrada_id = $entrada->id;
                        $rel->salida_id  = $salida->id;
                        $rel->pedido_id  = $pedido->id;
                        $rel->cantidad   = $porSalir;
                        $rel->save();
                    }

                    if ($entrada->cantidad <= $entradasRel) {
                        $entrada->isDisp = false;
                        $entrada->save();
                    }

                } while (!$isCompleted);
            }
            else{
                $rel             = new InventarioRel();
                $rel->entrada_id = null;
                $rel->salida_id  = $salida->id;
                $rel->pedido_id  = $pedido->id;
                $rel->cantidad   = $porSalir;
                $rel->save();
            }
        }

        /* Salida de materiales del producto compuesto */
        if (count($pedido->tarrinas) > 0) {
            foreach ($pedido->tarrinas as $tarrina) {
                $salida = new Inventario();

                $salida->tipo_mov     = 'S';
                $salida->fecha        = date('Y-m-d H:i:s');
                $salida->nro_lote     = Contador::save_nro_salida();
                $salida->categoria    = 'Tarrina';
                $salida->categoria_id = $tarrina->tarrina_id;
                $salida->cnv_fact     = -1;
                $salida->cantidad     = $pedido->cajas * $tarrina->cantidad;

                $salida->save();

                $isCompleted = false;

                $porSalir = $salida->cantidad;

                $hasEntries = Inventario::where('categoria', '=', 'Tarrina')
                                        ->where('tipo_mov', '=', 'E')
                                        ->where('isDisp', '=', true)
                                        ->where('categoria_id', $tarrina->tarrina_id)
                                        ->count();

                if ($hasEntries > 0)
                {
                    do {
                        $entrada = Inventario::where('categoria', '=', 'Tarrina')->where('tipo_mov', '=', 'E')->where('isDisp', '=', true)->where('categoria_id', $tarrina->tarrina_id)->orderBy('id', 'asc')->first();

                        if (is_null($entrada)) {
                            $isCompleted = true;
                            break;
                        }

                        $entradasRel = InventarioRel::where('entrada_id', $entrada->id)->sum('cantidad');

                        $dispEntrada = $entrada->cantidad - $entradasRel;

                        if ($dispEntrada > 0) {

                            if ($dispEntrada >= $porSalir) {
                                $isCompleted = true;
                            }
                            else {
                                $porSalir = $porSalir - $dispEntrada;
                            }

                            $rel             = new InventarioRel();
                            $rel->entrada_id = $entrada->id;
                            $rel->salida_id  = $salida->id;
                            $rel->pedido_id  = $pedido->id;
                            $rel->cantidad   = $porSalir;
                            $rel->save();
                        }

                        if ($entrada->cantidad <= $entradasRel) {
                            $entrada->isDisp = false;
                            $entrada->save();
                        }

                    } while (!$isCompleted);
                }else{
                    $rel             = new InventarioRel();
                    $rel->entrada_id = null;
                    $rel->salida_id  = $salida->id;
                    $rel->pedido_id  = $pedido->id;
                    $rel->cantidad   = $porSalir;
                    $rel->save();
                }
            }
        }
        if (count($pedido->auxiliares) > 0) {
            foreach ($pedido->auxiliares as $auxiliar) {
                $salida = new Inventario();

                $salida->tipo_mov     = 'S';
                $salida->fecha        = date('Y-m-d H:i:s');
                $salida->nro_lote     = Contador::save_nro_salida();
                $salida->categoria    = 'Auxiliar';
                $salida->categoria_id = $auxiliar->auxiliar_id;
                $salida->cnv_fact     = -1;
                $salida->cantidad     = $pedido->cajas * $auxiliar->cantidad;

                $salida->save();

                $isCompleted = false;

                $porSalir = $salida->cantidad;

                $hasEntries = Inventario::where('categoria', '=', 'Auxiliar')
                                        ->where('tipo_mov', '=', 'E')
                                        ->where('isDisp', '=', true)
                                        ->where('categoria_id', $auxiliar->auxiliar_id)
                                        ->count();

                if ($hasEntries > 0)
                {
                    do {
                        $entrada = Inventario::where('categoria', '=', 'Auxiliar')->where('tipo_mov', '=', 'E')->where('isDisp', '=', true)->where('categoria_id', $auxiliar->auxiliar_id)->orderBy('id', 'asc')->first();

                        if (is_null($entrada)) {
                            $isCompleted = true;
                            break;
                        }

                        $entradasRel = InventarioRel::where('entrada_id', $entrada->id)->sum('cantidad');

                        $dispEntrada = $entrada->cantidad - $entradasRel;

                        if ($dispEntrada > 0) {

                            if ($dispEntrada >= $porSalir) {
                                $isCompleted = true;
                            }
                            else {
                                $porSalir = $porSalir - $dispEntrada;
                            }

                            $rel             = new InventarioRel();
                            $rel->entrada_id = $entrada->id;
                            $rel->salida_id  = $salida->id;
                            $rel->pedido_id  = $pedido->id;
                            $rel->cantidad   = $porSalir;
                            $rel->save();
                        }

                        if ($entrada->cantidad <= $entradasRel) {
                            $entrada->isDisp = false;
                            $entrada->save();
                        }

                    } while (!$isCompleted);
                }
                else{
                    $rel             = new InventarioRel();
                    $rel->entrada_id = null;
                    $rel->salida_id  = $salida->id;
                    $rel->pedido_id  = $pedido->id;
                    $rel->cantidad   = $porSalir;
                    $rel->save();
                }

            }
        }
        if (count($pedido->palet_auxiliares) > 0) {
            foreach ($pedido->palet_auxiliares as $auxiliar) {
                $salida = new Inventario();

                $salida->tipo_mov     = 'S';
                $salida->fecha        = date('Y-m-d H:i:s');
                $salida->nro_lote     = Contador::save_nro_salida();
                $salida->categoria    = 'Auxiliar';
                $salida->categoria_id = $auxiliar->auxiliar_id;
                $salida->cnv_fact     = -1;
                $salida->cantidad     = $pedido->pallet_cantidad * $auxiliar->cantidad;

                $salida->save();

                $isCompleted = false;

                $porSalir = $salida->cantidad;

                $hasEntries = Inventario::where('categoria', '=', 'Auxiliar')
                                        ->where('tipo_mov', '=', 'E')
                                        ->where('isDisp', '=', true)
                                        ->where('categoria_id', $auxiliar->auxiliar_id)
                                        ->count();

                if($hasEntries > 0)
                {
                    do {
                        $entrada = Inventario::where('categoria', '=', 'Auxiliar')->where('tipo_mov', '=', 'E')->where('isDisp', '=', true)->where('categoria_id', $auxiliar->auxiliar_id)->orderBy('id', 'asc')->first();

                        if (is_null($entrada)) {
                            $isCompleted = true;
                            break;
                        }

                        $entradasRel = InventarioRel::where('entrada_id', $entrada->id)->sum('cantidad');

                        $dispEntrada = $entrada->cantidad - $entradasRel;

                        if ($dispEntrada > 0) {

                            if ($dispEntrada >= $porSalir) {
                                $isCompleted = true;
                            }
                            else {
                                $porSalir = $porSalir - $dispEntrada;
                            }

                            $rel             = new InventarioRel();
                            $rel->entrada_id = $entrada->id;
                            $rel->salida_id  = $salida->id;
                            $rel->pedido_id  = $pedido->id;
                            $rel->cantidad   = $porSalir;
                            $rel->save();
                        }

                        if ($entrada->cantidad <= $entradasRel) {
                            $entrada->isDisp = false;
                            $entrada->save();
                        }

                    } while (!$isCompleted);
                }else{
                    $rel             = new InventarioRel();
                    $rel->entrada_id = null;
                    $rel->salida_id  = $salida->id;
                    $rel->pedido_id  = $pedido->id;
                    $rel->cantidad   = $porSalir;
                    $rel->save();
                }
            }
        }
    }

    private function StoreCoste($id = null)
    {
        if (is_null($id)) return null;

        $coste = new PedidoProduccionCoste();

        $coste->pedido_id = $id;
        $coste->save();
    }

    public function ajaxCheckStock(Request $request)
    {
        $id = $request->input('id');

        $data['data'] = array();
        if (is_null($id)) return response()->json($data);

        $resultado = null;

        $pedido    = PedidoProduccion::with([
            'tarrinas.tarrina',
            'auxiliares.auxiliar',
            'palet_auxiliares.auxiliar',
            'palet.modelo',
            'variable.caja'
        ])->find($id);
        if (is_null($pedido)) return response()->json($data);

        $producto = ProductoCompuesto_det::with([
            'tarrinas.tarrina',
            'auxiliares.auxiliar',
            'palets_auxiliares.auxiliar'
        ])->find($pedido->producto_id);

        $data['tarrinas']   = Tarrina::all();
        $data['auxiliares'] = Auxiliar::all();
        $resultado          = true;

        //Agregar disponibilidad de PALET.
        $stock = DB::table('inventario')->where('categoria', '=', 'Palet')->where('categoria_id', $pedido->pallet_id)->sum(DB::raw('cantidad * cnv_fact'));
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
        $stock = DB::table('inventario')->where('categoria', '=', 'Caja')->where('categoria_id', $pedido->variable->caja_id)->sum(DB::raw('cantidad * cnv_fact'));
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

        if (count($pedido->auxiliares) > 0) {
            foreach ($pedido->auxiliares as $a => $auxiliar) {
                $stock = DB::table('inventario')->where('categoria', '=', 'Auxiliar')->where('categoria_id', $auxiliar->auxiliar->id)->sum(DB::raw('cantidad * cnv_fact'));

                $row['categoria']   = "Auxiliar";
                $row['descripcion'] = $auxiliar->auxiliar->modelo;
                $row['id']          = $auxiliar->id;
                $row['item_id']     = $auxiliar->auxiliar_id;
                $row['default']     = $auxiliar->cantidad_inicial;
                $row['disponible']  = $stock;
                $row['necesarios']  = $auxiliar->cantidad;
                $row['restantes']   = $row['disponible'] - $row['necesarios'];

                if ($row['restantes'] < 0 && $resultado == true) {
                    $resultado = false;
                }
                $row['resultado'] = $resultado;
                $data['data'][]   = $row;
            }
        }

        if (count($pedido->tarrinas) > 0) {
            foreach ($pedido->tarrinas as $a => $tarrina) {
                $stock = DB::table('inventario')->where('categoria', '=', 'Tarrina')->where('categoria_id', $tarrina->tarrina->id)->sum(DB::raw('cantidad * cnv_fact'));

                $row['descripcion'] = $tarrina->tarrina->modelo;
                $row['categoria']   = "Tarrina";
                $row['id']          = $tarrina->id;
                $row['item_id']     = $tarrina->tarrina_id;
                $row['default']     = $tarrina->cantidad_inicial;
                $row['disponible']  = $stock;
                $row['necesarios']  = $tarrina->cantidad;
                $row['restantes']   = $row['disponible'] - $row['necesarios'];

                if ($row['restantes'] < 0 && $resultado == true) {
                    $resultado = false;
                }
                $row['resultado'] = $resultado;
                $data['data'][]   = $row;
            }
        }

        if (count($pedido->palet_auxiliares) > 0) {
            foreach ($pedido->palet_auxiliares as $a => $auxiliar) {
                $stock = DB::table('inventario')->where('categoria', '=', 'Auxiliar')->where('categoria_id', $auxiliar->auxiliar->id)->sum(DB::raw('cantidad * cnv_fact'));

                $row['descripcion'] = $auxiliar->auxiliar->modelo;
                $row['categoria']   = "Auxiliar Palet";
                $row['id']          = $auxiliar->id;
                $row['item_id']     = $auxiliar->auxiliar_id;
                $row['default']     = $auxiliar->cantidad_inicial;
                $row['disponible']  = $stock;
                $row['necesarios']  = $auxiliar->cantidad;
                $row['restantes']   = $row['disponible'] - $row['necesarios'];

                if ($row['restantes'] < 0 && $resultado == true) {
                    $resultado = false;
                }
                $row['resultado'] = $resultado;
                $data['data'][]   = $row;
            }
        }

        $data['result'] = $resultado;

        return response()->json($data);
    }

    public function ajaxSaveStock(Request $request)
    {
        $data = array();

        $id         = $request->pedido_id;
        $tipos      = $request->tipo;
        $parte      = $request->parte;
        $cantidades = $request->cantidad;
        $inicial    = $request->inicial;

        $pedido = PedidoProduccion::with([
            'auxiliares',
            'palet_auxiliares',
            'tarrinas'
        ])->find($id);

        if (is_null($pedido)) return response()->json($data);

        try {
            DB::beginTransaction();

            $pedido->auxiliares()->delete();
            $pedido->tarrinas()->delete();
            $pedido->palet_auxiliares()->delete();

            for ($i = 0; $i < count($tipos); $i++) {
                if (strtolower($tipos[$i]) == "tarrina") {
                    $detalle                   = new PedidoProduccionTarrina();
                    $detalle->pedido_id        = $id;
                    $detalle->tarrina_id       = $parte[$i];
                    $detalle->cantidad         = $cantidades[$i];
                    $detalle->cantidad_inicial = $inicial[$i];
                    $detalle->save();
                }
                elseif (strtolower($tipos[$i]) == "auxiliar") {
                    $detalle                   = new PedidoProduccionPaletAuxiliar();
                    $detalle->pedido_id        = $id;
                    $detalle->auxiliar_id      = $parte[$i];
                    $detalle->cantidad         = $cantidades[$i];
                    $detalle->cantidad_inicial = $inicial[$i];
                    $detalle->save();
                }
                else { //auxiliar palet
                    $detalle                   = new PedidoProduccionAuxiliar();
                    $detalle->pedido_id        = $id;
                    $detalle->auxiliar_id      = $parte[$i];
                    $detalle->cantidad         = $cantidades[$i];
                    $detalle->cantidad_inicial = $inicial[$i];
                    $detalle->save();
                }
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            $datra['error'] = $ex->getMessage();
        }

        return response()->json($data);
    }

    public function ajaxGetDestinosComerciales(Request $request)
    {
        $id = $request->input('id');

        if (is_null($id)) return response()->json(null);

        $data           = array();
        $clienteDestino = ClienteDestinos::find($id);
        if (!is_null($clienteDestino)) {
            $data = DB::table('pedidos_produccion')->join('clientes_destinos', 'clientes_destinos.id', '=', 'pedidos_produccion.destino_id')->join('clientes', 'clientes.id', '=', 'clientes_destinos.cliente_id')->where('clientes_destinos.pais', 'like', '%' . $clienteDestino->pais . '%')->select('kilos', 'clientes.razon_social as cliente', 'clientes_destinos.pais')->get();
        }
        else {
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

    public function ajaxGetInventarioForPart(Request $request)
    {
        $id   = $request->input('id');
        $tipo = strtolower($request->input('tipo'));

        $data['data'] = array();
        if (is_null($id) || is_null($tipo) || $tipo == "") return response()->json($data);

        if ($tipo == "tarrina") {
            $data = Tarrina::Disponibles()->find($id);
        }
        else {
            $data = Auxiliar::Disponibles()->find($id);
        }

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
            }
            else {
                $cantidad_palets = 1;
            }
        }
        else { // si es un pallet grande
            if ($variedad->grand_cantidad > 0) {
                $cantidad_palets = $cantidad_cajas / $variedad->grand_cantidad;
            }
            else {
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

        $view['html'] = view('almacen.pedidos-produccion.palets')->with($data)->render();

        return response()->json($view);
    }

    public function pdf(Request $request, $id)
    {
        $data['pedido'] = PedidoProduccion::with([
            'cliente',
            'transporte',
            'destino',
            'variable.compuesto.cultivo',
            'variable.caja',
            'palet.modelo',
            'tarrinas.tarrina',
            'auxiliares.auxiliar',
            'palet_auxiliares.auxiliar'
        ])->find($id);

        $data['empresa'] = DatosFiscales::first();

        $pdf = \PDF::loadView('almacen.pedidos-produccion.pdf_pedido', $data)->setPaper('a4', 'portrait');

        //return view('almacen.pedidos-produccion.pdf_pedido', $data);

        return $pdf->stream('pedido ' . $id . '.pdf');
    }

    public function MaterialesDia(Request $request)
    {
        $anio    = $request->get('anio');
        $semana  = $request->get('semana');
        $dia     = $request->get('dia');
        $cultivo = $request->get('cultivo');

        $data['empresa'] = DatosFiscales::first();
        $pedidos = PedidoProduccion::with([
            'dia',
            'cliente',
            'tarrinas.tarrina',
            'auxiliares.auxiliar',
            'palet_auxiliares.auxiliar',
            'palet.modelo',
            'variable.caja'
        ])->withCultivos($semana, $anio, $cultivo)->where('dia_id', '=', $dia)->get();


        foreach ($pedidos as $p => $pedido)
        {
            $entrada = InventarioRel::entrada()
                                    ->where('pedido_id', $pedido->id)
                                    ->where('entrada.categoria', '=', 'Palet')
                                    ->where('entrada.categoria_id', $pedido->pallet_id)
                                    ->get();
            $pedidos{$p}->palets_entradas = $entrada;

            $salida = InventarioRel::salida()
                                   ->where('pedido_id', $pedido->id)
                                   ->where('salida.categoria', '=', 'Palet')
                                   ->where('salida.categoria_id', $pedido->pallet_id)
                                   ->get();
            $pedidos{$p}->palets_salidas = $salida;

            $entrada = InventarioRel::entrada()
                                    ->where('pedido_id', $pedido->id)
                                    ->where('entrada.categoria', '=', 'Palet')
                                    ->where('entrada.categoria_id', $pedido->variable->caja_id)
                                    ->get();
            $pedidos{$p}->cajas_entradas = $entrada;

            $salida = InventarioRel::salida()
                                   ->where('pedido_id', $pedido->id)
                                   ->where('salida.categoria', '=', 'Palet')
                                   ->where('salida.categoria_id', $pedido->variable->caja_id)
                                   ->get();
            $pedidos{$p}->cajas_salidas = $salida;

            foreach ($pedido->tarrinas as $i => $row)
            {
                $entrada = InventarioRel::entrada()
                                     ->where('pedido_id', $pedido->id)
                                     ->where('entrada.categoria', '=', 'Tarrina')
                                     ->where('entrada.categoria_id', $row->tarrina_id)
                                     ->get();
                $pedidos{$p}->tarrinas{$i}->entradas = $entrada;

                $salida = InventarioRel::salida()
                                     ->where('pedido_id', $pedido->id)
                                     ->where('salida.categoria', '=', 'Tarrina')
                                     ->where('salida.categoria_id', $row->tarrina_id)
                                     ->get();
                $pedidos{$p}->tarrinas{$i}->salidas = $salida;
            }

            foreach ($pedido->auxiliares as $i => $row)
            {
                $entrada = InventarioRel::entrada()
                                        ->where('pedido_id', $pedido->id)
                                        ->where('entrada.categoria', '=', 'Auxiliar')
                                        ->where('entrada.categoria_id', $row->auxiliar_id)
                                        ->get();
                $pedidos{$p}->auxiliares{$i}->entradas = $entrada;

                $salida = InventarioRel::salida()
                                       ->where('pedido_id', $pedido->id)
                                       ->where('salida.categoria', '=', 'Auxiliar')
                                       ->where('salida.categoria_id', $row->auxiliar_id)
                                       ->get();
                $pedidos{$p}->auxiliares{$i}->salidas = $salida;
            }

            foreach ($pedido->palet_auxiliares as $i => $row)
            {
                $entrada = InventarioRel::entrada()
                                        ->where('pedido_id', $pedido->id)
                                        ->where('entrada.categoria', '=', 'Auxiliar')
                                        ->where('entrada.categoria_id', $row->auxiliar_id)
                                        ->get();
                $pedidos{$p}->palet_auxiliares{$i}->entradas = $entrada;

                $salida = InventarioRel::salida()
                                       ->where('pedido_id', $pedido->id)
                                       ->where('salida.categoria', '=', 'Auxiliar')
                                       ->where('salida.categoria_id', $row->auxiliar_id)
                                       ->get();
                $pedidos{$p}->palet_auxiliares{$i}->salidas = $salida;
            }
        }

//        dd($pedidos);

        $data['pedidos'] = $pedidos;

        $pdf = \PDF::loadView('almacen.pedidos-produccion.pdf_materiales_dia', $data)->setPaper('a4', 'landscape');
//        return view('almacen.pedidos-produccion.pdf_materiales_dia', $data);

        return $pdf->stream('materiales ' . $anio . $semana . $dia . $cultivo . '.pdf');
    }
}
