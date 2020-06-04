@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Agro Alfaro</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Entradas</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Entradas</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}

                    <div class="row">
                        @can('AgroAlfaro - Entradas | Crear')
                            <div class="col-md-3">
                                <button class="btn btn-primary" type="button" id="btnNuevo">Nuevo</button>
                            </div>
                        @endcan
                    </div>

                    <!-- Modal Detalles Entrada-->
                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                         aria-hidden="true" id="modal-entrada">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="/agroAlfaro/entradas/store" method="POST" id="entrada_form">
                                    @csrf
                                    <input type="hidden" name="entrada_id" id="entrada_id">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-entrada-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="fecha">Fecha</label>
                                                <input type="date" class="form-control" id="fecha" name="fecha"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="traza">Traza de Entrada</label>
                                                <input type="text" class="form-control" id="traza" readonly
                                                       name="traza" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="albaran">Albarán</label>
                                                <input type="text" class="form-control" id="albaran"
                                                       placeholder="Albarán"
                                                       name="albaran">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="proveedor">Proveedor</label>
                                                <select name="proveedor_id" id="proveedor" class="form-control chosen"
                                                        required>
                                                    <option value=""></option>
                                                    @foreach ($proveedores as $proveedor)
                                                        <option value="{{ $proveedor->id }}">{{ $proveedor->proveedor }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="producto">Producto</label>
                                                <select name="producto_id" id="producto" class="form-control chosen"
                                                        required>
                                                    <option value=""></option>
                                                    @foreach ($compuestos as $compuesto)
                                                        <option value="{{ $compuesto->id }}">
                                                            {{ $compuesto->compuesto->cultivo->cultivo. " - ".$compuesto->compuesto->compuesto. " - ".$compuesto->variable }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="cantidad">Kilos</label>
                                                <input type="number" class="form-control" id="cantidad" name="cantidad"
                                                       required placeholder="Kilos" min="0.01" step="0.01">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="variedad">Variedad</label>
                                                <input type="text" class="form-control" id="variedad"
                                                       placeholder="Variedad"
                                                       name="variedad">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Cerrar
                                        </button>
                                        @can('AgroAlfaro - Entradas | Crear')
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        @endcan
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{--Modal Salidas--}}
                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                         aria-hidden="true" id="modal-salida">
                        <div class="modal-dialog modal-lg mw-100 w-100">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-salida-title"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active show" id="table-salidas-tab" data-toggle="tab"
                                               href="#table-salidas" role="tab" aria-controls="table-salidas"
                                               aria-selected="false">Salidas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="new-salida-tab" data-toggle="tab" href="#new-salida"
                                               role="tab" aria-controls="pallets" aria-selected="false">Nueva</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade active show" id="table-salidas" role="tabpanel"
                                             aria-labelledby="table-salidas-tab">

                                            <div class="row">
                                                <div class="col-md-3 mb-0">
                                                    <button type="submit" class="btn btn-primary" data-toggle="tooltip"
                                                            id="btnGenerarMerma" data-placement="auto"
                                                            title="Generar Merma con Cantidad Disponible"
                                                            data-original-title="Generar Merma con Cantidad Disponible">
                                                        Merma
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-3 table-responsive">
                                                    <table id="salidas_table"
                                                           class="display table table-striped table-bordered"
                                                           style="width:100%">
                                                        <thead>
                                                        <tr>
                                                            <th>id</th>
                                                            <th scope="col">Traza Salida</th>
                                                            <th scope="col">Fecha</th>
                                                            <th>proveedor_id</th>
                                                            <th scope="col">Proveedor</th>
                                                            <th>producto_id</th>
                                                            <th scope="col">Producto</th>
                                                            <th scope="col">Cajas</th>
                                                            <th scope="col">Kilos</th>
                                                            <th scope="col">Precio Venta</th>
                                                            <th>cliente_id</th>
                                                            <th scope="col">Cliente</th>
                                                            <th scope="col">Coste</th>
                                                            <th scope="col">Comisión</th>
                                                            <th scope="col">Precio Liquidación</th>
                                                            <th>ECO</th>
                                                            <th scope="col">Pagada</th>
                                                            <th scope="col">Acciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="new-salida" role="tabpanel"
                                             aria-labelledby="new-salida-tab">

                                            <form action="/agroAlfaro/salidas/store" method="POST" id="salida_form">
                                                @csrf
                                                <input type="hidden" name="entrada_id" id="salida_entrada_id">
                                                <input type="hidden" name="salida_id" id="salida_id">

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="salida_traza">Traza</label>
                                                        <input type="text" class="form-control" id="salida_traza"
                                                               placeholder="Traza Salida" readonly name="traza">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="salida_fecha">Fecha</label>
                                                        <input type="date" class="form-control" id="salida_fecha"
                                                               value="{{ date('Y-m-d') }}" placeholder="Fecha"
                                                               required=""
                                                               name="fecha">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="salida_proveedor">Proveedor</label>
                                                        <select name="proveedor_id" id="salida_proveedor" required
                                                                class="form-control chosen">
                                                            <option value=""></option>
                                                            @foreach ($proveedores as $proveedor)
                                                                <option
                                                                    value="{{ $proveedor->id }}">{{ $proveedor->proveedor }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="salida_producto">Producto</label>
                                                        <select name="producto_id" id="salida_producto"
                                                                class="form-control chosen" required>
                                                            <option value=""></option>
                                                            @foreach ($compuestos as $compuesto)
                                                                <option value="{{ $compuesto->id }}">
                                                                    {{ $compuesto->compuesto->cultivo->cultivo. " - ".$compuesto->compuesto->compuesto. " - ".$compuesto->variable }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="salida_cliente">Cliente</label>
                                                        <select name="cliente_id" id="salida_cliente" required
                                                                class="form-control chosen">
                                                            <option value=""></option>
                                                            @foreach ($clientes as $cliente)
                                                                <option
                                                                    value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="salida_cajas">Cajas</label>
                                                        <input type="number" class="form-control" id="salida_cajas"
                                                               placeholder="Cajas" name="cajas" step="0.01">
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="salida_cantidad">Kilos</label>
                                                        <input type="number" class="form-control" id="salida_cantidad"
                                                               required name="cantidad" placeholder="Kilos" min="0.01"
                                                               step="0.01">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="salida_precio">Precio Venta</label>
                                                        <input type="number" class="form-control" id="salida_precio"
                                                               required placeholder="Precio Venta" name="precio"
                                                               step="0.01">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="salida_coste">Coste</label>
                                                        <input type="number" class="form-control" id="salida_coste"
                                                               placeholder="Coste" name="coste" step="0.01">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="salida_comision">Comisión</label>
                                                        <input type="number" class="form-control" id="salida_comision"
                                                               placeholder="Comisión" name="comision" step="0.01">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="salida_precio_liquidacion">Precio
                                                            Liquidación</label>
                                                        <input type="number" class="form-control"
                                                               id="salida_precio_liquidacion"
                                                               placeholder="Precio Liquidación"
                                                               name="precio_liquidacion" readonly step="0.01">
                                                    </div>
                                                    <div class="col-md-3 mb-3 mt-4">
                                                        <label class="checkbox checkbox-primary">
                                                            <input type="checkbox" id="salida_eco" name="eco">
                                                            <span>ECO</span>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-3 mb-3 mt-4">
                                                        <label class="checkbox checkbox-primary">
                                                            <input type="checkbox" id="salida_pagada" name="pagada">
                                                            <span>Pagada</span>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>

                                                @can('AgroAlfaro - Salidas | Crear')
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <button type="submit" class="btn btn-primary">
                                                                Guardar
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endcan
                                            </form>


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

                    {{--Modal Modificar Salida--}}
                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                         aria-hidden="true" id="modal-edit-salida">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="/agroAlfaro/salidas/store" method="POST" id="m_salida_form">
                                    @csrf
                                    <input type="hidden" name="salida_id" id="m_salida_id">
                                    <input type="hidden" name="entrada_id" id="m_salida_entrada_id">
                                    <input type="hidden" name="return_to" value="tz.entradas.index">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-edit-salida-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="m_salida_">Traza</label>
                                                <input type="text" class="form-control" id="m_salida_traza"
                                                       placeholder="Traza Salida" required="" name="traza">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="m_salida_fecha">Fecha</label>
                                                <input type="date" class="form-control" id="m_salida_fecha"
                                                       placeholder="Fecha" required="" name="fecha">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="m_salida_proveedor">Proveedor</label>
                                                <select name="proveedor_id" id="m_salida_proveedor" required
                                                        class="form-control chosen">
                                                    <option value=""></option>
                                                    @foreach ($proveedores as $proveedor)
                                                        <option value="{{ $proveedor->id }}">{{ $proveedor->proveedor }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="m_salida_producto">Producto</label>
                                                <select name="producto_id" id="m_salida_producto"
                                                        class="form-control chosen" required>
                                                    <option value=""></option>
                                                    @foreach ($compuestos as $compuesto)
                                                        <option value="{{ $compuesto->id }}">
                                                            {{ $compuesto->compuesto->cultivo->cultivo. " - ".$compuesto->compuesto->compuesto. " - ".$compuesto->variable }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="m_salida_cliente">Cliente</label>
                                                <select name="cliente_id" id="m_salida_cliente"
                                                        class="form-control chosen">
                                                    <option value=""></option>
                                                    @foreach ($clientes as $cliente)
                                                        <option
                                                            value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="m_salida_cajas">Cajas</label>
                                                <input type="number" class="form-control" id="m_salida_cajas"
                                                       placeholder="Cajas" name="cajas" step="0.01">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="m_salida_cantidad">Kilos</label>
                                                <input type="number" class="form-control" id="m_salida_cantidad"
                                                       required
                                                       name="cantidad" placeholder="Kilos" step="0.01">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="m_salida_precio">Precio Venta</label>
                                                <input type="number" class="form-control" id="m_salida_precio"
                                                       placeholder="Precio Venta" name="precio" step="0.01">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="m_salida_coste">Coste</label>
                                                <input type="number" class="form-control" id="m_salida_coste"
                                                       placeholder="Coste" name="coste" step="0.01">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="m_salida_comision">Comisión</label>
                                                <input type="number" class="form-control" id="m_salida_comision"
                                                       placeholder="Comisión" name="comision" step="0.01">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="m_salida_precio_liquidacion">Precio Liquidación</label>
                                                <input type="number" class="form-control"
                                                       id="m_salida_precio_liquidacion"
                                                       placeholder="Precio Liquidación" name="precio_liquidacion"
                                                       readonly
                                                       step="0.01">
                                            </div>
                                            <div class="col-md-3 mb-3 mt-4">
                                                <label class="checkbox checkbox-primary">
                                                    <input type="checkbox" id="m_salida_eco" name="eco">
                                                    <span>ECO</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-3 mb-3 mt-4">
                                                <label class="checkbox checkbox-primary">
                                                    <input type="checkbox" id="m_salida_pagada" name="pagada">
                                                    <span>Pagada</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Cerrar
                                        </button>
                                        @can('AgroAlfaro - Salidas | Crear')
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        @endcan
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="entradas_table" class="display table table-striped table-bordered"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Albarán</th>
                                        <th scope="col">Traza Entrada</th>
                                        <th>proveedor_id</th>
                                        <th scope="col">Proveedor</th>
                                        <th>producto_id</th>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Kilos</th>
                                        <th scope="col">Disponible</th>
                                        <th scope="col">Merma</th>
                                        <th scope="col">Variedad</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($entradas))
                                        @foreach ($entradas as $entrada)
                                            <tr>
                                                <td>{{ $entrada->id }}</td>
                                                <td>{{ date("d/m/Y", strtotime($entrada->fecha)) }}</td>
                                                <td>{{ $entrada->albaran }}</td>
                                                <td><span style="white-space: nowrap;">{{ $entrada->traza }}</span></td>
                                                <td>{{ $entrada->proveedor_id }}</td>
                                                <td>
                                                    {{ (isset($entrada->proveedor)) ? $entrada->proveedor->proveedor : "" }}
                                                </td>
                                                <td>{{ $entrada->producto_id }}</td>
                                                <td>
                                                    {{ (!is_null($entrada->producto_id)) ? $entrada->producto->compuesto->cultivo->cultivo. " - ".$entrada->producto->compuesto->compuesto. " - ".$entrada->producto->variable : "" }}
                                                </td>
                                                <td class="text-right">{{ round($entrada->cantidad, 2) }}</td>
                                                <td class="text-right">
                                                    {{ round(($entrada->cantidad - $entrada->salidas->sum('cantidad') - $entrada->merma), 2) }}
                                                </td>
                                                <td class="text-right">{{ round($entrada->merma, 2) }}</td>
                                                <td>{{ $entrada->variedad }}</td>
                                                <td class="text-center">
                                                    @can("AgroAlfaro - Salidas | Acceso")
                                                        <a href="javascript:void(0);" class="text-primary mr-2 salida"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="Salidas">
                                                            <i class="nav-icon i-Arrow-Outside font-weight-bold "></i>
                                                        </a>
                                                    @endcan
                                                    @can("AgroAlfaro - Entradas | Modificar")
                                                        <a href="javascript:void(0);" class="text-success mr-2 edit"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="Editar">
                                                            <i class="nav-icon i-Pen-2 font-weight-bold "></i>
                                                        </a>
                                                    @endcan
                                                    @can("AgroAlfaro - Entradas | Borrar")
                                                        <a href="javascript:void(0);" class="text-danger mr-2 delete"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="Borrar">
                                                            <i class="nav-icon i-Close-Window font-weight-bold "></i>
                                                        </a>
                                                    @endcan
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
        <!-- end of col -->
    </div>
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/bootstrap-select.min.css')}}">
@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-select/i18n/defaults-es_ES.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/calendar/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/jquery.validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/jquery.validation/messages_es.js')}}"></script>

    <script>
        var table_entradas;
        var table_salidas;
        var entrada_form;
        var salida_form;
        var entrada_id;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $(".chosen").selectpicker({
                liveSearch: true
            });

            entrada_form = $("#entrada_form").validate({
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    if ($(element).is('select')) {
                        element.parent().after(error); // special placement for select elements
                    } else {
                        error.insertAfter(element); // default placement for everything else
                    }
                }
            });

            salida_form = $("#salida_form").validate({
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    if ($(element).is('select')) {
                        element.parent().after(error); // special placement for select elements
                    } else {
                        error.insertAfter(element); // default placement for everything else
                    }
                }
            });
        });

        $(function () {
            jQuery.extend(jQuery.fn.dataTableExt.oSort, {
                "date-uk-pre": function (a) {
                    var ukDatea = a.split('/');
                    return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
                },

                "date-uk-asc": function (a, b) {
                    return ((a < b) ? -1 : ((a > b) ? 1 : 0));
                },

                "date-uk-desc": function (a, b) {
                    return ((a < b) ? 1 : ((a > b) ? -1 : 0));
                }
            });
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

            // Configuracion de Datatable
            table_entradas = $('#entradas_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    { targets: [0, 4, 6], visible: false }
                ],
                sorting: [
                    [0, 'desc']
                ]
            });

            table_salidas = $('#salidas_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                ajax: {
                    url: "{{ route('tz.salidas.getByEntrada') }}",
                    data: function (d) {
                        d.entrada_id = entrada_id
                    }
                },
                columns: [
                    {
                        data: "id"
                    },
                    {
                        data: "traza",
                        render: function(data){
                            return '<span style="white-space: nowrap;">'+data+'</span>';
                        }
                    },
                    {
                        data: "fecha",
                        render: function (data) {
                            return moment(data, 'YYYY-MM-DD').format('DD/MM/YYYY')
                        }
                    },
                    {
                        data: "proveedor_id"
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return row.proveedor.proveedor;
                        }
                    },
                    {
                        data: "producto_id"
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return row.producto.compuesto.cultivo.cultivo + " - " + row.producto
                                .compuesto.compuesto + " - " + row.producto.variable;
                        }
                    },
                    {
                        data: "cajas"
                    },
                    {
                        data: "cantidad"
                    },
                    {
                        data: "precio"
                    },
                    {
                        data: "cliente_id"
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return row.cliente.razon_social;
                        }
                    },
                    {
                        data: "coste"
                    },
                    {
                        data: "comision"
                    },
                    {
                        data: "precio_liquidacion"
                    },
                    {
                        data: "eco",
                        className: "text-center",
                        render: function (data, type, row) {
                            var checked = (data == "1") ? "checked" : "";
                            return '<label class="checkbox checkbox-primary"><input type="checkbox" ' +
                                checked + ' disabled><span class="checkmark"></span></label>';
                        }
                    },
                    {
                        data: "pagada",
                        className: "text-center",
                        render: function (data, type, row) {
                            var checked = (data == "1") ? "checked" : "";
                            return '<label class="checkbox checkbox-primary"><input type="checkbox" ' +
                                checked + ' disabled><span class="checkmark"></span></label>';
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            var editar =
                                '@can("AgroAlfaro - Entradas | Modificar") <a href="javascript:void(0);" onclick="modalEditSalida(this)" class="text-success mr-2 edit" data-toggle="tooltip" data-placement="top" data-original-title="Editar"><i class="nav-icon i-Pen-2 font-weight-bold "></i></a>@endcan';
                            var borrar =
                                '@can("AgroAlfaro - Entradas | Borrar") <a href="javascript:void(0);" onclick="modalDeleteSalida(this)" class="text-danger mr-2 delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Borrar"><i class="nav-icon i-Close-Window font-weight-bold "></i></a>@endcan';
                            return editar + borrar;
                        }
                    }
                ],
                columnDefs: [{
                    targets: [0, 3, 5, 10],
                    visible: false
                }],
                responsive: false,
                paging: false,
                sorting: [
                    [0, 'desc']
                ]
            });

            $('#entradas_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_entradas.row(tr).data();

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
                    window.location.href = "{{ url('agroAlfaro/entradas/delete') }}" + "/" + row[0]
                })
            });

            $("#entradas_table .salida").on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_entradas.row(tr).data();
                var id = row[0];

                $("#salida_entrada_id").val(id);
                entrada_id = id;
                table_salidas.ajax.reload();

                if (parseFloat(row[9]) <= 0 ){
                    $("#btnGenerarMerma").prop('disabled', true);
                }else{
                    $("#btnGenerarMerma").prop('disabled', false);
                }

                $("#salida_cantidad").attr("max", row[9]);

                LimpiarCamposSalida();
                $("#modal-salida-title").html("Salidas");
                $("#modal-salida").modal('show');
            });

            $("#entradas_table .edit").on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_entradas.row(tr).data();

                $("#entrada_id").val(row[0]);
                var fecha = moment(row[1], "DD/MM/YYYY").format("YYYY-MM-DD");
                $("#fecha").val(fecha);
                $("#albaran").val(row[2]);
                $("#traza").val(row[3]);
                $("#proveedor").val(row[4]).selectpicker('refresh');
                $("#producto").val(row[6]).selectpicker('refresh');
                $("#cantidad").attr('min', row[8] - row[9]).val(row[8]);
                $("#variedad").val(row[10]);

                LimpiarCamposSalida();
                $("#modal-entrada-title").html("Modificar entrada");
                $("#modal-entrada").modal('show');
            });

            $("#btnNuevo").click(function (e) {
                LimpiarCamposEntrada();
                $("#entrada_id").val(null);
                $("#modal-entrada-title").html("Nuevo Entrada");
                $("#modal-entrada").modal('show');
            })

            $("#salida_cantidad, #salida_precio, #salida_comision, #salida_coste").change(function (e) {
                var precio = parseFloat($("#salida_precio").val());
                var coste = parseFloat($("#salida_coste").val());
                var comision = parseFloat($("#salida_comision").val());
                var precio_liquidacion = "";

                var total_comision = precio * (comision / 100);
                precio_liquidacion = (precio - total_comision - coste).toFixed(2);

                $("#salida_precio_liquidacion").val(precio_liquidacion);
            });

            $("#m_salida_cantidad, #m_salida_precio, #m_salida_comision, #m_salida_coste").change(function (e) {
                var precio = parseFloat($("#m_salida_precio").val());
                var coste = parseFloat($("#m_salida_coste").val());
                var comision = parseFloat($("#m_salida_comision").val());
                var precio_liquidacion = "";

                var total_comision = precio * (comision / 100);
                precio_liquidacion = (precio - total_comision - coste).toFixed(2);

                $("#m_salida_precio_liquidacion").val(precio_liquidacion);
            });

            $("#btnGenerarMerma").click(function (e) {
                swal({
                    title: 'Confirmar Proceso',
                    text: "Confirme enviar cantidad disponible a merma.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonClass: 'btn btn-success mr-5',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false,
                }).then(function (q) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('tz.entradas.generarMerma') }}",
                        dataType: 'JSON',
                        data: {
                            id: entrada_id
                        },
                        success: function (json) {
                            if (json == null || json == false) return;
                            swal({
                                type: 'success',
                                title: "¡Completado!",
                                text: "Proceso realizado con éxito",
                                confirmButtonClass: 'btn btn-success mr-5'
                            }).then(function () {
                                window.location.reload();
                            });
                        },
                        error: function (error) {
                            swal('¡Error!', 'Ha ocurrido un error en el proceso, intente más tarde.', 'error');
                        },
                    });
                })
            });

            $("#fecha").change(function(){
                var fecha = $(this).val();
                buildTrazaEntrada(fecha);
            });

            $("#salida_fecha").change(function(e){
                var fecha = $(this).val();
                buildTrazaSalida(fecha);
            });
        });

        function modalEditSalida(e) {
            var tr = $(e).closest('tr');
            var row = table_salidas.row(tr).data();

            $("#m_salida_id").val(row.id);
            $("#m_salida_traza").val(row.traza);
            var fecha = moment(row.fecha).format("YYYY-MM-DD");
            $("#m_salida_fecha").val(fecha);
            $("#m_salida_proveedor").val(row.proveedor_id).selectpicker('refresh');
            $("#m_salida_producto").val(row.producto_id).selectpicker('refresh');
            $("#m_salida_cajas").val(parseFloat(row.cajas));
            $("#m_salida_cantidad").val(parseFloat(row.cantidad));
            $("#m_salida_precio").val(parseFloat(row.precio));
            $("#m_salida_cliente").val(row.cliente_id).selectpicker('refresh');
            $("#m_salida_coste").val(parseFloat(row.coste));
            $("#m_salida_comision").val(parseFloat(row.comision));
            $("#m_salida_precio_liquidacion").val(parseFloat(row.precio_liquidacion));
            $("#m_salida_pagada").prop('checked', (row.eco == 1));
            $("#m_salida_pagada").prop('checked', (row.pagada == 1));
            $("#m_salida_entrada_id").val(row.entrada_id);

            $("#modal-edit-salida-title").html("Detalles de Salida");
            $("#modal-edit-salida").modal('show');
        }

        function modalDeleteSalida(e) {
            var tr = $(e).closest('tr');
            var row = table_salidas.row(tr).data();

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
                $.ajax({
                    type: 'GET',
                    url: "{{ url('agroAlfaro/salidas/delete') }}" + "/" + row.id,
                    dataType: 'JSON',
                    success: function (json) {
                        if (json == null || json == false) return;
                        window.location.reload();
                    },
                    error: function (error) {
                        console.log(error)
                        alert('Error. Check Console Log');
                    },
                });
            })
        }

        function buildTrazaEntrada(fecha)
        {
            $("#traza").val(null);

            $.ajax({
                type: 'POST',
                url: "{{ route('tz.entradas.ajaxCount') }}",
                dataType: 'JSON',
                data: {
                    fecha: fecha
                },
                success: function (json) {
                    var traza  = "AGF-" + moment(fecha, "YYYY-MM-DD").format("YYMMDD");
                    var cant   = json;
                    var result = traza + cant;

                    $("#traza").val(result);
                },
                error: function (error) {
                    swal('¡Error!', 'Ha ocurrido un error en el proceso, intente más tarde.', 'error');
                },
            });
        }

        function buildTrazaSalida(fecha)
        {
            $("#salida_traza").val(null);

            $.ajax({
                type: 'POST',
                url: "{{ route('tz.salidas.ajaxCount') }}",
                dataType: 'JSON',
                data: {
                    fecha: fecha
                },
                success: function (json) {
                    var traza  = "AGF-" + moment(fecha, "YYYY-MM-DD").format("YYMMDD");
                    var cant   = json;
                    var result = traza + cant;

                    $("#salida_traza").val(result);
                },
                error: function (error) {
                    swal('¡Error!', 'Ha ocurrido un error en el proceso, intente más tarde.', 'error');
                },
            });
        }

        function LimpiarCamposEntrada() {
            var fecha = moment().format("YYYY-MM-DD");
            $("#fecha").val(fecha);
            buildTrazaEntrada(fecha);
            $('#albaran, #cantidad, #variedad').val(null);
            $("#proveedor, #producto").val(null).selectpicker("refresh");
        }

        function LimpiarCamposSalida() {
            $("#salida_cajas, #salida_cantidad, #salida_precio, #salida_coste, #salida_precio_liquidacion").val(null);
            $("#salida_comision").val(8.50);
            var fecha = moment().format("YYYY-MM-DD");
            $("#salida_fecha").val(fecha);
            buildTrazaSalida(fecha);
            $("#salida_proveedor, #salida_articulo, #salida_cliente").val(null).selectpicker();
        }

    </script>
@endsection
