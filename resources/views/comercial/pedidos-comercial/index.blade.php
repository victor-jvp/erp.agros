@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Comercial</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Pedidos Comerciales</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">Pedidos Comerciales</div>

                    {{--Modal Nuevo Pedido--}}
                    <form action="/comercial/pedidos-comercial" method="POST" id="pedido_form">
                        {{ csrf_field() }}
                        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                             aria-hidden="true" id="modal-pedido">
                            <div class="modal-dialog modal-lg mw-100 w-100">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-pedido-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="nro_orden">Nº Orden</label>
                                                <input type="text" name="nro_orden" id="nro_orden" class="form-control"
                                                       readonly>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="anio">Año</label>
                                                <input type="text" name="anio" id="anio" class="form-control" readonly>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="semana">Semana</label>
                                                <input type="text" name="semana" id="semana" class="form-control"
                                                       readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="cliente">Cliente</label>
                                                <select class="form-control chosen" id="cliente" name="cliente"
                                                        required>
                                                    @foreach ($clientes as $cliente)
                                                        <option
                                                            value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-12">
                                                <div class="table-responsive table-responsive-sm">
                                                    <table class="table table-sm table-bordered" id="table_nuevo_pedido"
                                                           width="100%" data-select="0">
                                                        <thead>
                                                        <tr>
                                                            <th width="5%" class="text-center">Dias</th>
                                                            <th width="15%">Producto Compuesto</th>
                                                            <th width="7%">Cajas</th>
                                                            <th width="7%">Kilos</th>
                                                            <th width="7%">€/Kg</th>
                                                            <th width="10%">Palet</th>
                                                            <th width="15%">Cantidad Palet</th>
                                                            <th width="10%">Destino</th>
                                                            <th width="10%">Transporte</th>
                                                            <th width="5%">Etiqueta</th>
                                                            <th width="5%">Comentario</th>
                                                            <th width="4%">Opciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($semana as $dia)
                                                            <tr id="tr_{{ $dia->id }}">
                                                                <td class="text-center dia_letra" rowspan="1"
                                                                    id="td_{{ $dia->id }}">{{ $dia->letra }}</td>
                                                                <td colspan="10"></td>
                                                                <td>
                                                                    <a href="javascript:void(0);"
                                                                       class="text-info mr-2 add"
                                                                       data-dia="{{ $dia->id }}" data-toggle="tooltip"
                                                                       data-placement="top" title=""
                                                                       data-original-title="Agregar">
                                                                        <i class="nav-icon i-Add font-weight-bold"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Cerrar
                                        </button>
                                        @can('Comercial - Pedidos Comerciales | Crear')
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- Fin modal Pedido --}}


                    {{-- Modal Editar Pedido --}}
                    <form action="/comercial/pedidos-comercial/update" method="POST" id="edit_pedido_form">
                        {{ csrf_field('PUT') }}
                        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                             aria-hidden="true" id="modal_edit_pedido">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal_edit_pedido-title">Modificar Pedido
                                            Comercial</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_nro_orden">Nº Orden</label>
                                                <input type="text" id="edit_nro_orden" class="form-control" readonly>
                                                <input type="hidden" id="edit_pedido_id">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="edit_anio">Año</label>
                                                <input type="text" id="edit_anio" class="form-control" readonly
                                                       name="anio">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="edit_semana">Semana</label>
                                                <input type="text" id="edit_semana" class="form-control" readonly
                                                       name="semana">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="edit_cliente">Cliente</label>
                                                <select class="form-control chosen" id="edit_cliente" name="cliente_id"
                                                        required>
                                                    @foreach ($clientes as $cliente)
                                                        <option
                                                            value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="anio">Dia</label>
                                                <input type="text" id="edit_dia" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-8 mb-3">
                                                <label for="edit_producto_id">Producto Compuesto</label>
                                                <select class="form-control chosen" name="producto_id"
                                                        id="edit_producto_id">
                                                    @foreach ($compuestos as $compuesto)
                                                        <option data-kg="{{ $compuesto->kg }}"
                                                                data-euro="{{ $compuesto->euro_cantidad }}"
                                                                data-grand="{{ $compuesto->grand_cantidad }}"
                                                                value="{{ $compuesto->id }}">
                                                            {{ $compuesto->compuesto->cultivo->cultivo. " - ".$compuesto->compuesto->compuesto. " - ".$compuesto->variable }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_cajas">Cajas</label>
                                                <input type="number" id="edit_cajas" class="form-control" step="1"
                                                       name="cajas">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_kilos">Kilos</label>
                                                <input type="number" id="edit_kilos" class="form-control" name="kilos"
                                                       step="0.01">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_precio">€/Kg</label>
                                                <input type="number" id="edit_precio" class="form-control" step="0.01"
                                                       name="precio">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="palet">Palet</label>
                                                <select name="palet_id" id="edit_palet_id" class="form-control">
                                                    @foreach ($palets as $palet)
                                                        <option
                                                            data-modelo="{{ ($palet->modelo_id == 1) ? 'data-euro' : 'data-grand' }}"
                                                            value="{{ $palet->id }}">
                                                            {{ $palet->modelo->modelo." - ".$palet->formato }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="cantidad_palet">Cant. Palet</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <a id="btnOpenModalPaletCantidad" href="javascript:void(0);"
                                                           class="input-group-text"><i class="i-Information"></i></a>
                                                    </div>
                                                    <input type="number" id="edit_cantidad_palet" name="palet_cantidad"
                                                           class="form-control" readonly step="1">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="destino">Destino</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <a href="javascript:void(0);" class="input-group-text"
                                                           id="btnOpenModalDestinos"><i class="i-Information"></i></a>
                                                    </div>
                                                    <select class="form-control" name="destino"
                                                            id="edit_destino"></select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="transporte">Transporte</label>
                                                <select class="form-control" id="edit_transporte" name="transporte_id">
                                                    @foreach ($transportes as $transporte)
                                                        <option
                                                            value="{{ $transporte->id }}">{{ $transporte->razon_social }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="etiqueta">Etiqueta</label>
                                                <input type="text" id="edit_etiqueta" class="form-control"
                                                       name="etiqueta">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8 mb-3">
                                                <label for="transporte">Comentario</label>
                                                <textarea class="form-control" name="comentario" id="edit_comentario"
                                                          rows="4"></textarea>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="estado">Estado</label>
                                                        <select name="estado_id" id="edit_estado_id"
                                                                class="form-control">
                                                            @foreach($estados as $estado)
                                                                <option
                                                                    value="{{ $estado->id }}">{{ $estado->estado }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <button type="button"
                                                                class="btn btn-outline-info m-1 mb-3 btn-block"
                                                                id="btnCheckStock">
                                                            <span class="ul-btn__icon"><i
                                                                    class="i-Information"></i></span>
                                                            <span class="ul-btn__text">Verificar Stock</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" id="div_cancelar">
                                            <div class="col-md-8 mb-3">
                                                <label for="transporte">Comentario de Cancelación</label>
                                                <textarea class="form-control" name="cancelado_coment"
                                                          id="edit_cancelado_comentario" rows="4"></textarea>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="cancelado_id">Motivo de Cancelación</label>
                                                <select name="cancelado_id" id="edit_cancelado_id" class="form-control">
                                                    @foreach($motivos_cancelados as $motivo)
                                                        <option
                                                            value="{{ $motivo->id }}">{{ $motivo->descripcion }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Cerrar
                                        </button>
                                        @can('Comercial - Pedidos Comerciales | Modificar')
                                            <button type="submit" class="btn btn-primary" id="btnSavePedido">Guardar
                                            </button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- Fin modal Editar Pedido --}}

                    {{--Modal Destino Comercial--}}
                    <div class="modal fade" id="modal-destino_comercial" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-destino_comercial-title">Destinos Comerciales
                                        del Cliente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-3 table-responsive">
                                            <table class="table table-striped table-sm" width="100%"
                                                   id="table_destinos_comerciales">
                                                <thead>
                                                <tr>
                                                    <th>Pais</th>
                                                    <th>Cliente</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio</th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            id="btnCloseModalDestinoComercial">Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--FIN Modal Destino Comercial--}}

                    {{--Modal Distribucion de cajas en palet--}}
                    <div class="modal fade" id="modal-cantidad_palet" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-title">Cantidad de Palets</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row body-fill">

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="btnCloseModalCantidadPalet">
                                        Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--FIN Modal Distribucion de cajas en palet--}}

                    {{--Modal Disponibilidad de Partes del Producto--}}
                    <div class="modal fade" id="modal-inventario_disponible" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-destino_comercial-title">Inventario
                                        Disponible</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-3 table-responsive">
                                            <table class="table table-striped table-sm" width="100%"
                                                   id="table_inventario_disponible">
                                                <thead>
                                                <tr>
                                                    <th>Tipo</th>
                                                    <th>Descripción</th>
                                                    <th>Cantidad por Caja</th>
                                                    <th>Disponible</th>
                                                    <th>Cantidad Necesaria</th>
                                                    <th>Cantidad Restante</th>
                                                    <th>Resultado</th>
                                                </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            id="btnCloseModalinventario_disponible">Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--FIN Modal isponibilidad de Partes del Producto--}}

                    <form action="/comercial/pedidos-comercial" method="GET" id="form_fecha_act">
                        <div class="row">
                            <div class="col-md-3 form-group mb-3">
                                <label>Año</label>
                                <select class="form-control" name="anio_act" id="anio_act">
                                    @for($i = $anio_fin; $i >= $anio_ini; $i--)
                                        <option {{ ($i == $anio_act) ? 'selected' : '' }} value="{{ $i }}">
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-3 form-group mb-3">
                                <label>Semana</label>
                                <select class="form-control" name="semana_act" id="semana_act">
                                    @for($i = $semana_fin; $i >= $semana_ini; $i--)
                                        <option {{ ($i == $semana_act) ? 'selected' : '' }} value="{{ $i }}">
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-6 text-right form-group mb-3">
                                <br>
                                @can('Comercial - Pedidos Comerciales | Crear')
                                    <button class="btn btn-outline-primary" type="button" id="btnAddPedido">
                                        Añadir Pedido
                                    </button>
                                @endcan
                            </div>
                        </div>
                    </form>

                    <div class="row">

                        <div class="col-md-3 form-group mb-3">
                            <label>Buscar</label>
                            <input type="text" class="form-control" id="buscar">
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label>Estado</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="radio radio-outline-primary">
                                        <input type="radio" class="estado" name="estado" value="" checked>
                                        <span class="text-primary">Todos</span>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label class="radio radio-outline-warning">
                                        <input type="radio" class="estado" name="estado" value="1">
                                        <span class="text-warning">En Espera</span>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label class="radio radio-outline-success">
                                        <input type="radio" class="estado" name="estado" value="2">
                                        <span class="text-success">Confirmados</span>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label class="radio radio-outline-danger">
                                        <input type="radio" class="estado" name="estado" value="3">
                                        <span class="text-danger">Cancelados</span>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Cultivos</label>

                            <ul class="nav nav-pills" id="myPillTab" role="tablist">
                                @foreach ($cultivos as $c => $cultivo)
                                    <li class="nav-item">
                                        <a class="nav-link {{ ($c==0) ? 'active show' : '' }}" id="home-icon-pill"
                                           data-toggle="pill" href="#cultivo_{{ $cultivo->id }}_pill" role="tab"
                                           aria-controls="cultivo_{{ $cultivo->id }}_pill"
                                           aria-selected="{{ ($c==0) ? 'true' : 'false' }}">{{ $cultivo->cultivo }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content" id="myPillTabContent">
                                @foreach ($cultivos as $c => $cultivo)
                                    <div class="tab-pane fade {{ ($c==0) ? 'active show' : '' }}"
                                         id="cultivo_{{ $cultivo->id }}_pill" role="tabpanel"
                                         aria-labelledby="cultivo_{{ $cultivo->id }}_pill">
                                        @foreach ($semana as $dia)
                                            <h3>{{ $dia->dia }}</h3>
                                            <div class="row">
                                                <div class="col-md-12 mb-3 table-responsive">
                                                    <table class="table table_pedidos table-sm" width="100%">
                                                        <thead>
                                                        <tr>
                                                            <th>Nº Orden</th>
                                                            <th>Cliente</th>
                                                            <th>Producto Compuesto</th>
                                                            <th>Cajas</th>
                                                            <th>Kilos</th>
                                                            <th>€/Kg</th>
                                                            <th>Palet</th>
                                                            <th>Cantidad Palet</th>
                                                            <th>Destino</th>
                                                            <th>Transporte</th>
                                                            <th>Etiqueta</th>
                                                            <th>Comentario</th>
                                                            <th>Acciones</th>
                                                            <th>id</th>
                                                            <th>estado_id</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($cultivo->pedidos as $pedido)
                                                            @if($pedido->dia_id == $dia->id)

                                                                @php
                                                                    $color = "";
                                                                    if($pedido->estado_id == 1){ // En espera
                                                                    $color = "text-warning";
                                                                    }elseif ($pedido->estado_id == 3) { // Cancelado
                                                                    $color = "text-danger";
                                                                    }elseif ($pedido->estado_id == 2){ // Confirmado
                                                                    $color = "text-success";
                                                                    }
                                                                @endphp


                                                                <tr>
                                                                    <td class="{{ $color }}">{{ $pedido->nro_orden }}</td>
                                                                    <td class="{{ $color }}">
                                                                        {{ (!is_null($pedido->cliente)) ? $pedido->cliente->razon_social : "" }}
                                                                    </td>
                                                                    <td class="{{ $color }}">
                                                                        {{ $pedido->variable->compuesto->cultivo->cultivo." - ".$pedido->variable->compuesto->compuesto. " - ". $pedido->variable->variable }}
                                                                    </td>
                                                                    <td class="text-right {{ $color }}">{{ number_format($pedido->cajas, 0, ',', '.') }}</td>
                                                                    <td class="text-right {{ $color }}">{{ number_format($pedido->kilos, 2, ',', '.') }}</td>
                                                                    <td class="text-right {{ $color }}">{{ number_format($pedido->precio, 2, ',', '.') }}</td>
                                                                    <td class="{{ $color }}">
                                                                        {{ (is_null($pedido->pallet_id)) ? "" : $pedido->palet->modelo->modelo." - ".$pedido->palet->formato }}
                                                                    </td>
                                                                    <td class="text-right {{ $color }}">{{ number_format($pedido->pallet_cantidad, 0, ',', '.') }}</td>
                                                                    <td class="{{ $color }}">
                                                                        {{ (is_null($pedido->destino_id)) ? "" : $pedido->destino->descripcion }}
                                                                    </td>
                                                                    <td class="{{ $color }}">
                                                                        {{ (is_null($pedido->transporte_id)) ? "" : $pedido->transporte->razon_social }}
                                                                    </td>
                                                                    <td class="{{ $color }}">{{ $pedido->etiqueta }}</td>
                                                                    <td class="{{ $color }}">{{ $pedido->comentarios }}</td>
                                                                    <td>
                                                                        <a href="javascript:void(0);"
                                                                           onclick="EditPedidoComercial({{ $pedido->id }})"
                                                                           class="text-success mr-2"
                                                                           data-toggle="tooltip"
                                                                           data-placement="top" title=""
                                                                           data-original-title="Editar">
                                                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                                        </a>
                                                                        @if ($pedido->estado_id != 2)
                                                                            @can('Comercial - Pedidos Comerciales | Borrar')
                                                                                <a href="javascript:void(0);"
                                                                                   class="text-danger mr-2 delete"
                                                                                   data-toggle="tooltip"
                                                                                   data-placement="top" title=""
                                                                                   data-original-title="Borrar">
                                                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                                                </a>
                                                                            @endcan
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $pedido->id }}</td>
                                                                    <td>{{ $pedido->estado_id }}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/bootstrap-select.min.css')}}">

    {{--    Chosen Plugin--}}
    {{--    <link rel="stylesheet" href="{{asset('assets/styles/vendor/chosen-bootstrap-4.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('assets/styles/vendor/chosen.css')}}">--}}
@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-select/i18n/defaults-es_ES.min.js')}}"></script>
    {{--    Chosen Plugin--}}
    {{--    <script src="{{asset('assets/js/vendor/chosen.jquery.js')}}"></script>--}}
    <script src="{{asset('assets/js/vendor/calendar/moment-with-locales.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            /*$(".chosen").chosen({
                width: "100%",
                no_results_text: "No se encontraron resultados... ",
                placeholder_text_single: "Seleccione una opción...",
                allow_single_deselect: true
            });*/

            $(".chosen").selectpicker({
                liveSearch: true
            });
        });

        $.fn.dataTable.Api.register('inTable()', function (value) {
            return this
                .data()
                .toArray()
                .toString()
                .toLowerCase()
                .split(',')
                .indexOf(value.toString().toLowerCase()) > -1
        });

        $.fn.selectpicker.Constructor.BootstrapVersion = '4';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.extend(true, $.fn.dataTable.defaults, {
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    </script>

    <script>
        $(function () {
            $("#semana_act, #anio_act").change(function () {
                $("#form_fecha_act").submit();
            });

            $("#pedido_form").one('submit', function (f) {
                f.preventDefault();
                $(this).submit();
            });
        })
    </script>

    <script>
        var nro_orden = "{{ $nro_orden }}";
        var table_destinos;
        var table_pedidos;
        var table_nuevo_pedido;
        var table_inventario_disponible;
        var inventario_id;
        var pedido_id;
        var inventario_cantidad;
        var inventario_kilos;
        var inventario_resultado;

        $(document).ready(function () {
            // Configuracion de Datatable
            table_pedidos = $('.table_pedidos').DataTable({
                responsive: true,
                info: false,
                paging: false,
                searching: true,
                dom: 'ltipr',
                columnDefs: [{
                    targets: [13, 14],
                    visible: false
                }]
            });

            table_destinos = $('#table_destinos_comerciales').DataTable({
                responsive: true,
                info: false,
                paging: false
            });

            table_inventario_disponible = $('#table_inventario_disponible').DataTable({
                ajax: {
                    url: "{{ route('pedidos-comercial.ajaxCheckStock') }}",
                    type: "POST",
                    data: function (a) {
                        a.pedido_id = pedido_id;
                        a.id = inventario_id;
                        a.cantidad = inventario_cantidad;
                        a.kilos = inventario_kilos;
                    }
                },
                columns: [
                    {
                        data: 'categoria'
                    },
                    {
                        data: 'descripcion'
                    },
                    {
                        data: 'default'
                    },
                    {
                        data: 'disponible',
                        render: function(data){
                            return parseFloat(data.toFixed(2))
                        }
                    },
                    {
                        data: 'necesarios',
                        render: function(data){
                            return parseFloat(data.toFixed(2))
                        }
                    },
                    {
                        data: 'restantes',
                        render: function(data){
                            return parseFloat(data.toFixed(2))
                        }
                    },
                    {
                        data: 'resultado',
                        render: function (data, type, row, meta) {
                            var html = "";
                            if (data == true) {
                                html =
                                    '<a ref="javascript:void(0)" class="text-success mr-2"><i class="nav-icon i-Like font-weight-bold"></i></a>';
                            } else {
                                html =
                                    '<a ref="javascript:void(0)" class="text-danger mr-2"><i class="nav-icon i-Unlike font-weight-bold"></i></a>';
                            }
                            return html;
                        }
                    },
                ],
                responsive: true,
                info: false,
                paging: false
            });

            $(".estado").on('change', function (e) {
                var estado = $(this).val();
                table_pedidos.tables().columns(14).search(estado).draw();
            });

            $("#buscar").on('change', function (e) {
                var valor = $(this).val();
                table_pedidos.tables().search(valor).draw();
            });

            $("#table_nuevo_pedido").on('click', '.add', function () {
                $(this).tooltip('hide');

                var tr = $(this).closest('tr');
                var data_dia = $(this).attr('data-dia');
                var letra = $("#table_nuevo_pedido").find('#td_' + data_dia).html();
                var _rowspan = $("#table_nuevo_pedido").find('#td_' + data_dia).attr('rowspan');
                var selector = $("#table_nuevo_pedido").attr("data-select");
                var td_rowspan = "";

                if (_rowspan == null || _rowspan == undefined) {
                    td_rowspan = '<td class="text-center dia_letra" id="td_' + data_dia + '" rowspan="1">' +
                        letra + '</td>';
                } else {
                    _rowspan = (parseInt(_rowspan) + 1);
                    $("#table_nuevo_pedido").find('#td_' + data_dia).attr('rowspan', (_rowspan));
                }

                var html = '<tr id="tr_' + data_dia + '">' +
                    td_rowspan +
                    '<td style="max-width: 200px"><select name="compuesto[]" class="form-control compuesto" id="compuesto_' +
                    selector + '" required></select></td>' +
                    '<td style="min-width: 90px"><input type="number" name="cajas[]" class="form-control cajas" step="1" required></td> ' +
                    '<td style="min-width: 90px"><input type="text" name="kilos[]" class="form-control kilos" readonly value="0"></td> ' +
                    '<td style="min-width: 90px"><input type="number" name="precio[]" class="form-control" value="0" step="0.01" required></td> ' +
                    '<td style="min-width: 90px"><select name="palet_model[]" class="form-control palet_model" onmouseover="loadPalet(this)" required></select></td> ' +
                    '<td style="min-width: 90px"><div class="input-group"><div class="input-group-prepend"><a href="javascript:void(0);" class="input-group-text btnOpenModalPaletCantidad"><i class="i-Information"></i></a></div><input type="number" name="palet_cantidad[]" readonly class="form-control palet_cantidad" step="1"></div></td> ' +
                    '<td style="min-width: 90px"><div class="input-group"><div class="input-group-prepend"><a href="javascript:void(0);" class="input-group-text btnOpenModalDestinos"><i class="i-Information"></i></a></div><select name="destino[]" class="form-control destino" onmouseover="loadDestinosForCliente(this)" aria-describedby="basic-addon1"></select></div></td> ' +
                    '<td ><select name="transporte[]" class="form-control" onmouseover="loadTransporte(this)"></select></td> ' +
                    '<td ><input type="text" name="etiqueta[]" class="form-control"></td> ' +
                    '<td ><textarea rows="1" name="comentario[]" class="form-control"></textarea></td> ' +
                    '<td > ' +
                    '<a href="javascript:void(0);" class="text-info mr-2 add" data-toggle="tooltip" data-placement="top" title="" data-original-title="Agregar" data-dia="' +
                    data_dia + '"> ' +
                    '<i class="nav-icon i-Add font-weight-bold"></i> ' +
                    '</a> ' +
                    '<a href="javascript:void(0);" class="text-danger mr-2 delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Borrar" data-dia="' +
                    data_dia + '"> ' +
                    '<i class="nav-icon i-Close-Window font-weight-bold"></i> ' +
                    '</a> ' +
                    '<input type="hidden" name="dia[]" value="' + data_dia + '">' +
                    '</td></tr>';
                $(tr).after(html);

                loadCompuesto($("#compuesto_" + selector));

                $("#table_nuevo_pedido").attr("data-select", (parseInt(selector) + 1));

                $(".compuesto").on('changed.bs.select', function (e) {
                    var total_cajas = $(this).closest('tr').find('input.cajas').val();
                    var palet_model = $(this).closest('tr').find('select.palet_model').find(
                        'option:selected').attr('data-modelo');
                    var por_palet = null;
                    if (palet_model != null) {
                        por_palet = $('option:selected', this).attr(palet_model);
                        $(this).closest('tr').find('input.cajas').attr('data-porpalet', por_palet);
                    }

                    if (total_cajas != null && por_palet != null && total_cajas != "" &&
                        por_palet != "") {
                        var cant = fillModalPaletCantidad(total_cajas, por_palet);
                        $(this).closest('tr').find('input.palet_cantidad').val(cant);
                    } else {
                        $(this).closest('tr').find('input.palet_cantidad').val(null);
                    }
                });

                $(".cajas").change(function (e) {
                    var kg = $(this).closest('tr').find('select.compuesto').find('option:selected')
                        .attr('data-kg');
                    var cajas = $(this).closest('tr').find('input.cajas').val();
                    $(this).closest('tr').find('input.kilos').val(kg * cajas);

                    var total_cajas = $(this).closest('tr').find('input.cajas').val();
                    var palet_model = $(this).closest('tr').find('select.palet_model').find(
                        'option:selected').attr('data-modelo');
                    var por_palet = null;
                    if (palet_model != null) {
                        var compuesto = $(this).closest('tr').find('select.compuesto');
                        $(compuesto).trigger('change');
                        por_palet = $(this).attr('data-porpalet');
                    }

                    if (total_cajas != null && por_palet != null && total_cajas != "" &&
                        por_palet != "") {
                        var cant = fillModalPaletCantidad(total_cajas, por_palet);
                        $(this).closest('tr').find('input.palet_cantidad').val(cant);
                    } else {
                        $(this).closest('tr').find('input.palet_cantidad').val(null);
                    }
                });

                $(".palet_model").change(function (e) {
                    var total_cajas = $(this).closest('tr').find('input.cajas').val();
                    var palet_model = $(this).closest('tr').find('select.palet_model').find(
                        'option:selected').attr('data-modelo');
                    var por_palet = null;
                    if (palet_model != null) {
                        var compuesto = $(this).closest('tr').find('select.compuesto');
                        $(compuesto).trigger('change');
                        por_palet = $(this).closest('tr').find('input.cajas').attr('data-porpalet');
                    }

                    if (total_cajas != null && por_palet != null && total_cajas != "" &&
                        por_palet != "") {
                        var cant = fillModalPaletCantidad(total_cajas, por_palet);
                        $(this).closest('tr').find('input.palet_cantidad').val(cant);
                    } else {
                        ClearModalPaletCantidad();
                        $(this).closest('tr').find('input.palet_cantidad').val(null);
                    }
                });

                $(".btnOpenModalDestinos").click(function (e) {
                    var id = $("#cliente").val();
                    loadDestinosComerciales(id);
                    $("#modal-destino_comercial").modal('show');
                });

                $(".btnOpenModalPaletCantidad").click(function (e) {
                    $("#modal-cantidad_palet").modal('show');
                });
            });

            $("#table_nuevo_pedido").on('click', '.delete', function () {
                $(this).tooltip('hide');

                var data_dia = $(this).attr('data-dia');
                var tr = $(this).closest('tr');
                var td_dia = $("#table_nuevo_pedido").find('#td_' + data_dia);
                var letra = $("#table_nuevo_pedido").find('#td_' + data_dia).html();

                var _rowspan = parseInt($(td_dia).attr('rowspan'));
                $("#table_nuevo_pedido").find('#td_' + data_dia).attr('rowspan', (_rowspan - 1));

                $(tr).remove();
            });

            $('.table_pedidos').on('click', '.delete', function () {
                var current_row = $(this).parents('tr');
                if (current_row.hasClass('child')) {
                    current_row = current_row.prev();
                }

                var row = $(this).parents('table').DataTable().row(current_row).data();

                swal({
                    title: 'Confirmar Proceso',
                    text: "Confirme eliminar el registro seleccionado",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonClass: 'btn btn-success mr-5',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                }).then(function () {
                    window.location.href = "{{ url('comercial/pedidos-comercial/delete') }}" + "/" +
                        row[13];
                })
            });

            $("#btnAddPedido").click(function (e) {
                limpiarCamposPedido();
                $("#nro_orden").val(nro_orden);
                $("#anio").val($("#anio_act").val())
                $("#semana").val($("#semana_act").val())
                $("#modal-pedido-title").html("Nuevo Pedido");
                $("#pedido_method").val(null);
                var url = '{{ url("comercial/pedidos-comercial") }}';
                $("#pedido_form").attr('action', url);

                $(".dias").prop("checked", false).prop('disabled', false);

                $(".EuroPallet, .PalletGrande").css('display', 'none');
                $("#modal-pedido").modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });

            $("#btnDestinoComercial").click(function (e) {
                $("#modal-destino_comercial").modal('show');
            });

            $("#btnCloseModalDestinoComercial").click(function (e) {
                $("#modal-destino_comercial").modal('toggle');
                $('#modal-pedido').css('overflow-y', 'auto');
            });

            $("#btnCloseModalDestinoComercial").click(function (e) {
                $("#modal-destino_comercial").modal('toggle');
                $('#modal-pedido').css('overflow-y', 'auto');
            });

            $("#btnCloseModalCantidadPalet").click(function (e) {
                $("#modal-cantidad_palet").modal('toggle');
                $('#modal-pedido').css('overflow-y', 'auto');
            });

            $("#cliente").change(function () {
                var id = $(this).val();
                if (id != null)
                    loadDestinosComerciales(id);
            });

            //Modal Edit Pedidos Events
            $("#edit_producto_id").on('changed.bs.select', function (e) {
                var total_cajas = $('#edit_cajas').val();
                var palet_model = $('#edit_palet_id').find('option:selected').attr('data-modelo');
                var por_palet = null;
                if (palet_model != null) {
                    por_palet = $('option:selected', this).attr(palet_model);
                    $('#edit_cajas').attr('data-porpalet', por_palet);
                }

                if (total_cajas != null && por_palet != null && total_cajas != "" && por_palet != "") {
                    var cant = fillModalPaletCantidad(total_cajas, por_palet);
                    $('#edit_cantidad_palet').val(cant);
                } else {
                    $('#edit_cantidad_palet').val(null);
                }
            });
            $("#edit_cajas").change(function (e) {
                var kg = $('#edit_producto_id').find('option:selected').attr('data-kg');
                var cajas = $('#edit_cajas').val();
                $('#edit_kilos').val(kg * cajas);

                var total_cajas = $('#edit_cajas').val();
                var palet_model = $('#edit_palet_id').find('option:selected').attr('data-modelo');
                var por_palet = null;
                if (palet_model != null) {
                    $('#edit_producto_id').trigger('change');
                    por_palet = $(this).attr('data-porpalet');
                }

                if (total_cajas != null && por_palet != null && total_cajas != "" && por_palet != "") {
                    var cant = fillModalPaletCantidad(total_cajas, por_palet);
                    $('#edit_cantidad_palet').val(cant);
                } else {
                    $('#edit_cantidad_palet').val(null);
                }
            });
            $("#edit_palet_id").change(function (e) {
                var total_cajas = $('#edit_cajas').val();
                var palet_model = $('#edit_palet_id').find('option:selected').attr('data-modelo');
                var por_palet = null;
                if (palet_model != null) {
                    $('#edit_producto_id').trigger('change');
                    por_palet = $("#edit_cajas").attr('data-porpalet');
                }

                if (total_cajas != null && por_palet != null && total_cajas != "" && por_palet != "") {
                    var cant = fillModalPaletCantidad(total_cajas, por_palet);
                    $('#edit_cantidad_palet').val(cant);
                } else {
                    $('#edit_cantidad_palet').val(null);
                }
            });
            $("#btnOpenModalPaletCantidad").click(function (e) {
                $("#modal-cantidad_palet").modal('show');
            });
            $("#btnOpenModalDestinos").click(function (e) {
                $("#modal-destino_comercial").modal('show');
            });
            $("#edit_cliente").on('changed.bs.select', function (e) {
                var valor = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('pedidos-comercial.ajaxGetDestinosComerciales') }}",
                    dataType: 'JSON',
                    data: {
                        id: valor
                    },
                    success: function (data) {
                        ClearDestinosComerciales();
                        if (data == null) return;

                        for (i = 0; i < data.length; i++) {
                            var row = data[i];
                            // var options = '<label class="checkbox checkbox-success"><input type="checkbox" name="destinos[]" value="' + row.id + '"><span class="checkmark"></span></label>';
                            table_destinos.row.add([
                                row.pais,
                                row.cliente,
                                row.kilos,
                                row.precio
                            ]).draw();
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        alert('Error. Check Console Log');
                    },
                });
            });

            $("#btnCloseModalinventario_disponible").click(function (e) {
                $("#modal-inventario_disponible").modal('toggle');
                $('#modal_edit_pedido').css('overflow-y', 'auto');
            });

            $("#btnCheckStock").click(function () {
                inventario_id = $("#edit_producto_id").val();
                pedido_id = $("#edit_pedido_id").val();
                inventario_cantidad = $("#edit_cajas").val();
                inventario_kilos = $("#edit_kilos").val();

                table_inventario_disponible.ajax.reload(function (json) {
                    inventario_resultado = json.result;
                });
                $("#modal-inventario_disponible").modal('show');
            });

            $("#div_cancelar").hide();

            $("#edit_estado_id").change(function () {
                var valor = $(this).val();

                if (valor == 3) {
                    $("#edit_cancelado_comentario, #edit_cancelado_id").attr('required', true);
                    $("#div_cancelar").fadeIn();
                } else {
                    $("#edit_cancelado_comentario, #edit_cancelado_id").removeAttr('required');
                    $("#div_cancelar").fadeOut();
                }
            });
        });

        function EditPedidoComercial(id) {
            if (id == null) return;

            $.ajax({
                type: 'POST',
                url: "{{ route('pedidos-comercial.details') }}",
                dataType: 'JSON',
                data: {
                    id: id
                },
                success: function (data) {
                    ClearModalEditPedidoComercial();
                    if (data == null) return;

                    $("#edit_pedido_id").val(id);
                    $("#edit_nro_orden").val(data.nro_orden);
                    $("#edit_anio").val(data.anio);
                    $("#edit_semana").val(data.semana);
                    $("#edit_cliente").val(data.cliente_id).selectpicker('refresh');
                    $("#edit_producto_id").val(data.producto_id).selectpicker('refresh');
                    $("#edit_dia").val(data.dia.dia);
                    $("#edit_cajas").val(data.cajas);
                    $("#edit_kilos").val(data.kilos);
                    $("#edit_precio").val(data.precio);
                    $("#edit_palet_id").val(data.pallet_id);
                    $("#edit_cantidad_palet").val(data.pallet_cantidad);
                    loadDestinosForEditCliente($("#edit_destino"), data.destino_id, data.cliente_id);
                    $("#edit_transporte").val(data.transporte_id);
                    $("#edit_etiqueta").val(data.etiqueta);
                    $("#edit_comentario").val(data.comentarios);
                    $("#edit_estado_id").val(data.estado_id).change();

                    if (data.estado_id == 2 || data.estado_id == 3) {
                        $("#btnSavePedido").attr("disabled", true);
                        $("#edit_cajas, #edit_precio, #edit_palet_id, #edit_destino, #edit_transporte, #edit_etiqueta, #edit_comentario, #edit_estado_id")
                            .attr("disabled", true);
                        $("#edit_cliente, #edit_producto_id").attr("disabled", true).selectpicker('refresh');

                        if (data.estado_id == 3) {
                            $("#edit_cancelado_id").val(data.cancelado_id).attr("disabled", true);
                            $("#edit_cancelado_comentario").val(data.cancelado_coment).attr("disabled", true);
                        }
                    } else {
                        $("#btnSavePedido").attr("disabled", false);
                        $("#edit_cajas, #edit_precio, #edit_palet_id, #edit_destino, #edit_transporte, #edit_etiqueta, #edit_comentario, #edit_estado_id")
                            .attr("disabled", false);
                        $("#edit_cliente, #edit_producto_id").attr("disabled", false).selectpicker('refresh');

                        $("#edit_cancelado_id").val(null).attr("disabled", false);
                        $("#edit_cancelado_comentario").val(null).attr("disabled", false);
                    }

                    $("#edit_pedido_form").attr('action', '{{ url("comercial/pedidos-comercial/update") }}' +
                        "/" + id);
                    $("#modal_edit_pedido").modal('show');
                },
                error: function (error) {
                    console.log(error);
                    alert('Error. Check Console Log');
                },
            });
        }

        function ClearModalEditPedidoComercial() {
            $("#modal_edit_pedido > input").val(null);
            $("#modal_edit_pedido > select").val(null).find('.chosen').selectpicker('refresh');
        }

        function fillModalPaletCantidad(total_cajas, por_palet) {
            $("#modal-cantidad_palet .body-fill").html(null);
            var html = "";
            var n = true;
            var i = 0;
            var palet = parseInt(por_palet);
            var total = parseInt(total_cajas);

            console.log(total_cajas);
            console.log(por_palet);

            if (palet <= 0 || total <= 0 || por_palet == null || total_cajas == null || por_palet == "null" ||
                total_cajas == "null") {
                return null;
            } else {
                while (n == true) {
                    i++;
                    if (palet >= total) {
                        n = false;
                        palet = total;
                    }
                    html = '<div class="col-md-4">\n' +
                        '<div class="card card-icon mb-4">\n' +
                        '        <div class="card-body text-center">\n' +
                        '            <p class="text-muted mt-2 mb-2">Palet ' + i + '</p>\n' +
                        '            <p class="lead text-22 m-0">' + palet + ' Cajas</p>\n' +
                        '        </div>\n' +
                        '    </div>\n' +
                        '</div>';
                    $("#modal-cantidad_palet .body-fill").append(html);
                    total = total - palet;
                }
                return i;
            }
        }

        function ClearModalPaletCantidad() {
            $("#modal-cantidad_palet .body-fill").html(null);
        }

        function calcularCantidades() {
            calcularKilos();
            calcularTarrinasAuxiliares();
        }

        function calcularKilos() {
            var cantidad = $("#cantidad").val();
            var euro_kg = $("#euro_kg").val();
            var grand_kg = $("#grand_kg").val();
            var precio = $("#precio").val();

            var kilos = 0;
            var total_pedido = 0;
            if (cantidad > 0) {
                if ($("#EuroPallet-tab").hasClass('active')) {
                    kilos = cantidad * euro_kg;
                } else if ($("#PalletGrande").hasClass('active')) {
                    kilos = cantidad * grand_kg;
                }

                if (precio > 0) {
                    total_pedido = precio * kilos;
                }
            }

            $("#kilos").val(kilos);
            $("#total_pedido").val(total_pedido);
        }

        function limpiarCamposPedido() {
            $('#nro_orden, #destino_comercial, #cultivo, #formato, #etiqueta, #transporte, #precio, #kilos, #comentario, #variedad')
                .val(null);
            $("#cliente").val(null).selectpicker('refresh');
            $('#producto, #producto_compuesto, #modelo_palet, #formato_palet, #cantidad').val(null);
            $(".dias").prop("checked", false).prop('disabled', false);
            $(".chosen").trigger("chosen:updated");
        }

        function loadDestinosComerciales(valor) {
            $.ajax({
                type: 'POST',
                url: "{{ route('pedidos-comercial.ajaxGetDestinosComerciales') }}",
                dataType: 'JSON',
                data: {
                    id: valor
                },
                success: function (data) {
                    ClearDestinosComerciales();
                    if (data == null) return;

                    for (i = 0; i < data.length; i++) {
                        var row = data[i];
                        // var options = '<label class="checkbox checkbox-success"><input type="checkbox" name="destinos[]" value="' + row.id + '"><span class="checkmark"></span></label>';
                        table_destinos.row.add([
                            row.pais,
                            row.cliente,
                            row.kilos,
                            row.precio
                        ]).draw();
                    }
                },
                error: function (error) {
                    console.log(error);
                    alert('Error. Check Console Log');
                },
            });
        }

        function ClearDestinosComerciales() {
            table_destinos.rows().remove().draw();
        }

        function loadDestinosForCliente(elem) {
            var id = $("#cliente").val();
            if (id == null) return;
            var count = $(elem).find('option').length;
            if (count > 0) return;

            $.ajax({
                type: 'POST',
                url: "{{ route('pedidos-comercial.ajaxGetDestinosComercialesForCliente') }}",
                dataType: 'JSON',
                data: {
                    id: id
                },
                success: function (data) {
                    ClearDestinosForCliente(elem);
                    if (data == null) return;

                    for (i = 0; i < data.length; i++) {
                        var value = data[i].id;
                        var text = data[i].descripcion;
                        var option = "<option value='" + value + "'>" + text + "</option>";
                        $(elem).append(option);
                    }
                },
                error: function (error) {
                    console.log(error);
                    alert('Error. Check Console Log');
                },
            });
        }

        function ClearDestinosForCliente(elem) {
            $(elem).html(null).append('<option value="">Seleccione...</option>');
        }

        function loadDestinosForEditCliente(elem, selected, id_cliente) {
            if (id_cliente == null) return;

            $.ajax({
                type: 'POST',
                url: "{{ route('pedidos-comercial.ajaxGetDestinosComercialesForCliente') }}",
                dataType: 'JSON',
                data: {
                    id: id_cliente
                },
                success: function (data) {
                    ClearDestinosForEditCliente(elem);
                    if (data == null) return;

                    for (i = 0; i < data.length; i++) {
                        var value = data[i].id;
                        var text = data[i].descripcion;
                        var option = "<option value='" + value + "'>" + text + "</option>";
                        $(elem).append(option);
                    }

                    $(elem).val(selected).trigger('chosen:updated');
                },
                error: function (error) {
                    console.log(error);
                    alert('Error. Check Console Log');
                },
            });
        }

        function ClearDestinosForEditCliente(elem) {
            $(elem).html(null).append('<option value="">Seleccione...</option>');
        }

        function loadCompuesto(elem) {

            var count = $(elem).find('option').length;
            if (count > 0) {
                return;
            }

            $.ajax({
                type: 'POST',
                url: "{{ route('productos-compuestos.ajaxGetCompuesto') }}",
                dataType: 'JSON',
                success: function (data) {
                    ClearCompuesto(elem);
                    if (data == null) return;

                    var selector = '';

                    for (i = 0; i < data.length; i++) {
                        var value = data[i].id;
                        var text = data[i].compuesto.cultivo.cultivo + " - " + data[i].compuesto.compuesto + " - " + data[i].variable;
                        var kg = data[i].kg;
                        var euro_palet = data[i].euro_cantidad;
                        var grand_palet = data[i].grand_cantidad;
                        var option = "<option data-kg='" + kg + "' data-euro='" + euro_palet +
                            "' data-grand='" + grand_palet + "' value='" + value + "'>" + text + "</option>";
                        $(elem).append(option);
                    }

                    /*$(elem).chosen({
                        no_results_text: "No se encontraron resultados... ",
                        placeholder_text_single: "Seleccione...",
                        allow_single_deselect: true,
                        //max_shown_results: 4,
                        width: "100%",
                    });*/

                    $(elem).selectpicker({
                        liveSearch: true,
                        size: 4,
                        dropdownAlignRight: true,
                        //dropupAuto: true,
                    });
                },
                error: function (error) {
                    console.log(error)
                    alert('Error. Check Console Log');
                },
            });
        }

        function ClearCompuesto(elem) {
            $(elem).html(null).append('<option value=""></option>');
        }

        function loadTransporte(elem) {
            var count = $(elem).find('option').length;
            if (count > 0) {
                return;
            }

            $.ajax({
                type: 'POST',
                url: "{{ route('transportes.ajaxGetTransporte') }}",
                dataType: 'JSON',
                success: function (data) {
                    ClearTransporte(elem);
                    if (data == null) return;

                    for (i = 0; i < data.length; i++) {
                        var value = data[i].id;
                        var text = data[i].razon_social;
                        var option = "<option value='" + value + "'>" + text + "</option>";
                        $(elem).append(option);
                    }
                },
                error: function (error) {
                    console.log(error)
                    alert('Error. Check Console Log');
                },
            });
        }

        function ClearTransporte(elem) {
            $(elem).html(null).append('<option value=""></option>');
        }

        function loadPalet(elem) {
            var count = $(elem).find('option').length;
            if (count > 0) {
                return;
            }

            $.ajax({
                type: 'POST',
                url: "{{ route('pallets.ajaxGetPallets') }}",
                dataType: 'JSON',
                success: function (data) {
                    ClearPalet(elem);
                    if (data == null) return;

                    for (i = 0; i < data.length; i++) {
                        var value = data[i].id;
                        var text = data[i].modelo.modelo + " - " + data[i].formato;
                        var modelo = "data-grand";
                        if (data[i].modelo_id == 1)
                            modelo = "data-euro";
                        else
                            modelo = "data-grand";
                        var option = "<option data-modelo='" + modelo + "' value='" + value + "'>" + text +
                            "</option>";
                        $(elem).append(option);
                    }
                },
                error: function (error) {
                    console.log(error)
                    alert('Error. Check Console Log');
                },
            });
        }

        function ClearPalet(elem) {
            $(elem).html(null).append('<option value=""></option>');
        }

        function loadVariedadDetails() {
            var myUrl = "{{ route('pedidos-comercial.ajaxLoadPaletsForCaja') }}"
            $.ajax({
                type: 'POST', //THIS NEEDS TO BE GET
                url: myUrl,
                data: {
                    id: id,
                    cantidad: cantidad,
                    tipo_palet: tipo_palet,
                },
                dataType: 'json',
                success: function (data) {
                    $("#div_palets").html(null);
                    if (data.html != null) {
                        $("#div_palets").html(data.html);
                    }
                },
                error: function () {
                    console.log("Error");
                }
            });
        }

        function checkStock(id, cantidad, kilos) {
            $.ajax({
                type: 'POST', //THIS NEEDS TO BE GET
                url: '{{ route("pedidos-comercial.ajaxCheckStock") }}',
                data: {
                    id: id,
                    cantidad: cantidad,
                    kilos: kilos
                },
                dataType: 'json',
                success: function (data) {
                    $("#modal-inventario_disponible").modal('show');
                },
                error: function (e) {
                    console.log(e.responseText);
                }
            });
        }
    </script>
    {{-- Scripts para palets.blade.php --}}
    <script>
        function RemoveCard(e) {
            $(e).closest('.card').remove();
        }
    </script>
@endsection
