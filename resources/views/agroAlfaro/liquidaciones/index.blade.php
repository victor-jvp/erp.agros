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
                        <div class="col-md-2 form-group mb-3">
                            <label>Fecha Desde</label>
                            <input type="date" class="form-control" id="desde">
                        </div>
                        <div class="col-md-2 form-group mb-3">
                            <label>Fecha Hasta</label>
                            <input type="date" class="form-control" id="hasta">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="proveedor">Proveedor</label>
                            <select id="proveedor" class="form-control chosen">
                                <option value=""></option>
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}">{{ $proveedor->proveedor }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="producto">Producto</label>
                            <select id="producto" class="form-control chosen">
                                <option value=""></option>
                                @foreach ($compuestos as $compuesto)
                                    <option value="{{ $compuesto->id }}">
                                        {{ $compuesto->compuesto->cultivo->cultivo. " - ".$compuesto->compuesto->compuesto. " - ".$compuesto->variable }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label>ECO</label>
                            <diuv class="row">
                                <div class="col-md-4">
                                    <label class="radio radio-outline-primary">
                                        <input type="radio" class="eco" name="eco" value="" checked>
                                        <span class="">Todos</span>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="radio radio-outline-primary">
                                        <input type="radio" class="eco" name="eco" value="SI">
                                        <span class="">Si</span>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="radio radio-outline-primary">
                                        <input type="radio" class="eco" name="eco" value="NO">
                                        <span class="">No</span>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </diuv>
                        </div>
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
                                        <th>ECO</th>
                                        <th>ECO</th>
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
                                                <td>{{ (!is_null($liquidacion->producto_id)) ? $liquidacion->producto->compuesto->cultivo->cultivo. " - ".$liquidacion->producto->compuesto->compuesto. " - ".$liquidacion->producto->variable : "" }}</td>
                                                <td>{{ ($liquidacion->eco) ? "SI" : "NO" }}</td>
                                                <td class="text-center">
                                                    <label class="checkbox checkbox-primary">
                                                        <input type="checkbox"
                                                               {{ ($liquidacion->eco) ? "checked" : "" }} disabled>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </td>
                                                <td class="text-right">{{ round($liquidacion->cajas, 2) }}</td>
                                                <td class="text-right">{{ round($liquidacion->cantidad, 2) }}</td>
                                                <td class="text-right">{{ round($liquidacion->precio_liquidacion, 2) }}</td>
                                                <td class="text-right font-weight-bold">{{ round($liquidacion->precio_liquidacion * $liquidacion->cantidad, 2) }}</td>
                                                <td class="text-center">
                                                    @can('AgroAlfaro - Liquidaciones | Crear')
                                                        <a href="javascript:void(0);" class="text-success mr-2 pagada"
                                                           data-toggle="tooltip" data-placement="top"
                                                           title="Marcar como Pagada"
                                                           data-original-title="Marcar como Pagada">
                                                            <i class="nav-icon i-Money-2 font-weight-bold "></i>
                                                        </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot class="text-right font-weight-bold">
                                    <td colspan="8"><b>Totales</b></td>
                                    <td></td>
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
    <script src="{{asset('assets/js/vendor/calendar/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-select/i18n/defaults-es_ES.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/jszip.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/js/vendor/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/buttons.print.min.js')}}"></script>

    <script>
        var table_liquidaciones;
        var liquidacion_form;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function (e) {
            $(".chosen").selectpicker({
                liveSearch: true
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
            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                    var min = $("#desde").val();
                    var max = $("#hasta").val();
                    var fecha = data[2];

                    var startDate = moment(min, "YYYY-MM-DD");
                    var endDate = moment(max, "YYYY-MM-DD");
                    var diffDate = moment(fecha, "DD/MM/YYYY");

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
            table_liquidaciones = $('#liquidaciones_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0, 3, 5, 7], visible: false},
                ],
                dom: 'lBfrtip',
                buttons: [
                    /*{
                        extend: 'print',
                        text: 'Imprimir',
                        autoPrint: false,
                        exportOptions: {
                            columns: [1,2,4,6,7,8,9,10],
                            stripHtml: true
                        },
                        customize: function(win){
                            $(win.document.body)
                                .css( 'font-size', '10pt' )
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css( 'font-size', 'inherit' )
                                .css( 'color', 'black');
                        }
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: [1,2,4,6,7,8,9,10],
                            stripHtml: false
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [1,2,4,6,7,8,9,10],
                            stripHtml: false
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [1,2,4,6,7,8,9,10],
                            stripHtml: false
                        }
                    },*/
                    {
                        extend: 'pdf',
                        footer: true,
                        orientation: 'landscape',
                        title: 'Liquidaciones',
                        exportOptions: {
                            columns: [1, 2, 4, 6, 7, 9, 10, 11, 12],
                            stripHtml: true
                        }
                    }
                ],
                responsive: false,
                sorting: [
                    [0, 'desc']
                ],
                footerCallback: function (row, data, start, end, display) {
                    var totalKilos = 0;
                    var totalLiquidacion = 0;
                    var columnaPrecioLiquidacion = null;
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
                        var total = signo + sum.toFixed(2);
                        if (this.index() == 11) {
                            columnaPrecioLiquidacion = this;
                        } else {
                            $(this.footer()).html(total);
                        }

                        if (this.index() == 10) {
                            totalKilos = total;
                        }
                        if (this.index() == 12) {
                            totalLiquidacion = total;
                        }
                    });

                    var promPrecio = totalLiquidacion / totalKilos;
                    $(columnaPrecioLiquidacion.footer()).html(promPrecio.toFixed(2));
                }
            });

            $("#proveedor").on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                var valor = $(this).val();
                table_liquidaciones.columns(3).search(valor).draw(false);
            });

            $("#producto").on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                var valor = $(this).val();
                table_liquidaciones.columns(5).search(valor).draw(false);
            });

            $(".eco").on('change', function (e) {
                var estado = $(this).val();
                table_liquidaciones.columns(7).search(estado).draw(false);
            });

            $('#liquidaciones_table .pagada').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_liquidaciones.row(tr).data();

                swal({
                    title: 'Confirmar Proceso',
                    text: "Confirmar marcar como pagado el registro seleccionado",
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
                        type: 'POST',
                        url: "{{ route('tz.liquidaciones.marcarPagada') }}",
                        dataType: 'JSON',
                        data: {
                            id: row[0],
                        },
                        success: function (json) {
                            if (json == null || json === false) return;
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
                            console.debug(error);
                            swal('¡Error!', 'Ha ocurrido un error en el proceso, intente más tarde.', 'error');
                        },
                    });
                });
            });

            $("#desde, #hasta").on("change", function (e) {
                table_liquidaciones.draw(false);
            });
        });
    </script>
@endsection
