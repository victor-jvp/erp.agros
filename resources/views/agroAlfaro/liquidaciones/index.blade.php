@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Agro Alfaro</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Liquidaciones</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Liquidaciones</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}

                    <div class="row">
                        @can('AgroAlfaro - Liquidaciones | Crear')
                            <div class="col-md-3">
                                <button class="btn btn-primary" type="button" id="btnNuevo">Nuevo</button>
                            </div>
                        @endcan
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="liquidaciones_table" class="display table table-striped table-bordered"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th scope="col">Traza Salida</th>
                                        <th scope="col">Fecha Salida</th>
                                        <th>proveedor_id</th>
                                        <th scope="col">Proveedor</th>
                                        <th>producto_id</th>
                                        <th scope="col">Producto</th>
                                        <th scope="col" class="sum">Cajas</th>
                                        <th scope="col" class="sum">Kilos</th>
                                        <th scope="col" class="sum">Precio Liquidación</th>
                                        <th scope="col" class="sum">Total Liquidación</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($liquidaciones))
                                        @foreach ($liquidaciones as $liquidacion)
                                            <tr>
                                                <td>{{ $liquidacion->id }}</td>
                                                <td>{{ $liquidacion->traza }}</td>
                                                <td>{{ date("d/m/Y", strtotime($liquidacion->fecha)) }}</td>
                                                <td>{{ $liquidacion->proveedor_id }}</td>
                                                <td>{{ (isset($liquidacion->proveedor)) ? $liquidacion->proveedor->proveedor : "" }}</td>
                                                <td>{{ $liquidacion->producto_id }}</td>
                                                <td>{{ (!is_null($liquidacion->producto_id)) ? $liquidacion->producto->variable. " - ".$liquidacion->producto->caja->formato. " - ".$liquidacion->producto->caja->modelo : "" }}
                                                <td class="text-right">{{ round($liquidacion->cajas, 2) }}</td>
                                                <td class="text-right">{{ round($liquidacion->cantidad, 2) }}</td>
                                                <td class="text-right">{{ round($liquidacion->precio_liquidacion, 2) }}</td>
                                                <td class="text-right">{{ round($liquidacion->precio_liquidacion * $liquidacion->cantidad, 2) }}</td>
                                                <td class="text-center">
                                                    {{--@can('AgroAlfaro - Liquidaciones | Modificar')
                                                        <a href="javascript:void(0);" class="text-success mr-2 edit"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="Editar">
                                                            <i class="nav-icon i-Pen-2 font-weight-bold "></i>
                                                        </a>
                                                    @endcan
                                                    @can('AgroAlfaro - Liquidaciones | Borrar')
                                                        <a href="javascript:void(0);" class="text-danger mr-2 delete"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="Borrar">
                                                            <i class="nav-icon i-Close-Window font-weight-bold "></i>
                                                        </a>
                                                    @endcan--}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot class="text-right">
                                        <td colspan="7"><b>Totales</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tfoot>
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
        var table_liquidaciones;
        var liquidacion_form;

        $(document).ready(function () {
            $(".chosen").selectpicker({
                liveSearch: true
            });

            liquidacion_form = $("#liquidacion_form").validate({
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
            table_liquidaciones = $('#liquidaciones_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [{
                    targets: [0, 3, 5],
                    visible: false
                },],
                responsive: false,
                sorting: [
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
                                var regex = /[.,\s]/g;
                                var aa = a.toString();
                                var bb = b.toString();
                                var x = parseFloat(aa.replace(regex, '')) || 0;
                                var y = parseFloat(bb.replace(regex, '')) || 0;
                                return x + y;
                            }, 0);
                        var signo = "";
                        if (sum < 0) signo = "-";
                        $(this.footer()).html(signo + sum.toFixed(2));
                    });
                }
            });

            $('#liquidaciones_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_liquidaciones.row(tr).data();

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
                        url: "{{ url('agroAlfaro/liquidaciones/delete') }}" + "/" + row[0],
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
            });

            $("#entradas_table .liquidacion").on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_entradas.row(tr).data();
                var id = row[0];

                $("#liquidacion_id").val(id);

                LimpiarCamposSalida();
                $("#modal-liquidacion-title").html("Generar Liquidación");
                $("#modal-liquidacion").modal('show');
            });

            $("#liquidaciones_table .edit").on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_liquidaciones.row(tr).data();

                LimpiarCamposSalida();

                //console.log(row);
                $("#liquidacion_id").val(row[0]);
                $("#traza").val(row[1]);
                var fecha = moment(row[2], "DD/MM/YYYY").format("YYYY-MM-DD");
                $("#fecha").val(fecha);
                $("#proveedor").val(row[3]).selectpicker('refresh');
                $("#producto").val(row[5]).selectpicker('refresh');
                $("#cajas").val(row[7]);
                $("#cantidad").val(row[8]);
                $("#precio").val(row[9]);
                $("#cliente").val(row[10]).selectpicker('refresh');
                $("#coste").val(row[12]);
                $("#comision").val(row[13]);
                $("#precio_liquidacion").val(row[14]);
                $("#pagada").prop('checked', (row[15] == 1));
                $("#entrada").val(row[17]).selectpicker('refresh');

                $("#modal-liquidacion-title").html("Detalles de Salida");
                $("#modal-liquidacion").modal('show');
            });

            $("#btnNuevo").click(function (e) {
                LimpiarCamposSalida();

                $("#liquidacion_id").val(null);
                $("#modal-liquidacion-title").html("Nuevo Salida");
                $("#modal-liquidacion").modal('show');
            })

            $("#cantidad, #precio, #comision, #coste").change(function (e) {
                var kilos = parseFloat($("#cantidad").val());
                var precio = parseFloat($("#precio").val());
                var coste = parseFloat($("#coste").val());
                var comision = parseFloat($("#comision").val());
                var precio_liquidacion = "";

                if (kilos > 0 && precio > 0 && coste > 0 && comision > 0) {
                    var total_comision = precio - (precio * comision);
                    precio_liquidacion = (precio - total_comision + coste).toFixed(2);
                }

                $("#precio_liquidacion").val(precio_liquidacion);
            });

            $('#entrada').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                var valor = $(this).val();
                $("#cantidad").removeAttr('max');

                if (valor != "") {
                    var max = $(this).find('option:selected').data('max');
                    $("#cantidad").attr('max', max);
                }
            });

        });

        function LimpiarCamposSalida() {
            var fecha = moment().format("YYYY-MM-DD");
            $("#fecha").val(fecha);
            $('#liquidacion_id, #traza, #cajas, #cantidad, #precio, #cliente, #coste, #comision, #precio_liquidacion').val(null);
            $("#proveedor, #producto, #cliente, #entrada").val(null).selectpicker("refresh");
            $("#pagada").prop('checked', false);
        }

    </script>
@endsection
