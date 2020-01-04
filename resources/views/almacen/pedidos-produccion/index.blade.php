@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Almacén</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Pedidos Producción</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">Pedidos Iniciados</div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="table-responsive table-responsive-sm">
                                <table class="table table-sm table-hover" id="table_iniciados" width="100%"
                                       data-select="0">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th class="text-center">Nro. Orden</th>
                                        <th>Cliente</th>
                                        <th>Producto</th>
                                        <th>Cajas</th>
                                        <th>Kilos</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($iniciados as $pedido)
                                        <tr>
                                            <td>{{ $pedido->id }}</td>
                                            <td>{{ $pedido->nro_orden }}</td>
                                            <td>{{ $pedido->cliente->razon_social }}</td>
                                            <td>{{ $pedido->variable->compuesto->cultivo->cultivo." - ".$pedido->variable->variable. " - ". $pedido->variable->caja->formato. " - " .$pedido->variable->caja->modelo }}
                                            <td>{{ $pedido->cajas }}</td>
                                            <td>{{ $pedido->kilos }}</td>
                                            <td>{{ $pedido->estado->estado }}</td>
                                            <td>
                                                <a href="javascript:void(0);"
                                                   onclick="EditPedidoProduccion({{ $pedido->id }})"
                                                   class="text-success mr-2" data-toggle="tooltip" data-placement="top"
                                                   title="" data-original-title="Editar">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="text-danger mr-2"
                                                   onclick="DeletePedido({{ $pedido->id }})" data-toggle="tooltip"
                                                   data-placement="top" title="" data-original-title="Borrar">
                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
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
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">Pedidos de la Semana</div>

                    <form action="/almacen/pedidos-produccion" method="POST" id="pedido_form">
                        {{ csrf_field() }}

                        {{--Modal Nuevo Pedido--}}
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
                                                <input type="text" name="nro_orden" id="nro_orden" class="form-control">
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
                                                                <td colspan="9"></td>
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
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Fin modal Pedido --}}
                    </form>

                    <form action="/almacen/pedidos-produccion/update" method="POST" id="edit_pedido_form">
                        {{ csrf_field('PUT') }}

                        {{-- Modal Editar Pedido --}}
                        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                             aria-hidden="true" id="modal_edit_pedido">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal_edit_pedido-title">Modificar Pedido</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_nro_orden">Nº Orden</label>
                                                <input type="text" id="edit_nro_orden" class="form-control" readonly>
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
                                                            {{ $compuesto->variable. " - ".$compuesto->caja->formato. " - ".$compuesto->caja->modelo }}
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
                                                <input type="number" id="edit_etiqueta" class="form-control"
                                                       name="etiqueta">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_pdf_pedido">Imprimir Pedido</label>
                                                <br>
                                                <a href="javascript:void(0)" target="_blank"
                                                   class="btn btn-outline-danger btn-icon m-1" id="btnPedidoPdf">
                                                    <span class="ul-btn__icon"><i class="i-File-Search"></i></span>
                                                    <span class="ul-btn__text">PDF</span>
                                                </a>
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

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Cerrar
                                        </button>
                                        <button type="submit" class="btn btn-primary" id="btnSavePedido">Guardar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Fin modal Editar Pedido --}}

                    </form>

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
                        <div class="modal-dialog modal-dialog-centered modal-lg mw-100 w-100" role="document">
                            <div class="modal-content">
                                <form action="javascript:0" id="form_inventario_disponible">

                                    <input type="hidden" name="pedido_id" id="pedido_id">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-destino_comercial-title">Inventario
                                            Disponible</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-2 text-right">
                                                <button type="button" class="btn btn-primary" id="btnAddNewStock">
                                                    Agregar
                                                </button>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="radio radio-primary">
                                                    <input type="radio" name="radio" class="radio_stock"
                                                           value="Auxiliar"
                                                           checked>
                                                    <span>Auxiliar</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="radio radio-primary">
                                                    <input type="radio" name="radio" class="radio_stock"
                                                           value="Auxiliar Palet">
                                                    <span>Auxiliar Palet</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="radio radio-primary">
                                                    <input type="radio" name="radio" class="radio_stock"
                                                           value="Tarrina">
                                                    <span>Tarrina</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3 table-responsive" style="min-height: 200px;">
                                                <table class="table table-striped table-sm" width="100%"
                                                       id="table_inventario_disponible">
                                                    <thead>
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>Descripción</th>
                                                        <th>Stock por Palet</th>
                                                        <th>Stock Real</th>
                                                        <th>Cantidad Ingresada</th>
                                                        <th>Total Salida</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar
                                        </button>
                                        <button type="submit" class="btn btn-primary" id="btnSaveStock">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{--FIN Modal isponibilidad de Partes del Producto--}}

                    <form action="/almacen/pedidos-produccion" method="GET" id="form_fecha_act">

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
                                        <span class="text-warning">Pendiente de Iniciar</span>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label class="radio radio-outline-danger">
                                        <input type="radio" class="estado" name="estado" value="2">
                                        <span class="text-danger">En Producción</span>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label class="radio radio-outline-success">
                                        <input type="radio" class="estado" name="estado" value="3">
                                        <span class="text-success">Finalizado</span>
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

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h3>{{ $dia->dia }}</h3>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <button type="button" class="btn btn-outline-danger"
                                                            onclick="ShowMaterialesDia( {{ $cultivo->id }}, {{ $dia->id }})">
                                                        Materiales
                                                    </button>
                                                </div>
                                            </div>

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
                                                            <th>Palet</th>
                                                            <th>Cantidad Palet</th>
                                                            <th>Destino</th>
                                                            <th>Transporte</th>
                                                            <th>Etiqueta</th>
                                                            <th>Comentario</th>
                                                            <th>Acciones</th>
                                                            <th>id</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($cultivo->pedidos as $pedido)
                                                            @if($pedido->dia_id == $dia->id)
                                                                @php
                                                                    $color = "";
                                                                    if($pedido->estado_id == 1){ // Pendiente
                                                                    $color = "text-warning";
                                                                    }elseif ($pedido->estado_id == 2) { // iniciado
                                                                    $color = "text-danger";
                                                                    }elseif ($pedido->estado_id == 3){ // Finalizado
                                                                    $color = "text-success";
                                                                    }
                                                                @endphp

                                                                <tr>
                                                                    <td class="{{ $color }}">{{ $pedido->nro_orden }}</td>
                                                                    <td class="{{ $color }}">{{ $pedido->cliente->razon_social }}</td>
                                                                    <td class="{{ $color }}">
                                                                        {{ $pedido->variable->compuesto->cultivo->cultivo." - ".$pedido->variable->variable. " - ". $pedido->variable->caja->formato. " - " .$pedido->variable->caja->modelo }}
                                                                    </td>
                                                                    <td class="{{ $color }}">{{ $pedido->cajas }}</td>
                                                                    <td class="{{ $color }}">{{ $pedido->kilos }}</td>
                                                                    <td class="{{ $color }}">
                                                                        {{ (is_null($pedido->pallet_id)) ? "" : $pedido->palet->modelo->modelo." - ".$pedido->palet->formato }}
                                                                    </td>
                                                                    <td class="{{ $color }}">{{ $pedido->pallet_cantidad }}</td>
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
                                                                           onclick="EditPedidoProduccion({{ $pedido->id }})"
                                                                           class="text-success mr-2"
                                                                           data-toggle="tooltip"
                                                                           data-placement="top" title=""
                                                                           data-original-title="Editar">
                                                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                                        </a>
                                                                        @if ($pedido->estado_id != 3)
                                                                            <a href="javascript:void(0);"
                                                                               onclick="DeletePedido({{ $pedido->id }})"
                                                                               class="text-danger mr-2"
                                                                               data-toggle="tooltip"
                                                                               data-placement="top" title=""
                                                                               data-original-title="Borrar">
                                                                                <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                                            </a>
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

            var error = "{{ (Session::has('error')) ? session('error') : '' }}";
            if (error != "") {
                swal('Error en guardado', error, 'error');
            }
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

        $(document).ready(function () {
            // Configuracion de Datatable
            table_pedidos = $('.table_pedidos').DataTable({
                responsive: true,
                info: false,
                paging: false,
                searching: true,
                dom: 'ltipr',
                columnDefs: [{
                    targets: [12, 13],
                    visible: false
                },
                    {
                        targets: 11,
                        sorting: false
                    },
                ]
            });

            table_iniciados = $('#table_iniciados').DataTable({
                responsive: true,
                info: true,
                paging: true,
                searching: true,
                dom: 'ltipr',
                columnDefs: [{
                    targets: 0,
                    visible: false
                },
                    {
                        targets: 7,
                        sorting: false
                    },
                ],
                order: [
                    [0, "desc"]
                ],
            });

            table_destinos = $('#table_destinos_comerciales').DataTable({
                responsive: true,
                info: false,
                paging: false
            });

            table_inventario_disponible = $('#table_inventario_disponible').DataTable({
                responsive: true,
                info: false,
                paging: false,
                searching: false,
            });

            $("#edit_pedido_form").submit(function (e) {
                //e.preventDefault();
                var estado_id = $("#edit_estado_id").val();

                if (estado_id == 3) { // Si el estado es finalizado

                    var count_stock = table_inventario_disponible.data().count();

                    if (count_stock <= 0) {
                        e.preventDefault();
                        swal("Validar Materiales",
                            "No se encontraron materiales para el pedido. Verifique el stock.",
                            "warning");
                        return;
                    }

                    var result = $("#form_inventario_disponible")[0].checkValidity();

                    if (!result) { //si la tabla de inventario no es valida
                        e.preventDefault();
                        swal("Validar Materiales Disponibles",
                            "Por favor valide las cantidades ingresadas del stock.", "warning");
                        return;
                    }
                }
            });

            $(".estado").on('change', function (e) {
                var estado = $(this).val();
                table_pedidos.tables().columns(13).search(estado).draw();
            });

            $("#buscar").on('change', function (e) {
                var valor = $(this).val();
                console.log(valor);
                table_pedidos.search(valor).draw();
            });

            $("#btnDestinoComercial").click(function (e) {
                $("#modal-destino_comercial").modal('show');
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
                    url: "{{ route('pedidos-produccion.ajaxGetDestinosComerciales') }}",
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
                            ]).draw();
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        alert('Error. Check Console Log');
                    },
                });
            });

            $("#form_inventario_disponible").submit(function (e) {
                e.preventDefault();

                var result = $(this)[0].checkValidity();

                if (result) {

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('pedidos-produccion.ajaxSaveStock') }}",
                        dataType: 'JSON',
                        data: $(this).serialize(),
                        success: function (data) {
                            if (data.error != undefined) {
                                swal('Error en Guardado', data.error, 'error');
                            } else {
                                $("#modal-inventario_disponible").modal('toggle');
                                $('#modal_edit_pedido').css('overflow-y', 'auto');
                            }
                        },
                        error: function (error) {
                            console.log(error);
                            alert('Error. Check Console Log');
                        },
                    });
                }
            });

            $("#btnCheckStock").click(function () {
                if ($("#edit_estado_id").isEnabled) $("#btnSaveStock").disable();
                $("#modal-inventario_disponible").modal('show');
            });

            $("#btnAddNewStock").click(function (e) {
                var tipo = $(".radio_stock:checked").val();
                AddNewStock(tipo);
            });

            $('#table_inventario_disponible').on('click', '.delete', function () {
                $(this).tooltip('hide');

                var current_row = $(this).parents('tr');
                if (current_row.hasClass('child')) {
                    current_row = current_row.prev();
                }

                $(this).parents('table').DataTable().row(current_row).remove().draw();

            });

            $("#table_inventario_disponible").on('changed.bs.select', '.chosen_table', function () {
                var elem = $(this);
                var selected = $(this).val();
                var tipo = $(this).closest('tr').find('input.tipo').val();
                if (selected == null || selected === "") return;

                $.ajax({
                    type: 'POST',
                    url: "{{ route('pedidos-produccion.ajaxGetInventarioForPart') }}",
                    dataType: 'JSON',
                    data: {
                        id: selected,
                        tipo: tipo,
                    },
                    success: function (data) {
                        $(elem).closest('tr').find('label.disponible').html(data.disponible);
                        $(elem).closest('tr').find('input.total').attr('max', data.disponible);
                    },
                    error: function (error) {
                        console.log(error);
                        alert('Error. Check Console Log');
                    },
                });
            });

            $("#table_inventario_disponible").on('change', '.cantidad', function () {
                var cajas = $("#edit_cajas").val();
                var cantidad = $(this).val();
                var categoria = $(this).closest('tr').find('input.tipo').val();
                var total_salida = cajas * cantidad;
                if (categoria == "Auxiliar Palet") {
                    var palets = $("#edit_cantidad_palet").val();
                    if (palets == NaN) {
                        palets = 0
                    }
                    total_salida = palets * cantidad;
                }
                $(this).closest('tr').find('input.total').val(total_salida.toFixed(2));
            });

            $("#table_inventario_disponible").on('keydown', '.total', function (e) {
                e.preventDefault();
            });
        });

        function ShowMaterialesDia(cultivo, dia) {
            var anio = $("#anio_act").val();
            var semana = $("#semana_act").val();

            var url = "{{ route('pedidos-produccion.MaterialesDia') }}?anio=" + anio + "&semana=" + semana + "&dia=" + dia + "&cultivo=" + cultivo;

            window.open(url, "_blank")
        }

        function DeletePedido(id) {
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
                window.location.href = "{{ url('almacen/pedidos-produccion/delete') }}" + "/" + id
            })
        }

        function EditPedidoProduccion(id) {
            if (id == null) return;

            $.ajax({
                type: 'POST',
                url: "{{ route('pedidos-produccion.details') }}",
                dataType: 'JSON',
                data: {
                    id: id
                },
                success: function (data) {
                    ClearModalEditPedidoProduccion();
                    if (data == null) return;

                    $("#edit_nro_orden").val(data.nro_orden);
                    $("#edit_anio").val(data.anio);
                    $("#edit_semana").val(data.semana);
                    $("#edit_cliente").val(data.cliente_id).selectpicker('refresh');
                    $("#edit_producto_id").val(data.producto_id).selectpicker('refresh');
                    $("#edit_dia").val(data.dia.dia);
                    $("#edit_cajas").val(data.cajas);
                    $("#edit_kilos").val(data.kilos);
                    $("#edit_palet_id").val(data.pallet_id);
                    $("#edit_cantidad_palet").val(data.pallet_cantidad);
                    loadDestinosForEditCliente($("#edit_destino"), data.destino_id, data.cliente_id);
                    $("#edit_transporte").val(data.transporte_id);
                    $("#edit_etiqueta").val(data.etiqueta);
                    $("#edit_comentario").val(data.comentarios);
                    $("#edit_estado_id").val(data.estado_id).change();

                    if (data.estado_id == 3) {
                        $("#edit_estado_id").attr("disabled", true);
                        $("#btnSaveStock").attr("disabled", true);
                        $("#btnSavePedido").attr("disabled", true);
                    } else {
                        $("#edit_estado_id").attr("disabled", false);
                        $("#btnSaveStock").attr("disabled", false);
                        $("#btnSavePedido").attr("disabled", false);
                    }

                    fillModalInventarioDisponible(id);

                    $("#edit_pedido_form").attr('action', '{{ url("almacen/pedidos-produccion/update") }}' +
                        "/" + id);
                    $("#form_inventario_disponible").find("#pedido_id").val(id);
                    $("#btnPedidoPdf").attr('href', '{{ url("almacen/pedidos-produccion/pdf") }}' + '/' + id);
                    $("#modal_edit_pedido").modal('show');
                },
                error: function (error) {
                    console.log(error);
                    alert('Error. Check Console Log');
                },
            });
        }

        function ClearModalEditPedidoProduccion() {
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

            var kilos = 0;
            var total_pedido = 0;
            if (cantidad > 0) {
                if ($("#EuroPallet-tab").hasClass('active')) {
                    kilos = cantidad * euro_kg;
                } else if ($("#PalletGrande").hasClass('active')) {
                    kilos = cantidad * grand_kg;
                }
            }

            $("#kilos").val(kilos);
            $("#total_pedido").val(total_pedido);
        }

        function limpiarCamposPedido() {
            $('#nro_orden, #destino_comercial, #cultivo, #formato, #etiqueta, #transporte, #kilos, #comentario, #variedad')
                .val(null);
            $("#cliente").val(null).selectpicker('refresh');
            $('#producto, #producto_compuesto, #modelo_palet, #formato_palet, #cantidad').val(null);
            $(".dias").prop("checked", false).prop('disabled', false);
            $(".chosen").trigger("chosen:updated");
        }

        function loadDestinosComerciales(valor) {
            $.ajax({
                type: 'POST',
                url: "{{ route('pedidos-produccion.ajaxGetDestinosComerciales') }}",
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
                url: "{{ route('pedidos-produccion.ajaxGetDestinosComercialesForCliente') }}",
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
                url: "{{ route('pedidos-produccion.ajaxGetDestinosComercialesForCliente') }}",
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
                        var text = data[i].variable + " - " + data[i].caja.formato + " - " + data[i].caja
                            .modelo;
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
            var myUrl = "{{ route('pedidos-produccion.ajaxLoadPaletsForCaja') }}"
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

        function fillModalInventarioDisponible(id) {
            $.ajax({
                type: 'POST', //THIS NEEDS TO BE GET
                url: "{{ route('pedidos-produccion.ajaxCheckStock') }}",
                data: {
                    id: id,
                },
                dataType: 'json',
                success: function (json) {
                    if (json != null) {

                        var cajas = $("#edit_cajas").val();
                        var palets = $("#edit_cantidad_palet").val();
                        if (palets == NaN) {
                            palets = 0
                        }

                        table_inventario_disponible.rows().remove();
                        for (i = 0; i < json.data.length; i++) {
                            var row = json.data[i];
                            var descripcion =
                                "<select name='parte[]' class='form-control chosen_table' required>";
                            var arreglo;
                            if (row.categoria == "Tarrina") {
                                arreglo = json.tarrinas;
                            } else {
                                arreglo = json.auxiliares;
                            }
                            for (a = 0; a < arreglo.length; a++) {
                                var selected = "";
                                if (arreglo[a].id == row.item_id) {
                                    selected = "selected";
                                }
                                descripcion += '<option ' + selected + ' value="' + arreglo[a].id + '">' +
                                    arreglo[a].modelo + '</option>';
                            }
                            descripcion += "</select>";
                            var options = '<a href="javascript:void(0);"\n' +
                                '                                                                           class="text-danger mr-2 delete"\n' +
                                '                                                                           data-toggle="tooltip" data-placement="top"\n' +
                                '                                                                           title=""\n' +
                                '                                                                           data-original-title="Borrar">\n' +
                                '                                                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>\n' +
                                '                                                                        </a>';
                            var total_salida = cajas * row.necesarios;
                            if (row.categoria == "Auxiliar Palet") {
                                total_salida = palets * row.necesarios;
                            }

                            table_inventario_disponible.row.add([
                                '<input type="text" class="form-control tipo" readonly name="tipo[]" value="' +
                                row.categoria + '">',
                                descripcion,
                                '<input type="number" name="inicial[]" class="form-control inicial" value="' +
                                row.default + '" step="0.01" placeholder="0.00" min="0.01" readonly/>',
                                '<label class="disponible">' + row.disponible + '</label>',
                                '<input type="number" class="form-control cantidad" name="cantidad[]" value="' +
                                row.necesarios + '" step="0.01" min="0.01"/>',
                                '<input type="number" name="total[]" class="form-control total" value="' +
                                total_salida.toFixed(2) + '" step="0.01" min="0.01" max="' + row
                                    .disponible + '"/>',
                                options
                            ]);
                        }

                        table_inventario_disponible.draw();
                        $(".chosen_table").selectpicker({
                            liveSearch: true,
                            size: 4,
                        });
                    }
                },
                error: function () {
                    console.log("Error");
                }
            });
        }

        function AddNewStock(tipo) {
            if (tipo == null || tipo == "") return;

            var url = "";
            if (tipo == "Tarrina") {
                url = "{{ route('tarrinas.ajaxGetAll') }}"
            } else {
                url = "{{ route('auxiliares.ajaxGetAll') }}"
            }

            $.ajax({
                type: 'POST', //THIS NEEDS TO BE GET
                url: url,
                dataType: 'json',
                success: function (json) {
                    if (json != null) {
                        var row = json;
                        var descripcion =
                            "<select name='parte[]' class='form-control chosen_table' required><option value=''></option>";
                        for (a = 0; a < json.length; a++) {
                            descripcion += '<option value="' + json[a].id + '">' + json[a].modelo + '</option>';
                        }
                        descripcion += "</select>";
                        var options = '<a href="javascript:void(0);"\n' +
                            '                                                                           class="text-danger mr-2 delete"\n' +
                            '                                                                           data-toggle="tooltip" data-placement="top"\n' +
                            '                                                                           title=""\n' +
                            '                                                                           data-original-title="Borrar">\n' +
                            '                                                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>\n' +
                            '                                                                        </a>';
                        table_inventario_disponible.row.add([
                            '<input type="text" class="form-control tipo" readonly name="tipo[]" value="' +
                            tipo + '">',
                            descripcion,
                            '<input type="number" name="inicial[]" class="form-control inicial" value="" step="0.01" placeholder="0.00" min="0.01" readonly/>',
                            '<label class="disponible">-</label>',
                            '<input type="number" name="cantidad[]" class="form-control cantidad" value="0" step="0.01" placeholder="0.00" min="0.01"/>',
                            '<input type="number" name="total[]" class="form-control total" value="0" step="0.01" placeholder="0.00" min="0.01"/>',
                            options
                        ]);
                        table_inventario_disponible.draw();
                        $(".chosen_table").selectpicker({
                            liveSearch: true,
                            size: 4,
                        });
                    }
                },
                error: function () {
                    console.log("Error");
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
