@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Agro Alfaro</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Salidas</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Salidas</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}

                    <div class="row">
                        @can('AgroAlfaro - Salidas | Crear')
                            <div class="col-md-3">
                                <button class="btn btn-primary" type="button" id="btnNuevo">Nuevo</button>
                            </div>
                        @endcan
                    </div>

                    {{--Modal Generar Salida--}}
                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                         aria-hidden="true" id="modal-salida">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="/agroAlfaro/salidas/store" method="POST" id="salida_form">
                                    @csrf

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-salida-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="salida_traza">Traza</label>
                                                <input type="text" class="form-control" id="salida_traza"
                                                       placeholder="Traza Salida" required="" name="fecha">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="salida_fecha">Fecha</label>
                                                <input type="date" class="form-control" id="salida_fecha"
                                                       placeholder="Fecha" required=""
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
                                                        <option value="{{ $proveedor->id }}">{{ $proveedor->proveedor }}
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
                                                            {{ $compuesto->variable. " - ".$compuesto->caja->formato. " - ".$compuesto->caja->modelo }}
                                                        </option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="salida_cajas">Cajas</label>
                                                <input type="number" class="form-control" id="salida_cajas"
                                                       placeholder="Cajas" name="cajas">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="salida_cantidad">Kilos</label>
                                                <input type="number" class="form-control" id="salida_cantidad" required
                                                       name="cantidad" placeholder="Kilos">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="salida_precio">Precio Venta</label>
                                                <input type="number" class="form-control" id="salida_precio"
                                                       placeholder="Precio Venta" name="precio">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="salida_cliente">Cliente</label>
                                                <select name="cliente_id" id="salida_cliente"
                                                        class="form-control chosen">
                                                    <option value=""></option>
                                                    @foreach ($clientes as $cliente)
                                                        <option
                                                            value="{{ $cliente->id }}">{{ $cliente->cliente }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="salida_coste">Coste</label>
                                                <input type="number" class="form-control" id="salida_coste"
                                                       placeholder="Coste" name="coste">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="salida_comision">Comisión</label>
                                                <input type="number" class="form-control" id="salida_comision"
                                                       placeholder="Comisión" name="comision">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="salida_precio_liquidacion">Precio Liquidación</label>
                                                <input type="number" class="form-control" id="salida_precio_liquidacion"
                                                       placeholder="Precio Liquidación" name="precio_liquidacion">
                                            </div>
                                            <div class="col-md-6 mb-3 mt-4">
                                                <label class="checkbox checkbox-primary">
                                                    <input type="checkbox" id="salida_pagada" name="comision">
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
                                <table id="salidas_table" class="display table table-striped table-bordered"
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
                                        <th>pagada</th>
                                        <th scope="col">Pagada</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($salidas))
                                        @foreach ($salidas as $salida)
                                            <tr>
                                                <td>{{ $salida->id }}</td>
                                                <td>{{ $salida->traza }}</td>
                                                <td>{{ date("d/m/Y", strtotime($salida->fecha)) }}</td>
                                                <td>{{ $salida->proveedor_id }}</td>
                                                <td>{{ (isset($salida->proveedor)) ? $salida->proveedor->proveedor : "" }}</td>
                                                <td>{{ $salida->producto_id }}</td>
                                                <td>{{ (!is_null($salida->producto_id)) ? $salida->producto->variable. " - ".$salida->producto->caja->formato. " - ".$salida->producto->caja->modelo : "" }}
                                                <td class="text-right">{{ round($salida->cajas, 2) }}</td>
                                                <td class="text-right">{{ round($salida->cantidad, 2) }}</td>
                                                <td class="text-right">{{ round($salida->precio, 2) }}</td>
                                                <td>{{ $salida->cliente_id }}</td>
                                                <td>{{ (isset($salida->cliente)) ? $salida->razon_social : "" }}</td>
                                                <td class="text-right">{{ round($salida->coste, 2) }}</td>
                                                <td class="text-right">{{ round($salida->comision, 2) }}</td>
                                                <td class="text-right">{{ round($salida->precio_liquidacion, 2) }}</td>
                                                <td>{{ $salida->pagada }}</td>
                                                <td class="text-center">
                                                    <label class="checkbox checkbox-primary">
                                                        <input type="checkbox" {{ ($salida->pagada) ? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </td>
                                                <td class="text-center">
                                                    @can('AgroAlfaro - Liquidaciones | Crear')
                                                        <a href="javascript:void(0);" class="text-primary mr-2 liquidacion"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="Generar Liquidación">
                                                            <i class="nav-icon i-Money-2 font-weight-bold "></i>
                                                        </a>
                                                    @endcan
                                                    @can('AgroAlfaro - Salidas | Modificar')
                                                        <a href="javascript:void(0);" class="text-success mr-2 edit"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="Editar">
                                                            <i class="nav-icon i-Pen-2 font-weight-bold "></i>
                                                        </a>
                                                    @endcan
                                                    @can('AgroAlfaro - Salidas | Borrar')
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
        var table_salidas;
        var salida_form;

        $(document).ready(function () {
            $(".chosen").selectpicker({
                liveSearch: true
            });

            salida_form = $("#salida_form").validate({
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    if ($(element).is('select')) {
                        element.parent().after(error); // special placement for select elements
                    } else {
                        error.insertAfter(element);  // default placement for everything else
                    }
                }
            });
        });

        $(function () {
            // Configuracion de Datatable
            table_salidas = $('#salidas_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [{
                    targets: [0, 3, 5, 10, 15],
                    visible: false
                },]
            });

            $('#salidas_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
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
                    window.location.href = "{{ url('agroAlfaro/salidas/delete') }}" + "/" + row[
                        0]
                })
            });

            $("#entradas_table .liquidacion").on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_entradas.row(tr).data();
                var id = row[0];

                $("#salida_id").val(id);

                LimpiarCamposSalida();
                $("#modal-salida-title").html("Generar Liquidación");
                $("#modal-salida").modal('show');
            });

            $("#salidas_table .edit").on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_salidas.row(tr).data();

                //console.log(row);
                $("#salida_id").val(row[0]);
                var fecha = moment(row[1], "DD/MM/YYYY").format("YYYY-MM-DD");
                $("#fecha").val(fecha);
                $("#albaran").val(row[2]);
                $("#traza").val(row[3]);
                $("#proveedor").val(row[4]).selectpicker('refresh');
                $("#producto").val(row[6]).selectpicker('refresh');
                $("#cantidad").val(row[8]);
                $("#variedad").val(row[9]);

                LimpiarCamposSalida();
                $("#modal-salida-title").html("Detalles de Salida");
                $("#modal-salida").modal('show');
            });

            $("#btnNuevo").click(function (e) {
                LimpiarCamposSalida();
                $("#salida_id").val(null);
                $("#modal-salida-title").html("Nuevo Salida");
                $("#modal-salida").modal('show');
            })
        });

        function LimpiarCamposSalida() {
            var fecha = moment().format("YYYY-MM-DD");
            $("#fecha").val(fecha);
            $('#albaran, #traza, #cantidad, #variedad').val(null);
            $("#proveedor, #articulo").val(null).selectpicker("refresh");
        }

        function LimpiarCamposSalida() {
            $("#salida_traza, #salida_cajas, #salida_cantidad, #salida_precio, #salida_coste, #salida_comision, #salida_precio_liquidacion")
                .val(null);
            $("#salida_proveedor, #salida_producto, #salida_cliente").val(null).selectpicker();
        }

    </script>
@endsection
