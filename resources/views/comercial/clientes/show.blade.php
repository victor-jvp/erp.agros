@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Comercial</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Clientes</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Cliente: <b>{{ $cliente->razon_social }}</b></h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="datos-fiscales-tab" data-toggle="tab" href="#datos-fiscales"
                               role="tab"
                               aria-controls="datos-fiscales" aria-selected="false">Datos Fiscales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contactos-tab" data-toggle="tab" href="#contactos" role="tab"
                               aria-controls="pallets" aria-selected="false">Contactos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="destinos-tab" data-toggle="tab" href="#destinos" role="tab"
                               aria-controls="pallets" aria-selected="false">Destinos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="historico-pedidos-tab" data-toggle="tab" href="#historico-pedidos"
                               role="tab" aria-controls="pallets" aria-selected="false">Histórico de Pedidos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contactar-email-tab" data-toggle="tab" href="#contactar-email"
                               role="tab" aria-controls="pallets" aria-selected="false">Contactar via Email</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="documentacion-tab" data-toggle="tab" href="#documentacion"
                               role="tab"
                               aria-controls="pallets" aria-selected="false">Documentación</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="datos-fiscales" role="tabpanel"
                             aria-labelledby="datos-fiscales-tab">
                            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST"
                                  id="datos_comerciales_form">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" name="_tab" value="datos-fiscales">
                                <input type="hidden" name="id" id="id" value="{{ $cliente->id }}">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="cif">CIF</label>
                                        <input type="text" class="form-control" id="cif" value="{{ $cliente->cif }}"
                                               placeholder="CIF" name="cif">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="razon_social">Razón Social</label>
                                        <input type="text" class="form-control" id="razon_social"
                                               value="{{ $cliente->razon_social }}" placeholder="Razón Social"
                                               name="razon_social">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nombre_comercial">Nombre Comercial</label>
                                        <input type="text" class="form-control" id="nombre_comercial"
                                               value="{{ $cliente->nombre_comercial }}" placeholder="Nombre Comercial"
                                               name="nombre_comercial">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="pais">País</label>
                                        <input type="text" class="form-control" id="pais" value="{{ $cliente->pais }}"
                                               placeholder="País" name="pais">
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label for="localidad">Localidad</label>
                                        <input type="text" class="form-control" id="localidad"
                                               value="{{ $cliente->localidad }}" placeholder="Localidad"
                                               name="localidad">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="provincia">Provincia</label>
                                        <input type="text" class="form-control" id="provincia"
                                               value="{{ $cliente->provincia }}" placeholder="País" name="provincia">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="direccion">Direccion</label>
                                        <input type="text" class="form-control" id="direccion"
                                               value="{{ $cliente->direccion }}" placeholder="Direccion"
                                               name="direccion">
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono"
                                               value="{{ $cliente->telefono }}" placeholder="Teléfono" name="telefono">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" value="{{ $cliente->email }}"
                                               placeholder="Email" name="email">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <button class="btn btn-primary" type="submit">Guardar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="contactos" role="tabpanel" aria-labelledby="contactos-tab">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <button class="btn btn-primary" type="button" id="btnNuevoContacto">Nuevo</button>
                                </div>
                            </div>

                            <!-- Modal Contactos-->
                            <div class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle"
                                 aria-hidden="true" id="modal-contacto">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="/comercial/clientes/{{$cliente->id}}/contactos" method="POST"
                                              id="contacto_form">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_tab" value="contactos">
                                            <input type="hidden" name="contacto_id" value="" id="contacto_id">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-contacto-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="contacto_descripcion">Descripcion</label>
                                                        <input type="text" class="form-control"
                                                               id="contacto_descripcion"
                                                               name="descripcion">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="contacto_telefono">Teléfono</label>
                                                        <input type="text" class="form-control" id="contacto_telefono"
                                                               name="telefono">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label for="contacto_telefono">Email</label>
                                                        <input type="email" class="form-control" id="contacto_email"
                                                               name="email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Cerrar
                                                </button>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table id="contactos_table" class="display table table-striped table-bordered"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Teléfono</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (isset($cliente->contactos))
                                            @foreach ($cliente->contactos as $contacto)
                                                <tr>
                                                    <td>{{ $contacto->id }}</td>
                                                    <td>{{ $contacto->descripcion }}</td>
                                                    <td>{{ $contacto->telefono }}</td>
                                                    <td>{{ $contacto->email }}</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="text-success mr-2 edit">
                                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="text-danger mr-2 delete">
                                                            <i class="nav-icon i-Close-Window font-weight-bold "></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="destinos" role="tabpanel" aria-labelledby="destinos-tab">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <button class="btn btn-primary" type="button" id="btnNuevoDestino">Nuevo</button>
                                </div>
                            </div>

                            <!-- Modal Destinos-->
                            <div class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle"
                                 aria-hidden="true" id="modal-destino">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="/comercial/clientes/{{$cliente->id}}/destinos" method="POST"
                                              id="destino_form">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_tab" value="destinos">
                                            <input type="hidden" name="destino_id" value="" id="destino_id">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-destino-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="destino_descripcion">Descripcion</label>
                                                        <input type="text" class="form-control" id="destino_descripcion"
                                                               name="descripcion" required>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="destino_direccion">Direccion</label>
                                                        <input type="text" class="form-control" id="destino_direccion"
                                                               name="direccion">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label for="destino_poblacion">Poblacion</label>
                                                        <input type="text" class="form-control" id="destino_poblacion"
                                                               name="poblacion">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="destino_ciudad">Ciudad</label>
                                                        <input type="text" class="form-control" id="destino_ciudad"
                                                               name="ciudad">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label for="destino_pais">Pais</label>
                                                        <input type="text" class="form-control" id="destino_pais"
                                                               name="pais">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Cerrar
                                                </button>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table id="destinos_table" class="display table table-striped table-bordered"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Direccion</th>
                                            <th scope="col">Poblacion</th>
                                            <th scope="col">Ciudad</th>
                                            <th scope="col">Pais</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (isset($cliente->destinos))
                                            @foreach ($cliente->destinos as $destino)
                                                <tr>
                                                    <td>{{ $destino->id }}</td>
                                                    <td>{{ $destino->descripcion }}</td>
                                                    <td>{{ $destino->direccion }}</td>
                                                    <td>{{ $destino->poblacion }}</td>
                                                    <td>{{ $destino->ciudad }}</td>
                                                    <td>{{ $destino->pais }}</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="text-success mr-2 edit">
                                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="text-danger mr-2 delete">
                                                            <i class="nav-icon i-Close-Window font-weight-bold "></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="historico-pedidos" role="tabpanel"
                             aria-labelledby="historico-pedidos-tab">

                            <div class="row">
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

                                <div class="col-md-3 form-group mb-3">
                                    <label>Fecha Desde</label>
                                    <input type="date" class="form-control" id="desde">
                                </div>
                                <div class="col-md-3 form-group mb-3">
                                    <label>Fecha Hasta</label>
                                    <input type="date" class="form-control" id="hasta">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3 table-responsive">
                                    <table class="table table-condensed table-striped table-sm"
                                           id="table_pedidos_produccion" width="100%">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>fecha_orden</th>
                                            <th>Nº Orden</th>
                                            <th>estado_id</th>
                                            <th>Estado</th>
                                            <th>Producto Compuesto</th>
                                            <th class="sum">Cajas</th>
                                            <th class="sum">Kilos</th>
                                            <th>Precio</th>
                                            <th>Palet</th>
                                            <th class="sum">Cantidad Palet</th>
                                            <th>Destino</th>
                                            <th>Transporte</th>
                                            <th class="sum">Total €</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($cliente->pedidos as $pedido)
                                            <tr>
                                                @php
                                                    $color = "";
                                                    if($pedido->estado_id == 1){ // En espera
                                                    $color = "text-warning";
                                                    }elseif ($pedido->estado_id == 3) { // Confirmado
                                                    $color = "text-danger";
                                                    }elseif ($pedido->estado_id == 2){ // Cancelado
                                                    $color = "text-success";
                                                    }
                                                @endphp
                                                <td>{{ $pedido->id }}</td>
                                                <td>{{ $pedido->fecha_orden }}</td>
                                                <td class="{{ $color }}">{{ $pedido->nro_orden }}</td>
                                                <td>{{ $pedido->estado_id }}</td>
                                                <td class="{{ $color }}">{{ $pedido->estado->estado }}</td>
                                                <td class="{{ $color }}">{{ $pedido->variable->compuesto->cultivo->cultivo." - ".$pedido->variable->variable. " - ". $pedido->variable->caja->formato. " - " .$pedido->variable->caja->modelo }}</td>
                                                <td class="{{ $color }}">{{ $pedido->cajas }}</td>
                                                <td class="{{ $color }}">{{ $pedido->kilos }}</td>
                                                <td class="{{ $color }}">{{ $pedido->precio }}</td>
                                                <td class="{{ $color }}">{{ (is_null($pedido->pallet_id)) ? "" : $pedido->palet->modelo->modelo." - ".$pedido->palet->formato }}</td>
                                                <td class="{{ $color }}">{{ $pedido->pallet_cantidad }}</td>
                                                <td class="{{ $color }}">{{ (is_null($pedido->destino_id)) ? "" : $pedido->destino->descripcion }}</td>
                                                <td class="{{ $color }}">{{ (is_null($pedido->transporte_id)) ? "" : $pedido->transporte->razon_social }}</td>
                                                <td class="{{ $color }}">{{ $pedido->kilos * $pedido->precio }}</td>
                                                <td>
                                                    <a href="javascript:void(0);"
                                                       onclick="EditarPedido({{ $pedido->id }})"
                                                       class="text-success mr-2"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title=""
                                                       data-original-title="Editar">
                                                        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr class="text-right">
                                            <th colspan="6"><b>Totales</b></th>
                                            <th></th>
                                            <th></th>
                                            <th colspan="2"></th>
                                            <th></th>
                                            <th colspan="2"></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            {{-- Modal Editar Pedido --}}
                            <div class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle"
                                 aria-hidden="true" id="modal_edit_pedido">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal_edit_pedido-title">Ver Pedido</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="edit_nro_orden">Nº Orden</label>
                                                    <input type="text" id="edit_nro_orden" class="form-control"
                                                           readonly>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label for="edit_anio">Año</label>
                                                    <input type="text" id="edit_anio" class="form-control" readonly>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label for="edit_semana">Semana</label>
                                                    <input type="text" id="edit_semana" class="form-control" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="edit_cliente">Cliente</label>
                                                    <input type="text" id="edit_cliente" class="form-control" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="anio">Dia</label>
                                                    <input type="text" id="edit_dia" class="form-control" readonly>
                                                </div>
                                                <div class="col-md-8 mb-3">
                                                    <label for="edit_producto_id">Producto Compuesto</label>
                                                    <input type="text" class="form-control" id="edit_producto_id"
                                                           readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="edit_cajas">Cajas</label>
                                                    <input type="number" id="edit_cajas" class="form-control" step="1"
                                                           readonly>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="edit_kilos">Kilos</label>
                                                    <input type="number" id="edit_kilos" class="form-control"
                                                           readonly="" step="0.01">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="edit_precio">€/Kg</label>
                                                    <input type="number" id="edit_precio" class="form-control"
                                                           step="0.01" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="palet">Palet</label>
                                                    <input type="text" id="edit_palet_id" class="form-control" readonly>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="cantidad_palet">Cant. Palet</label>
                                                    <input type="number" id="edit_cantidad_palet"
                                                           class="form-control" readonly step="1">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="destino">Destino</label>
                                                    <input type="text" class="form-control" id="edit_destino" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="edit_transporte">Transporte</label>
                                                    <input type="text" id="edit_transporte" class="form-control"
                                                           readonly="">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="etiqueta">Etiqueta</label>
                                                    <input type="text" id="edit_etiqueta" class="form-control" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label for="transporte">Comentario</label>
                                                    <textarea class="form-control" readonly=""
                                                              id="edit_comentario"
                                                              rows="4"></textarea>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-3">
                                                            <label for="estado">Estado</label>
                                                            <input type="text" id="edit_estado_id" class="form-control"
                                                                   readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" id="div_cancelar">
                                                <div class="col-md-8 mb-3">
                                                    <label for="transporte">Comentario de Cancelación</label>
                                                    <textarea class="form-control" readonly=""
                                                              id="edit_cancelado_comentario" rows="4"></textarea>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="cancelado_id">Motivo de Cancelación</label>
                                                    <input type="text" id="edit_cancelado_id" class="form-control"
                                                           readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Cerrar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Fin modal Editar Pedido --}}
                        </div>

                        <div class="tab-pane fade" id="contactar-email" role="tabpanel"
                             aria-labelledby="contactar-email-tab">

                            <form action="/comercial/clientes/ajaxSendEmail" method="POST" id="email_form">

                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="exampleInputEmail2">Email</label>
                                        <input type="email" class="form-control form-control-rounded" readonly
                                               name="email"
                                               id="exampleInputEmail2" placeholder="No se ha registrado Email"
                                               value="{{ $cliente->email }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                        <textarea class="form-control" placeholder="Ingrese su mensaje" name="message"
                                                  id="message" cols="30" rows="3"></textarea>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-grow-1"></div>
                                            <button title="Enviar Email" data-toggle="tooltip" data-placement="top"
                                                    title=""
                                                    data-original-title="Enviar Email"
                                                    class="btn btn-icon btn-rounded btn-primary mr-2"
                                                {{ (empty($cliente->email)) ? "disabled" : "" }}>
                                                <i class="i-Paper-Plane"></i>
                                            </button>
                                        </div>

                                    </div>
                                </div>

                            </form>

                        </div>

                        <div class="tab-pane fade" id="documentacion" role="tabpanel"
                             aria-labelledby="documentacion-tab">

                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <button class="btn btn-primary" type="button" id="btnNuevoAdjunto">Nuevo</button>
                                </div>
                            </div>

                            <!-- Modal entradas-->
                            <div class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle"
                                 aria-hidden="true" id="modal-adjunto">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="/comercial/clientes/{{$cliente->id}}/adjuntos" method="POST"
                                              id="adjunto_form" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_tab" value="documentacion">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-adjunto-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-4 mb-3">
                                                        <label for="adjunto_fecha">Fecha</label>
                                                        <input type="date" class="form-control" id="adjunto_fecha"
                                                               value="{{ date('Y-m-d') }}" placeholder="Fecha"
                                                               name="fecha">
                                                    </div>

                                                    <div class="col-md-8 mb-3">
                                                        <label for="adjunto_descripcion">Descripcion</label>
                                                        <input type="text" class="form-control" id="adjunto_descripcion"
                                                               name="descripcion">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <div class="card text-left">
                                                            <div class="card-body">
                                                                <h4 class="card-title">Adjuntar</h4>
                                                                <input type="file" name="file"/>
                                                            </div>
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
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table id="adjuntos_table" class="display table table-striped table-bordered"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col">Accion</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (isset($cliente->adjuntos))
                                            @foreach ($cliente->adjuntos as $adjunto)
                                                <tr>
                                                    <td>{{ $adjunto->id }}</td>
                                                    <td>{{ $adjunto->fecha }}</td>
                                                    <td>
                                                        <a href="{{ url($adjunto->file) }}">{{ $adjunto->descripcion }}</a>
                                                    </td>
                                                    <td>{{ $adjunto->tipo }}</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="text-danger mr-2 delete">
                                                            <i class="nav-icon i-Close-Window font-weight-bold "></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of col -->
    </div>
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/chosen-bootstrap-4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/bootstrap-select.min.css')}}">

@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/chosen.jquery.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-select/i18n/defaults-es_ES.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/calendar/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('assets/js/tooltip.script.js')}}"></script>

    <script>
        $(document).ready(function () {
            var tab = '{{ $tab }}';
            $("#" + tab + "").addClass('active show');
            $("#" + tab + "-tab").addClass('active show').attr('aria-selected', true);
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    {{--Contacto--}}
    <script>
        var contactos_table;

        $(document).ready(function () {
            // Configuracion de Datatable
            contactos_table = $('#contactos_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [{
                    targets: [0],
                    visible: false
                },],
                responsive: true,
                order: [
                    [1, 'desc']
                ]
            });

            $("#btnNuevoContacto").click(function (e) {
                LimpiarCamposContactos();
                $("#modal-contacto-title").html("Nuevo Contacto");
                $("#modal-contacto").modal('show');
            });

            $('#contactos_table .edit').on('click', function () {
                LimpiarCamposContactos();
                var tr = $(this).closest('tr');
                var row = contactos_table.row(tr).data();
                console.log(row);

                $("#contacto_id").val(row[0]);
                $("#contacto_descripcion").val(row[1]);
                $("#contacto_telefono").val(row[2]);
                $("#contacto_email").val(row[3]);

                $("#modal-contacto-title").html("Modificar Contacto");
                $("#modal-contacto").modal('show');
            });

            $('#contactos_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = contactos_table.row(tr).data();

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
                    window.location.href = "{{ url('comercial/clientes/delete-contacto') }}" + "/" +
                        row[0]
                });
            });
        });

        function LimpiarCamposContactos() {
            $("#contacto_id, #contacto_descripcion, #contacto_telefono, #contacto_email, #contacto_method").val(null);
        }
    </script>

    {{--Destinos--}}
    <script>
        var destinos_table;

        $(document).ready(function () {
            // Configuracion de Datatable
            destinos_table = $('#destinos_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [{
                    targets: [0],
                    visible: false
                },],
                responsive: true,
                order: [
                    [1, 'desc']
                ]
            });

            $("#btnNuevoDestino").click(function (e) {
                LimpiarCamposDestinos();
                $("#modal-destino-title").html("Nuevo Destino");
                $("#modal-destino").modal('show');
            });

            $('#destinos_table .edit').on('click', function () {
                LimpiarCamposDestinos();
                var tr = $(this).closest('tr');
                var row = destinos_table.row(tr).data();

                $("#destino_id").val(row[0]);
                $("#destino_descripcion").val(row[1]);
                $("#destino_direccion").val(row[2]);
                $("#destino_poblacion").val(row[3]);
                $("#destino_ciudad").val(row[4]);
                $("#destino_pais").val(row[5]);

                $("#modal-destino-title").html("Modificar Destino");
                $("#modal-destino").modal('show');
            });

            $('#destinos_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = destinos_table.row(tr).data();

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
                    window.location.href = "{{ url('comercial/clientes/delete-destino') }}" + "/" +
                        row[0]
                });
            });
        });

        function LimpiarCamposDestinos() {
            $("#destino_id, #destino_descripcion, #destino_direccion, #destino_poblacion, #destino_ciudad, #destino_pais, #destino_method")
                .val(null);
        }
    </script>

    {{-- Historico Pedidos --}}
    <script>
        function formatNumber(n) {
            n = String(n).replace(/\D/g, "");
            return n === '' ? n : Number(n).toLocaleString();
        }

        function EditarPedido(id) {
            if (id == null) return;

            $.ajax({
                type: 'POST',
                url: "{{ route('pedidos-comercial.details') }}",
                dataType: 'JSON',
                data: {
                    id: id
                },
                success: function (data) {
                    $("#modal_edit_pedido > input").val(null);
                    if (data == null) return;

                    $("#edit_pedido_id").val(id);
                    $("#edit_nro_orden").val(data.nro_orden);
                    $("#edit_anio").val(data.anio);
                    $("#edit_semana").val(data.semana);
                    $("#edit_cliente_id").val(data.cliente_id);
                    $("#edit_cliente").val(data.cliente.razon_social);
                    $("#edit_producto_id").val(data.variable.variable + " - " + data.variable.caja.formato + " - " + data.variable.caja.modelo);
                    $("#edit_dia").val(data.dia.dia);
                    $("#edit_cajas").val(data.cajas);
                    $("#edit_kilos").val(data.kilos);
                    $("#edit_precio").val(data.precio);
                    $("#edit_palet_id").val(data.palet.formato);
                    $("#edit_cantidad_palet").val(data.pallet_cantidad);
                    if (data.destino == null) {
                        $("#edit_destino").val(null);
                    } else {
                        $("#edit_destino").val(data.destino.descripcion);
                    }
                    if (data.transporte == null) {
                        $("#edit_transporte").val(null);
                    } else {
                        $("#edit_transporte").val(data.transporte.razon_social);
                    }
                    $("#edit_etiqueta").val(data.etiqueta);
                    $("#edit_comentario").val(data.comentarios);
                    $("#edit_estado_id").val(data.estado.estado);

                    $("#edit_cancelado_id").val(data.cancelado_id);
                    $("#edit_cancelado_comentario").val(data.cancelado_coment);
                    if (data.estado_id == 3) {
                        $("#div_cancelar").fadeIn();
                    } else {
                        $("#div_cancelar").fadeOut();
                    }

                    $("#modal_edit_pedido").modal('show');
                },
                error: function (error) {
                    console.log(error);
                    alert('Error. Check Console Log');
                },
            });
        }

        $(document).ready(function () {

            //$.fn.dataTable.moment( 'DD/MM/YYYY' );

            jQuery.fn.dataTable.Api.register('sum()', function () {
                return this.flatten().reduce(function (a, b) {
                    if (typeof a === 'string') {
                        a = a.replace(/[^\d.-]/g, '') * 1;
                    }
                    if (typeof b === 'string') {
                        b = b.replace(/[^\d.-]/g, '') * 1;
                    }

                    return a + b;
                }, 0);
            });

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $("#desde").val();
                    var max = $("#hasta").val();
                    var fecha = data[1];

                    var startDate = moment(min, "YYYY-MM-DD");
                    var endDate = moment(max, "YYYY-MM-DD");
                    var diffDate = moment(fecha, "YYYY-MM-DD");

                    if (
                        (min == "" || max == "")
                        ||
                        (diffDate.isBetween(startDate, endDate, null, '[]'))
                    ) {
                        return true;
                    }
                    return false;
                }
            );


            // Configuracion de Datatable
            table_pedidos_produccion = $('#table_pedidos_produccion').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [{
                    targets: [0, 1, 3],
                    visible: false
                },],
                responsive: true,
                order: [
                    [0, 'desc']
                ],
                footerCallback: function (row, data, start, end, display) {
                    var api = this.api();
                    api.columns('.sum', {
                        page: 'current'
                    }).every(function () {
                        var sum = this
                            .data()
                            .reduce(function (a, b) {
                                var intVal = function (i) {
                                    return typeof i === 'string' ?
                                        i.replace(/[\$,]/g, '') * 1 :
                                        typeof i === 'number' ?
                                            i : 0;
                                };
                                return intVal(a) + intVal(b);
                            }, 0);
                        var signo = "";
                        if (sum < 0) signo = "-";
                        $(this.footer()).html(signo + sum.toFixed(2));
                    });
                }
            });

            $(".estado").on('change', function (e) {
                var estado = $(this).val();
                table_pedidos_produccion.columns(3).search(estado).draw(false);
            });

            $("#desde, #hasta").on("change", function (e) {
                table_pedidos_produccion.draw(false);
            });


        });
    </script>

    {{-- Enviar Email --}}
    <script>
        $(function () {
            $("#email_form").submit(function (e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');

                swal({
                    title: 'Enviando...',
                    text: 'Por favor espere.',
                    //imageUrl: "{{ asset('assets/images/loader.gif') }}",
                    html: '<div class="spinner-bubble spinner-bubble-primary m-5"></div>',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: 'JSON',
                    data: form.serialize(),
                    success: function (data) {
                        swal(data.title, data.message, data.type);
                    },
                    error: function (error) {
                        swal(error.title, error.message, error.type);
                        console.log(error); // show response from the php script.
                    }
                });

            });
        })
    </script>

    {{--Documentos adjuntos--}}
    <script>
        var adjuntos_table;

        $(document).ready(function () {
            // Configuracion de Datatable
            adjuntos_table = $('#adjuntos_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [{
                    targets: [0],
                    visible: false
                },],
                responsive: true,
                order: [
                    [1, 'desc']
                ]
            });

            $("#btnNuevoAdjunto").click(function (e) {
                $("#modal-adjunto-title").html("Nuevo Adjunto");
                $("#modal-adjunto").modal('show');
            });

            $('#adjuntos_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = adjuntos_table.row(tr).data();

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
                    window.location.href = "{{ url('comercial/clientes/delete-adjunto') }}" + "/" +
                        row[0]
                });
            });
        });
    </script>
@endsection
