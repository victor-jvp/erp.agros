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
                        <div class="col-md-3 form-group mb-3">
                            <label>Desde</label>
                            <input type="date" class="form-control" id="desde">
                        </div>
                        <div class="col-md-3 form-group mb-3">
                            <label>Hasta</label>
                            <input type="date" class="form-control" id="hasta">
                        </div>
                        <div class="col-md-3 form-group mb-3">
                            <label for="_cliente">Cliente</label>
                            <select class="form-control chosen" id="_cliente" data-size="6">
                                <option value=""></option>
                                @foreach($clientes as $item)
                                    <option value="{{ $item->razon_social }}">{{ $item->razon_social }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 form-group mb-3">
                            <label for="_compuesto">Compuesto</label>
                            <select class="form-control chosen" id="_compuesto" data-size="6">
                                <option value=""></option>
                                @foreach($compuestos as $item)
                                    @php($compuesto = $item->variable." - ".$item->caja->formato." - ".$item->caja->modelo)
                                    <option value="{{ $compuesto }}">{{ $compuesto }}</option>
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
                                    <th>Cliente</th>
                                    <th>Compuesto</th>
                                    <th class="sum">Cajas</th>
                                    <th class="sum">Kilos</th>
                                    <th class="sum">Precio Venta</th>
                                    <th class="sum">Precio Materia Prima</th>
                                    <th class="sum">Precio Recolección</th>
                                    <th class="sum">Precio Manipulación</th>
                                    <th class="sum">Comentario 1</th>
                                    <th class="sum">Comentario 2</th>
                                    <th class="sum">Transporte</th>
                                    <th class="sum">Devoluciones</th>
                                    <th>Facturado</th>
                                    <th>Cobrado</th>
                                    <th class="sum">Totales</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (isset($pedidos))
                                    @foreach ($pedidos as $row)
                                        <tr>
                                            <td>{{ $row->nro_orden }}</td>
                                            <td>{{ $row->cliente->razon_social }}</td>
                                            <td>{{ $row->variable->variable." - ".$row->variable->caja->formato." - ".$row->variable->caja->modelo }}</td>
                                            <td class="text-right">{{ round($row->cajas, 2) }}</td>
                                            <td class="text-right">{{ $row->kilos }}</td>
                                            <td class="text-right">{{ (!is_null($row->pedido_comercial)) ? round($row->pedido_comercial->precio,2) : "0" }}</td>
                                            <td class="text-right">{{ round($row->precio_mp, 2) }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? round($row->coste->recoleccion, 2) : '0' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? round($row->coste->manipulacion, 2) : '0' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? round($row->coste->comentario1, 2) : '0' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? round($row->coste->comentario2, 2) : '0' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? round($row->coste->transporte, 2) : '0' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? round($row->coste->devoluciones, 2) : '0' }}</td>
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
                                            <td class="text-right">0</td>
                                            <td class="text-center">
                                                @can('Costes | Modificar')
                                                    <a href="javascript:void(0);"
                                                       onclick="EditCoste({{ $row->id }})" data-toggle="tooltip"
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
                                <tfoot>
                                <tr class="text-right">
                                    <th colspan="3">Totales</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th colspan="2"></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </tfoot>
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
                <form action="{{ route('costes.update') }}" method="POST" id="form_edit">

                    {{ csrf_field('PUT') }}

                    <input type="hidden" id="id" name="id">

                    <div class="modal-header">
                        <h5 class="modal-title">Datos del Pedido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="nro_orden">Nro. Orden</label>
                                <input type="text" class="form-control" id="nro_orden" readonly="">
                            </div>
                            <div class="col-md-8 mb-3">
                                <label for="compuesto">Compuesto</label>
                                <input type="text" class="form-control" id="compuesto" readonly>
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
                                <input type="number" class="form-control" id="precio_mp" step="0.01" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="recoleccion">Precio Recolección</label>
                                <input type="number" class="form-control" id="recoleccion" name="recoleccion"
                                       step="0.01">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="manipulacion">Precio Manipulación</label>
                                <input type="number" class="form-control" id="manipulacion" name="manipulacion"
                                       step="0.01">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="comentario1">Comentario 1</label>
                                <input type="number" class="form-control" id="comentario1" name="comentario1"
                                       step="0.01">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="comentario2">Comentario 2</label>
                                <input type="number" class="form-control" id="comentario2" name="comentario2"
                                       step="0.01">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="transporte">Transporte</label>
                                <input type="number" class="form-control" id="transporte" name="transporte" step="0.01">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="devoluciones">Devoluciones</label>
                                <input type="number" class="form-control" id="devoluciones" name="devoluciones"
                                       step="0.01">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="checkbox checkbox-success" style="display: inline-block">
                                    <input type="checkbox" name="facturado" id="facturado" name="facturado">
                                    <span>Facturado</span>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="checkbox checkbox-success" style="display: inline-block">
                                    <input type="checkbox" name="cobrado" id="cobrado" name="cobrado">
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
            if (id == null || id == "") return;
            $.ajax({
                type: 'GET',
                url: "{{ route('costes.details') }}",
                dataType: 'JSON',
                data: {
                    id: id
                },
                success: function (data) {
                    if (data == null) return;

                    $("#id").val(id);
                    $("#nro_orden").val(data.nro_orden);
                    $("#compuesto").val(data.variable.variable + ' - ' + data.variable.caja.formato + ' - ' + data.variable.caja.modelo);
                    $("#cajas").val(data.cajas);
                    $("#kilos").val(data.kilos);
                    $("#precio").val(data.pedido_comercial.precio);
                    $("#precio_mp").val(data.precio_mp);
                    $("#recoleccion").val(data.coste.recoleccion);
                    $("#manipulacion").val(data.coste.manipulacion);
                    $("#comentario1").val(data.coste.comentario1);
                    $("#comentario2").val(data.coste.comentario2);
                    $("#transporte").val(data.coste.transporte);
                    $("#devoluciones").val(data.coste.devoluciones);
                    if (data.coste.facturado) $("#facturado").prop('checked', true); else $("#facturado").prop('checked', false);
                    if (data.coste.cobrado) $("#cobrado").prop('checked', true); else $("#cobrado").prop('checked', false);
                    var total = data.kilos * data.precio;
                    $("#total").val(total.toFixed(2));

                    CalcularTotal();

                    $("#modal_coste").modal('show');
                },
                error: function (error) {
                    console.log(error);
                    alert('Error. Check Console Log');
                },
            });
        }

        function CalcularTotal() {
            var manipulacion = parseFloat($("#manipulacion").val());
            var comentario1 = parseFloat($("#comentario1").val());
            var comentario2 = parseFloat($("#comentario2").val());
            var transporte = parseFloat($("#transporte").val());
            var devoluciones = parseFloat($("#devoluciones").val());
            var precio_mp = parseFloat($("#precio_mp").val());

            var total = manipulacion + comentario1 + comentario2 + transporte + devoluciones;
            $("#total").val(total);
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
                // columnDefs: [
                //     {
                //         targets: [1, 3],
                //         visible: false
                //     },
                // ],
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

            $(".chosen").selectpicker({
                liveSearch: true
            });

            $('#_cliente').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                var value = $(this).val();
                entradas_table.column(1).search(value).draw();
            });

            $('#_compuesto').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                var value = $(this).val();
                entradas_table.column(2).search(value).draw();
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
        });

    </script>


@endsection
