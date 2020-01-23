@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Costes</h1>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Cálculo de Costes</h4>
                    {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis dolorem neque repellendus sunt nemo repellat incidunt inventore odio quam! Voluptate maiores commodi quis praesentium inventore laboriosam esse facilis exercitationem vero.</p> --}}

                    <hr>

                    <div class="row">
                        <div class="col-md-4 form-group mb-3">
                            <label>Desde</label>
                            <input type="date" class="form-control" id="desde">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label>Hasta</label>
                            <input type="date" class="form-control" id="hasta">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label for="cliente">Cliente</label>
                            <select class="form-control chosen" id="cliente" data-size="6">
                                <option value=""></option>
                                @foreach($clientes as $item)
                                    <option value="{{ $item->id }}">{{ $item->razon_social }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table id="entradas_table" class="display table table-striped table-bordered table-sm"
                                   style="width:100%">
                                <thead>
                                <tr class="text-center">
                                    <th>Nro. Orden</th>
                                    <th>Compuesto</th>
                                    <th>Cajas</th>
                                    <th>Kilos</th>
                                    <th>Precio Venta</th>
                                    <th class="prom">Precio Materia Prima</th>
                                    <th class="prom">Precio Recolección</th>
                                    <th class="prom">Precio Manipulación</th>
                                    <th>Comentario 1</th>
                                    <th>Comentario 2</th>
                                    <th>Transporte</th>
                                    <th>Devoluciones</th>
                                    <th>Facturado</th>
                                    <th>Cobrado</th>
                                    <th>Totales</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (isset($pedidos))
                                    @foreach ($pedidos as $row)
                                        <tr>
                                            <td>{{ $row->nro_orden }}</td>
                                            <td>{{ $row->variable->compuesto->compuesto }}</td>
                                            <td class="text-right">{{ number_format($row->cajas, 2, ',', '.') }}</td>
                                            <td class="text-right">{{ number_format($row->kilos, 2, ',', '.') }}</td>
                                            <td class="text-right">{{ number_format($row->precio, 2, ',', '.') }}</td>
                                            <td class="text-right">0.00</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? $row->coste->recoleccion : '0.00' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? $row->coste->manipulacion : '0.00' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? $row->coste->comentario1 : '0.00' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? $row->coste->comentario2 : '0.00' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? $row->coste->transporte : '0.00' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? $row->coste->devoluciones : '0.00' }}</td>
                                            <td class="text-center">
                                                <label class="checkbox checkbox-success" style="display: inline-block">
                                                    <input type="checkbox"
                                                           {{ (!is_null($row->coste) && $row->coste->facturado) ? 'checked' : '' }} disabled>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="checkbox checkbox-success" style="display: inline-block">
                                                    <input type="checkbox"
                                                           {{ (!is_null($row->coste) && $row->coste->cobrado) ? 'checked' : '' }} disabled>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-right">0.00</td>
                                            <td class="text-center">
                                                @can('Costes | Modificar')
                                                    <a href="javascript:void(0);"
                                                       onclick="EditCoste({{ $row->pedido_id }})" data-toggle="tooltip"
                                                       data-placement="top" title="" data-original-title="Editar"
                                                       class="text-success mr-2">
                                                        <i class="nav-icon i-Pen-2 font-weight-bold "></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                {{--<tfoot>
                                        <tr class="text-right">
                                            <td colspan="7">Totales</td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="12"></td>
                                        </tr>
                                    </tfoot>--}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of col -->
    </div>

    {{--Modal Editar Costes--}}
    <div class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="modal_coste">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('costes.index') }}" method="POST" id="form_edit">

                    {{ csrf_field('PUT') }}

                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-cliente-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="nro_orden">Nro. Orden</label>
                                <input type="text" class="form-control" id="nro_orden">
                            </div>
                            <div class="col-md-8 mb-3">
                                <label for="compuesto">Compuesto</label>
                                <input type="text" class="form-control" id="compuesto">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cajas">Cajas</label>
                                <input type="number" class="form-control" id="cajas" step="0.01" readonly>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="kilos">Kilos</label>
                                <input type="number" class="form-control" id="kilos" step="0.01" readonly>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="precio">Precio Venta</label>
                                <input type="number" class="form-control" id="precio" step="0.01" readonly>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="costo">Precio Materia Prima</label>
                                <input type="number" class="form-control" id="costo" step="0.01" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="recoleccion">Precio Recolección</label>
                                <input type="number" class="form-control" id="recoleccion" step="0.01">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="manipulacion">Precio Manipulación</label>
                                <input type="number" class="form-control" id="manipulacion" step="0.01">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="comentario1">Comentario 1</label>
                                <input type="number" class="form-control" id="comentario1" step="0.01">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="comentario2">Comentario 2</label>
                                <input type="number" class="form-control" id="comentario2" step="0.01">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="transporte">Transporte</label>
                                <input type="number" class="form-control" id="transporte" step="0.01">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="devoluciones">Devoluciones</label>
                                <input type="number" class="form-control" id="devoluciones" step="0.01">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="checkbox checkbox-success" style="display: inline-block">
                                    <input type="checkbox" name="facturado" id="facturado">
                                    <span>Facturado</span>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="checkbox checkbox-success" style="display: inline-block">
                                    <input type="checkbox" name="cobrado" id="cobrado">
                                    <span>Cobrado</span>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="total">Totales</label>
                                <input type="number" class="form-control" id="total" step="0.01" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cerrar
                        </button>
                        @can('Costes | Modificar')
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        @endcan
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--Fin de Modal Editar Costes--}}
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/bootstrap-datepicker/bootstrap-datepicker.css')}}">
@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-select/i18n/defaults-es_ES.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/calendar/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-datepicker/bootstrap-datepicker.es.min.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

        function loadMaterial(valor, selected) {
            $.ajax({
                type: 'POST',
                url: "{{ route('entrada-productos.selectMaterial') }}",
                dataType: 'JSON',
                data: {
                    "categoria": valor
                },
                success: function (data) {
                    ClearMaterial();
                    if (data == null) return;

                    for (i = 0; i < data.length; i++) {
                        var value = data[i].id;
                        if (data[i].modelo != null && data[i].modelo != undefined && data[i].modelo != "") {
                            var text = data[i].formato + " | " + data[i].modelo;
                        } else {
                            var text = data[i].formato;
                        }

                        var option = "<option value='" + value + "'>" + text + "</option>";
                        $("#material").append(option);
                    }

                    if (selected != null) {
                        $("#material").val(selected).selectpicker('refresh');
                    } else {
                        $("#material").selectpicker('refresh');
                    }
                },
                error: function (error) {
                    console.log(error)
                    alert('Error. Check Console Log');
                },
            });
        }

        function ClearMaterial() {
            $("#material").html(null).append('<option value=""></option>');
        }

        function EditCoste(id) {


            $("#modal_coste").modal('show');
        }

    </script>

    {{--Entradas--}}
    <script>
        var entradas_table;

        $(document).ready(function () {
            // Configuracion de Datatable
            entradas_table = $('#entradas_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                dom: 'ltipr',
                responsive: true,
                // columnDefs: [{
                //     targets: [0, 2, 5, 11],
                //     visible: false
                // },],
                // footerCallback: function (row, data, start, end, display) {
                //     var api = this.api();
                //     api.columns('.sum', {
                //         page: 'current'
                //     }).every(function () {
                //         var sum = this
                //             .data()
                //             .reduce(function (a, b) {
                //                 var intVal = function (i) {
                //                     return typeof i === 'string' ?
                //                         i.replace(/[\$,]/g, '') * 1 :
                //                         typeof i === 'number' ?
                //                             i : 0;
                //                 };
                //
                //                 /*var regex = /[.,\s]/g;
                //                 var aa = a.toString();
                //                 var bb = b.toString();
                //                 var x = parseFloat(aa.replace(regex, '')) || 0;
                //                 var y = parseFloat(bb.replace(regex, '')) || 0;
                //                 return x + y;*/
                //                 return intVal(a) + intVal(b);
                //             }, 0);
                //         var signo = "";
                //         if (sum < 0) signo = "-";
                //         $(this.footer()).html(signo + sum.toFixed(2));
                //     });
                // }
            });

            $(".chosen").selectpicker({
                liveSearch: true
            });

            $('#categoria').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                var value = $(this).val();
                loadMaterial(value);
                entradas_table.column(4).search(value).draw();
            });

            $('#material').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                var value = $(this).val();
                entradas_table.column(5).search(value).draw();
            });

            $('#proveedor').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                var value = $(this).val();
                entradas_table.column(11).search(value).draw();
            });

            $("#albaran").change(function (e) {
                var valor = $(this).val();
                if (valor != "") {
                    var fecha = moment(valor).format('DD/MM/YYYY');
                    entradas_table.column(10).search(fecha).draw();
                } else {
                    entradas_table.column(10).search("").draw();
                }
            });

            $("#desde, #hasta").on("change", function (e) {
                var desde = $("#desde").val();
                var hasta = $("#hasta").val();

                entradas_table.draw(false);
            });

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $("#desde").val();
                    var max = $("#hasta").val();
                    var fecha = data[2];

                    var startDate = moment(min, "YYYY-MM-DD");
                    var endDate = moment(max, "YYYY-MM-DD");
                    var diffDate = moment(fecha, "YYYY-MM-DD");

                    if (
                        (min == "" || max == "") ||
                        (diffDate.isBetween(startDate, endDate, null, '[]'))
                    ) {
                        return true;
                    }
                    return false;
                }
            );

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
        });

    </script>


@endsection
