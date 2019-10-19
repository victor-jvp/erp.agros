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

                    <form action="/comercial/pedidos-comercial" method="POST" id="pedido_form">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" id="pedido_method" value="">

                        <!-- Modal Nuevo Pedido-->
                        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                             aria-hidden="true" id="modal-pedido">
                            <div class="modal-dialog modal-lg mw-100 w-75">
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
                                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-3 table-responsive">
                                                <table class="table table-sm table-bordered" id="table_nuevo_pedido"
                                                       style="width: 100%">
                                                    <thead>
                                                    <tr>
                                                        <th width="5%" class="text-center">Dias</th>
                                                        <th width="15%">Compuesto</th>
                                                        <th width="7%">Cajas</th>
                                                        <th width="7%">Kilos</th>
                                                        <th width="7%">€/Kg</th>
                                                        <th width="10%">Palet</th>
                                                        <th width="5%">Cantidad Palet</th>
                                                        <th width="10%">Destino</th>
                                                        <th width="10%">Transporte</th>
                                                        <th width="9%">Etiqueta</th>
                                                        <th width="10%">Comentario</th>
                                                        <th width="5%">Opciones</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($semana as $dia)
                                                        <tr class="tr_{{ $dia->id }}">
                                                            <td class="text-center dia_letra" rowspan="1"
                                                                id="td_{{ $dia->id }}">{{ $dia->letra }}</td>
                                                            <td colspan="10"></td>
                                                            <td>
                                                                <a href="javascript:void(0);" class="text-info mr-2 add"
                                                                   data-dia="{{ $dia->id }}"
                                                                   data-toggle="tooltip" data-placement="top" title=""
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

                    <!-- Modal Editar Pedido-->
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
                                            <div class="col-md-12 mb-3">
                                                <label for="cliente">Cliente</label>
                                                <select class="form-control" id="cliente" name="cliente"
                                                        required>
                                                    @foreach ($clientes as $cliente)
                                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="anio">Dia</label>
                                                <input type="text" name="dia" id="dia" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-8 mb-3">
                                                <label for="anio">Compuesto</label>
                                                <select class="form-control" name="" id="">
                                                    @foreach ($compuestos as $compuesto)
                                                        <option value="{{ $compuesto['id'] }}">{{ $compuesto['descripcion'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="cajas">Cajas</label>
                                                <input type="number" id="cajas" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="kilos">Kilos</label>
                                                <input type="number" id="kilos" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="precio">€/Kg</label>
                                                <input type="number" id="precio" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="palet">Palet</label>
                                                <input type="number" id="palet" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="cantidad_palet">Cant. Palet</label>
                                                <input type="number" id="cantidad_palet" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="destino">Destino</label>
                                                <input type="text" id="destino" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="transporte">Transporte</label>
                                                <select class="form-control" id="transporte" name="transporte_id">
                                                    @foreach ($transportes as $transporte)
                                                        <option value="{{ $transporte->id }}">{{ $transporte->razon_social }}
                                                            | {{ $transporte->cif }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="etiqueta">Etiqueta</label>
                                                <input type="number" id="etiqueta" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8 mb-3">
                                                <label for="transporte">Comentario</label>
                                                <textarea class="form-control" name="comentario" id="comentario"
                                                          rows="4"></textarea>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="estado">Estado</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="1">EN ESPERA</option>
                                                    <option value="2">COMPLETADO</option>
                                                    <option value="3">CANCELADO</option>
                                                </select>
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
                    </form>

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

                            <div class="col-md-6  text-right form-group mb-3">
                                <br>
                                <button class="btn btn-outline-primary" type="button" id="btnAddPedido">Añadir Pedido
                                </button>
                            </div>
                        </div>

                    </form>

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
                                                    <table class="table table_pedidos" width="100%">
                                                        <thead>
                                                        <tr>
                                                            <th>Nº Orden</th>
                                                            <th>Compuesto</th>
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
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @forelse ($cultivo->pedidos as $pedido)

                                                        @empty
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <a href="javascript:void(0);"
                                                                       class="text-info mr-2 add"
                                                                       data-toggle="tooltip" data-placement="top"
                                                                       title=""
                                                                       data-original-title="Agregar">
                                                                        <i class="nav-icon i-Add font-weight-bold"></i>
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                       class="text-success mr-2 edit"
                                                                       data-toggle="tooltip" data-placement="top"
                                                                       title=""
                                                                       data-original-title="Editar">
                                                                        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                       class="text-danger mr-2 delete"
                                                                       data-toggle="tooltip" data-placement="top"
                                                                       title=""
                                                                       data-original-title="Borrar">
                                                                        <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforelse
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
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/chosen-bootstrap-4.css')}}">
@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/chosen.jquery.js')}}"></script>
    <script src="{{asset('assets/js/vendor/calendar/moment-with-locales.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $(".chosen").chosen({
                width: "100%",
                no_results_text: "No se encontraron resultados... ",
                placeholder_text_single: "Seleccione una opción...",
                allow_single_deselect: true
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
        })

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
        $(document).ready(function () {
            // Configuracion de Datatable
            table_pedidos = $('.table_pedidos').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                responsive: true,
                info: false,
                paging: false,
                searching: true
            });

            table_destinos = $('#table_destinos_comerciales').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                // columnDefs: [
                //     {targets: [0], visible: false}
                // ],
                responsive: true,
                info: false,
                paging: false
            });

            $("#table_nuevo_pedido").on('click', '.add', function () {
                $(this).tooltip('hide');

                var tr = $(this).closest('tr');
                var data_dia = $(this).attr('data-dia');
                var letra = $("#table_nuevo_pedido").find('#td_' + data_dia).html();
                var _rowspan = $("#table_nuevo_pedido").find('#td_' + data_dia).attr('rowspan');
                var td_rowspan = "";

                if (_rowspan == null || _rowspan == undefined) {
                    td_rowspan = '<td class="text-center dia_letra" id="td_' + data_dia + '" rowspan="1">' + letra + '</td>';
                } else {
                    _rowspan = (parseInt(_rowspan) + 1);
                    $("#table_nuevo_pedido").find('#td_' + data_dia).attr('rowspan', (_rowspan));
                }

                var html = '<tr id="tr_'+data_dia+'">' +
                    td_rowspan +
                    '<td><select name="compuesto[]" class="form-control compuesto" onmouseover="loadCompuesto(this)"></td> ' +
                    '<td><input type="text" name="cajas[]" class="form-control cajas"></td> ' +
                    '<td><input type="text" name="kilos[]" class="form-control" readonly value="0"></td> ' +
                    '<td><input type="number" name="precio[]" class="form-control" value="0" step="0.01"></td> ' +
                    '<td><select name="palet_model[]" class="form-control" onmouseover="loadPalet(this)"></select></td> ' +
                    '<td><input type="text" name="palet_cantidad[]" class="form-control"></td> ' +
                    '<td><select name="destino[]" class="form-control" onmouseover="loadDestinosForCliente(this)"></select</td> ' +
                    '<td><select name="transporte[]" class="form-control" onmouseover="loadTransporte(this)"></select></td> ' +
                    '<td><input type="text" name="etiqueta[]" class="form-control"></td> ' +
                    '<td><textarea rows="1" name="comentario[]" class="form-control"></textarea></td> ' +
                    '<td> ' +
                    '<a href="javascript:void(0);" class="text-info mr-2 add" data-toggle="tooltip" data-placement="top" title="" data-original-title="Agregar" data-dia="' + data_dia + '"> ' +
                    '<i class="nav-icon i-Add font-weight-bold"></i> ' +
                    '</a> ' +
                    '<a href="javascript:void(0);" class="text-danger mr-2 delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Borrar" data-dia="' + data_dia + '"> ' +
                    '<i class="nav-icon i-Close-Window font-weight-bold"></i> ' +
                    '</a> ' +
                    '</td></tr>';
                $(tr).after(html);

                $(".compuesto").change(function (e) {
                    var kg = $(this).find('option:selected').attr('data-kg');
                    var cajas = $(this).parent().next().find('input').val();
                    $(this).parent().next().next().find('input').val(kg * cajas);
                });

                $(".cajas").change(function (e) {
                    var kg = $(this).parent().prev().find('select').find('option:selected').attr('data-kg');
                    var cajas = $(this).val();
                    $(this).parent().next().find('input').val(kg * cajas);
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
                var row = table_pedidos.row(current_row).data();

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
                        row[0]
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

            //Carga de nro de palets en base a cantidad, tipo de palet y variedad de producto compuesto.
            $("#variedad, #modelo_palet, #cantidad").change(function () {
                loadVariedadDetails();
            });

            $("#euro_kg, #grand_kg, #precio").change(function () {
                calcularKilos();
            });
        });

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
            $('#nro_orden, #cliente, #destino_comercial, #cultivo, #formato, #etiqueta, #transporte, #precio, #kilos, #comentario, #variedad')
                .val(null);
            $('#producto, #producto_compuesto, #modelo_palet, #formato_palet, #cantidad').val(null);
            $(".dias").prop("checked", false).prop('disabled', false);
            $(".chosen").trigger("chosen:updated");
        }

        function LoadDestinosComerciales(valor, selected) {
            $.ajax({
                type: 'POST',
                url: "{{ route('pedidos-comercial.ajaxGetDestinosComerciales') }}",
                dataType: 'JSON',
                data: {
                    "id": valor
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
            $.ajax({
                type: 'POST',
                url: "{{ route('pedidos-comercial.ajaxGetDestinosComercialesForCliente') }}",
                dataType: 'JSON',
                data: {id: id},
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
                        var text = data[i].compuesto.compuesto + " - " + data[i].variable;
                        var kg = data[i].kg;
                        var option = "<option data-kg='" + kg + "' value='" + value + "'>" + text + "</option>";
                        $(elem).append(option);
                    }
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
    </script>
    {{-- Scripts para palets.blade.php --}}
    <script>
        function RemoveCard(e) {
            $(e).closest('.card').remove();
        }
    </script>
@endsection