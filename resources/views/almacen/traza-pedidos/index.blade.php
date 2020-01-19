@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Almacen</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Traza de Pedidos</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Traza de Pedidos</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="traza_table" class="display table table-striped table-bordered"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th scope="col">Nro. Orden</th>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($pedidos))
                                        @foreach ($pedidos as $pedido)
                                            <tr>
                                                <td>{{ $pedido->id }}</td>
                                                <td>
                                                    <a href="javascript:void(0);"
                                                       onclick="ShowPedido({{ $pedido->id }})">
                                                        {{ $pedido->nro_orden }}
                                                    </a>
                                                </td>
                                                <td>{{ $pedido->cliente->razon_social }}</td>
                                                <td>
                                                    <a href="javascript:void(0);" onclick="ShowTraza({{ $pedido->id }})"
                                                       class="text-success mr-2 edit" data-toggle="tooltip"
                                                       data-placement="top" title=""
                                                       data-original-title="Ver Traza">
                                                        <i class="nav-icon i-Windows-2 font-weight-bold"></i>
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

                    {{-- Modal Show Traza --}}
                    <div class="modal fade" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="modal_traza">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Vista de la Traza por Nro. de Orden</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="nro_orden">Nro. Orden</label>
                                            <input type="text" class="form-control" id="nro_orden" readonly
                                                   placeholder="Nro. Orden">
                                        </div>
                                        <div class="col-md-8 mb-3">
                                            <label for="cliente">Cliente</label>
                                            <input type="text" class="form-control" id="cliente" readonly
                                                   placeholder="Cliente">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="cajas">Cajas</label>
                                            <input type="number" class="form-control" id="cajas" readonly>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="kilos">Kilos</label>
                                            <input type="number" class="form-control" id="kilos" readonly>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="palets">Palets</label>
                                            <input type="number" class="form-control" id="palets" readonly>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="table-responsive">
                                                <table id="traza_pedido_table"
                                                       class="display table table-striped table-bordered"
                                                       style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Material</th>
                                                        <th scope="col">Nro. Entrada</th>
                                                        <th scope="col">Nro. Albaran</th>
                                                        <th scope="col">Fecha Albaran</th>
                                                        <th scope="col">Proveedor</th>
                                                        <th scope="col">Nro. Salida</th>
                                                        <th scope="col">Cantidad</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
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
                    {{-- FIN Modal Show Traza --}}

                    {{-- Modal Editar Pedido --}}
                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                         aria-hidden="true" id="modal_edit_pedido">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal_edit_pedido-title">Detalles del Pedido</h5>
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
                                            {{--                                            <select class="form-control chosen" id="edit_cliente" name="cliente_id"--}}
                                            {{--                                                    required>--}}
                                            {{--                                                @foreach ($clientes as $cliente)--}}
                                            {{--                                                    <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>--}}
                                            {{--                                                @endforeach--}}
                                            {{--                                            </select>--}}
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
                                            {{--                                            <select class="form-control chosen" name="producto_id"--}}
                                            {{--                                                    id="edit_producto_id">--}}
                                            {{--                                                @foreach ($compuestos as $compuesto)--}}
                                            {{--                                                    <option data-kg="{{ $compuesto->kg }}"--}}
                                            {{--                                                            data-euro="{{ $compuesto->euro_cantidad }}"--}}
                                            {{--                                                            data-grand="{{ $compuesto->grand_cantidad }}"--}}
                                            {{--                                                            value="{{ $compuesto->id }}">--}}
                                            {{--                                                        {{ $compuesto->variable. " - ".$compuesto->caja->formato. " - ".$compuesto->caja->modelo }}--}}
                                            {{--                                                    </option>--}}
                                            {{--                                                @endforeach--}}
                                            {{--                                            </select>--}}
                                            <input type="text" class="form-control" id="edit_producto" readonly>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="edit_cajas">Cajas</label>
                                            <input type="number" id="edit_cajas" class="form-control" step="1" readonly>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="edit_kilos">Kilos</label>
                                            <input type="number" id="edit_kilos" class="form-control" step="0.01"
                                                   readonly>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="palet">Palet</label>
                                            {{--                                            <select name="palet_id" id="edit_palet_id" class="form-control">--}}
                                            {{--                                                @foreach ($palets as $palet)--}}
                                            {{--                                                    <option--}}
                                            {{--                                                            data-modelo="{{ ($palet->modelo_id == 1) ? 'data-euro' : 'data-grand' }}"--}}
                                            {{--                                                            value="{{ $palet->id }}">--}}
                                            {{--                                                        {{ $palet->modelo->modelo." - ".$palet->formato }}</option>--}}
                                            {{--                                                @endforeach--}}
                                            {{--                                            </select>--}}
                                            <input type="text" class="form-control" id="edit_palet" readonly>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="cantidad_palet">Cant. Palet</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <a id="btnOpenModalPaletCantidad" href="javascript:void(0);"
                                                       class="input-group-text"><i class="i-Information"></i></a>
                                                </div>
                                                <input type="number" id="edit_cantidad_palet" class="form-control"
                                                       readonly step="1">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="destino">Destino</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <a href="javascript:void(0);" class="input-group-text"
                                                       id="btnOpenModalDestinos"><i class="i-Information"></i></a>
                                                </div>
                                                {{--                                                <select class="form-control" name="destino"--}}
                                                {{--                                                        id="edit_destino"></select>--}}
                                                <input type="text" class="form-control" id="edit_destino" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="transporte">Transporte</label>
                                            {{--                                            <select class="form-control" id="edit_transporte" name="transporte_id">--}}
                                            {{--                                                @foreach ($transportes as $transporte)--}}
                                            {{--                                                    <option value="{{ $transporte->id }}">{{ $transporte->razon_social }}--}}
                                            {{--                                                    </option>--}}
                                            {{--                                                @endforeach--}}
                                            {{--                                            </select>--}}
                                            <input type="text" class="form-control" id="edit_transporte" readonly>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="etiqueta">Etiqueta</label>
                                            <input type="number" id="edit_etiqueta" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8 mb-3">
                                            <label for="transporte">Comentario</label>
                                            <textarea class="form-control" id="edit_comentario" readonly
                                                      rows="4"></textarea>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="estado">Estado</label>
                                                    {{--                                                    <select name="estado_id" id="edit_estado_id"--}}
                                                    {{--                                                            class="form-control">--}}
                                                    {{--                                                        @foreach($estados as $estado)--}}
                                                    {{--                                                            <option value="{{ $estado->id }}">{{ $estado->estado }}</option>--}}
                                                    {{--                                                        @endforeach--}}
                                                    {{--                                                    </select>--}}
                                                    <input type="text" class="form-control" id="edit_estado" readonly>
                                                </div>
                                            </div>
                                            {{--                                            <div class="row">--}}
                                            {{--                                                <div class="col-md-12 mb-3">--}}
                                            {{--                                                    <button type="button"--}}
                                            {{--                                                            class="btn btn-outline-info m-1 mb-3 btn-block"--}}
                                            {{--                                                            id="btnCheckStock">--}}
                                            {{--                                                            <span class="ul-btn__icon"><i--}}
                                            {{--                                                                        class="i-Information"></i></span>--}}
                                            {{--                                                        <span class="ul-btn__text">Verificar Stock</span>--}}
                                            {{--                                                    </button>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}
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

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        var traza_table;
        var traza_pedido_table;

        $(function () {
            // Configuracion de Datatable
            traza_table = $('#traza_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                sorting: [
                    [0, 'desc']
                ],
                columnDefs: [
                    {targets: [0], visible: false},
                ]
            });

            traza_pedido_table = $('#traza_pedido_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                sorting: false
            });

        });

        function limpiarCampos() {
            $('#nro_orden, #cliente').val(null);
            traza_pedido_table.rows().remove().draw();
        }

        function ShowTraza(pedido_id) {
            if (pedido_id == null) return;

            $.ajax({
                type: 'POST',
                url: "{{ route('traza-pedidos.details') }}",
                dataType: 'JSON',
                data: {
                    id: pedido_id
                },
                success: function (data) {
                    limpiarCampos();
                    if (data == null) return;

                    $("#nro_orden").val(data.nro_orden);
                    $("#cliente").val(data.cliente.razon_social);
                    $("#cajas").val(data.cajas);
                    $("#kilos").val(data.kilos);
                    $("#palets").val(data.pallet_cantidad);

                    for (var i = 0; i < data.materiales.length; i++) {
                        traza_pedido_table.row.add([
                            data.materiales[i].material,
                            data.materiales[i].entradas,
                            data.materiales[i].nro_albaran,
                            data.materiales[i].fecha_albaran,
                            data.materiales[i].proveedor,
                            data.materiales[i].salidas,
                            data.materiales[i].cantidad,
                        ]).draw();
                    }

                    $("#modal_traza").modal('show');
                },
                error: function (error) {
                    console.log(error);
                    alert('Error. Check Console Log');
                },
            });
        }

        function ShowPedido(id) {
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
                    $("#edit_cliente").val(data.cliente.razon_social);
                    $("#edit_producto").val(data.variable.variable + " - " + data.variable.caja.formato + " - " + data.variable.caja.modelo);
                    $("#edit_dia").val(data.dia.dia);
                    $("#edit_cajas").val(data.cajas);
                    $("#edit_kilos").val(data.kilos);
                    $("#edit_palet").val(data.palet.formato);
                    $("#edit_cantidad_palet").val(data.pallet_cantidad);
                    // loadDestinosForEditCliente($("#edit_destino"), data.destino_id, data.cliente_id);
                    $("#edit_transporte").val(data.transporte.razon_social);
                    $("#edit_etiqueta").val(data.etiqueta);
                    $("#edit_comentario").val(data.comentarios);
                    $("#edit_estado").val(data.estado.estado);

                    // fillModalInventarioDisponible(id);
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
    </script>
@endsection
