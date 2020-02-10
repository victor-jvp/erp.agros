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

                    <form action="{{ route('costes.pdf.list') }}" method="GET">

                        <div class="row">
                            <div class="col-md-3 form-group mb-3">
                                <label>Desde</label>
                                <input type="date" class="form-control" id="desde" name="desde">
                            </div>
                            <div class="col-md-3 form-group mb-3">
                                <label>Hasta</label>
                                <input type="date" class="form-control" id="hasta" name="hasta">
                            </div>
                            <div class="col-md-3 form-group mb-3">
                                <label for="_cliente">Cliente</label>
                                <select class="form-control chosen" id="_cliente" data-size="6" name="cliente">
                                    <option value=""></option>
                                    @foreach($clientes as $item)
                                        <option value="{{ $item->id }}">{{ $item->razon_social }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group mb-3">
                                <label for="_compuesto">Compuesto</label>
                                <select class="form-control chosen" id="_compuesto" data-size="6" name="compuesto">
                                    <option value=""></option>
                                    @foreach($compuestos as $item)
                                        @php($compuesto = $item->variable." - ".$item->caja->formato." - ".$item->caja->modelo)
                                        <option value="{{ $item->id }}">{{ $compuesto }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-9 mb-3">
                                <label for="">Categoria</label>
                                <div class="row">
                                    <div class="col-md-2 mb-3">
                                        <label class="radio radio-success">
                                            <input class="categoria" type="radio" name="categoria" value="" checked>
                                            <span>Todos</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>

                                    @foreach($categorias as $item)
                                        <div class="col-md-2 mb-3">
                                            <label class="radio radio-success">
                                                <input class="categoria" type="radio" value="{{ $item->id }}"
                                                       name="categoria">
                                                <span>{{ $item->name }}</span>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">

                                <label for="">Vista</label>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="radio radio-primary">
                                            <input type="radio" class="vista" name="vista" id="vista_totales"
                                                   value="totales" checked>
                                            <span>Totales</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-primary">
                                            <input type="radio" class="vista" name="vista" id="vista_kgs" value="kgs">
                                            <span>Kgs.</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>

                                    <div class="col-md-6 mb-3 text-right">
                                        <button type="submit" formtarget="_blank"
                                                class="btn btn-primary mb-sm-0 mb-3 print-invoice">Reporte
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="entradas_table"
                                       class="display table table-striped table-sm table-condensed"
                                       style="width:100%">
                                    <thead>
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Nro. Orden</th>
                                        <th>Fecha Orden</th>
                                        <th>cliente_id</th>
                                        <th>Cliente</th>
                                        <th>producto_id</th>
                                        <th>Compuesto</th>
                                        <th>categoria_id</th>
                                        <th>Categoria</th>
                                        <th class="sum">Cajas</th>
                                        <th class="sum">Kilos</th>

                                        <th class="sum kgs">Precio Venta</th>
                                        <th class="sum kgs">Precio Materiales</th>
                                        <th class="sum kgs">Precio Recolección</th>
                                        <th class="sum kgs">Precio Manipulación</th>
                                        <th class="sum kgs">Comentario 1</th>
                                        <th class="sum kgs">Comentario 2</th>
                                        <th class="sum kgs">Transporte</th>
                                        <th class="sum kgs">Devoluciones</th>

                                        <th class="sum total">Precio Venta</th>
                                        <th class="sum total">Precio Materiales</th>
                                        <th class="sum total">Precio Recolección</th>
                                        <th class="sum total">Precio Manipulación</th>
                                        <th class="sum total">Comentario 1</th>
                                        <th class="sum total">Comentario 2</th>
                                        <th class="sum total">Transporte</th>
                                        <th class="sum total">Devoluciones</th>

                                        <th>Facturado</th>
                                        <th>Cobrado</th>

                                        <th class="sum total">Total Gastos</th>
                                        <th class="sum total">Beneficio</th>
                                        <th>Porcentaje</th>

                                        <th class="sum total">Total Gastos</th>
                                        <th class="sum total">Beneficio</th>
                                        <th>Porcentaje</th>

                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($pedidos as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <th>{{ $row->nro_orden }}</th>
                                            <td>{{ date('Y-m-d', strtotime($row->FechaOrden)) }}</td>
                                            <td>{{ $row->cliente_id }}</td>
                                            <td>{{ $row->cliente->razon_social }}</td>
                                            <td>{{ $row->producto_id }}</td>
                                            <td>{{ $row->variable->variable." - ".$row->variable->caja->formato." - ".$row->variable->caja->modelo }}</td>
                                            <td>{{ (is_null($row->variable->categoria_id)) ? "" : $row->variable->categoria_id }}</td>
                                            <td>{{ (is_null($row->variable->categoria)) ? "" : $row->variable->categoria->name }}</td>
                                            <td class="text-right">{{ round($row->cajas, 2) }}</td>
                                            <td class="text-right">{{ $row->kilos }}</td>

                                            <td class="text-right">{{ (!is_null($row->pedido_comercial)) ? round($row->pedido_comercial->precio, 2) : "0" }}</td>
                                            <td class="text-right">{{ round($row->precio_mp / $row->kilos, 2) }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? round($row->coste->recoleccion / $row->kilos, 2) : '0' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? round($row->coste->manipulacion / $row->kilos, 2) : '0' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? round($row->coste->comentario1 / $row->kilos, 2) : '0' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? round($row->coste->comentario2 / $row->kilos, 2) : '0' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? round($row->coste->transporte / $row->kilos, 2) : '0' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? round($row->coste->devoluciones / $row->kilos, 2) : '0' }}</td>

                                            <td class="text-right">{{ (!is_null($row->pedido_comercial)) ? round($row->pedido_comercial->precio * $row->kilos, 2) : "0" }}</td>
                                            <td class="text-right">{{ round($row->precio_mp, 2) }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? round($row->coste->recoleccion, 2) : '0' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? round($row->coste->manipulacion, 2) : '0' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? round($row->coste->comentario1, 2) : '0' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? round($row->coste->comentario2, 2) : '0' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? round($row->coste->transporte, 2) : '0' }}</td>
                                            <td class="text-right">{{ (!is_null($row->coste)) ? round($row->coste->devoluciones, 2) : '0' }}</td>

                                            <td class="text-center">
                                                <label class="checkbox checkbox-success"
                                                       style="display: inline-block">
                                                    <input type="checkbox"
                                                           {{ (!is_null($row->coste) && $row->coste->facturado) ? 'checked' : '' }} disabled>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="checkbox checkbox-success"
                                                       style="display: inline-block">
                                                    <input type="checkbox"
                                                           {{ (!is_null($row->coste) && $row->coste->cobrado) ? 'checked' : '' }} disabled>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <?php
                                            $kgsGasto = 0;
                                            $kgsBeneficio = 0;
                                            $kgsPorc = 0;
                                            $totalGasto = 0;
                                            $totalBeneficio = 0;
                                            $totalPorc = 0;
                                            if (!is_null($row->coste)) {
                                                $item         = $row->coste;
                                                $kgsGasto     = ($item->precio_mp / $row->kilos) + ($item->recoleccion / $row->kilos) + ($item->manipulacion / $row->kilos) + ($item->comentario1 / $row->kilos) + ($item->comentario2 / $row->kilos) + ($item->transporte / $row->kilos) + ($item->devoluciones / $row->kilos);
                                                $kgsBeneficio = (!is_null($row->pedido_comercial)) ? $row->pedido_comercial->precio : 0;

                                                if ($kgsBeneficio > 0) {
                                                    if ($kgsGasto > 0) {
                                                        $kgsPorc = (round((($kgsBeneficio / $kgsGasto) - 1), 2));
                                                    }
                                                    else {
                                                        $kgsPorc = 100;
                                                    }
                                                }

                                                $totalGasto     = $item->precio_mp + $item->recoleccion + $item->manipulacion + $item->comentario1 + $item->comentario2 + $item->transporte + $item->devoluciones;
                                                $totalBeneficio = ((!is_null($row->pedido_comercial)) ? $row->pedido_comercial->precio : 0) * $row->kilos;

                                                if ($totalBeneficio > 0) {
                                                    if ($totalGasto > 0) {
                                                        $totalPorc = (round((($totalBeneficio / $totalGasto) - 1), 2));
                                                    }
                                                    else {
                                                        $totalPorc = 100;
                                                    }
                                                }
                                            }
                                            ?>
                                            <td class="text-right">{{ $kgsGasto }}</td>
                                            <td class="text-right">{{ $kgsBeneficio }}</td>
                                            <td class="text-right">{{ $kgsPorc }}</td>

                                            <td class="text-right">{{ $totalGasto }}</td>
                                            <td class="text-right">{{ $totalBeneficio }}</td>
                                            <td class="text-right">{{ $totalPorc }}</td>

                                            <td class="text-center">
                                                @can('Costes | Modificar')
                                                    <a href="javascript:void(0);"
                                                       onclick="EditCoste({{ $row->id }})" data-toggle="tooltip"
                                                       data-placement="top" title=""
                                                       data-original-title="Editar"
                                                       class="text-success mr-2">
                                                        <i class="nav-icon i-Pen-2 font-weight-bold "></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr class="text-right">
                                        <th colspan="9">Totales</th>
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
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <!-- end of col -->
    </div>

    <form action="{{ route('costes.update') }}" method="POST" id="form_edit">

        {{ csrf_field('PUT') }}

        {{--Modal Editar Costes--}}
        <div class="modal fade" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="modal_coste">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

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
                                <label for="cliente">Cliente</label>
                                <input type="text" class="form-control" id="cliente" readonly="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
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
                                <label for="precio_mp">Precio Materiales</label>
                                <input type="number" class="form-control" id="precio_mp" step="0.01" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="recoleccion">Precio Recolección</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <a href="javascript:void(0);" class="input-group-text" data-toggle="modal"
                                           data-target="#modal_recolecciones">
                                            <i class="i-Information"></i>
                                        </a>
                                    </div>
                                    <input type="number" class="form-control" id="recoleccion" name="recoleccion"
                                           readonly step="0.01" value="0">
                                </div>
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
                                <input type="number" class="form-control" id="transporte" name="transporte"
                                       step="0.01">
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

                </div>
            </div>
        </div>
        {{--Fin de Modal Editar Costes--}}

        {{--Modal Recolecciones--}}
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_recolecciones">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Recolecciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="trazabilidad">Trazabilidad</label>
                                <select class="form-control chosen" id="trazabilidad" data-size="6"
                                        data-show-subtext="true" name="trazabilidad">
                                    <option value=""></option>
                                    @foreach($trazabilidades as $item)
                                        <option data-subtext="{{ $item->variedad->cultivo->cultivo }}"
                                                value="{{ $item->id }}">{{ $item->traza }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <label for="precio_recoleccion">Precio</label>
                                <input type="number" class="form-control" id="precio_recoleccion" step="0.01"
                                       min="0.01"
                                       name="precio_recoleccion">
                            </div>

                            <div class="col-md-2 form-group mb-3">
                                <label>Agregar</label>
                                <button class="btn btn-primary btn-sm" type="button" onclick="addRecoleccion()">
                                    <i class="i i-Add"></i>
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-hover table-sm table-condensed" width="100%"
                                       id="table_recolecciones">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Traza</th>
                                        <th>Precio</th>
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>

                </div>
            </div>
        </div>

    </form>
    {{--Fin de Modal Recolecciones--}}
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
    <script src="{{asset('assets/js/vendor/jquery.validation/additional-methods.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/jquery.validation/messages_es.js')}}"></script>

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
        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
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
                    $("#cliente").val(data.cliente.razon_social);
                    $("#compuesto").val(data.variable.variable + ' - ' + data.variable.caja.formato + ' - ' + data.variable.caja.modelo);
                    $("#cajas").val(data.cajas);
                    $("#kilos").val(data.kilos);
                    $("#precio").val(data.pedido_comercial.precio * data.pedido_comercial.kilos);
                    $("#precio_mp").val(data.precio_mp);
                    $("#recoleccion").val(data.recoleccion);
                    $("#manipulacion").val(data.coste.manipulacion);
                    $("#comentario1").val(data.coste.comentario1);
                    $("#comentario2").val(data.coste.comentario2);
                    $("#transporte").val(data.coste.transporte);
                    $("#devoluciones").val(data.coste.devoluciones);
                    if (data.coste.facturado) $("#facturado").prop('checked', true); else $("#facturado").prop('checked', false);
                    if (data.coste.cobrado) $("#cobrado").prop('checked', true); else $("#cobrado").prop('checked', false);
                    var total = data.kilos * data.precio;
                    $("#total").val(total.toFixed(2));

                    recolecciones_table.rows().remove().draw();

                    for (var i = 0; i < data.trazabilidades.length; i++) {
                        var row = data.trazabilidades[i];
                        var opciones = '<a href="javascript:void(0);" class="text-danger mr-2"\n' +
                            'data-toggle="tooltip" data-placement="right" title=""\n' +
                            'data-original-title="Borrar" onclick="RemoveTrazabilidad(this)">\n' +
                            '<i class="nav-icon i-Close-Window font-weight-bold "></i>\n' +
                            '</a>';

                        recolecciones_table.row.add([
                            row.id,
                            row.trazabilidad.traza,
                            row.precio,
                            opciones +
                            '<input type="hidden" name="trazabilidades[]" value="' + row.trazabilidad_id + '">' +
                            '<input type="hidden" name="precios[]" value="' + row.precio + '">',
                        ]).draw();
                    }

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
        var recolecciones_table;

        $(document).ready(function () {
            $('[rel="tooltip"]').on('click', function () {
                $(this).tooltip('hide')
            });

            var colStart = 10;
            var columns = [
                (colStart + 1),
                (colStart + 2),
                (colStart + 3),
                (colStart + 4),
                (colStart + 5),
                (colStart + 6),
                (colStart + 7),
                (colStart + 8),
                (colStart + 9),
                (colStart + 10),
                (colStart + 11),
                (colStart + 12),
                (colStart + 13),
                (colStart + 14),
                (colStart + 15),
                (colStart + 16),
                (colStart + 19),
                (colStart + 20),
                (colStart + 21),
                (colStart + 22),
                (colStart + 23),
                (colStart + 24),
            ];

            // Configuracion de Datatable
            entradas_table = $('#entradas_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                dom: 'ltipr',
                columnDefs: [
                    {targets: [0, 3, 5, 7], visible: false},
                    {targets: [columns], visible: false},
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
                        $(this.footer()).html(sum.toFixed(2));
                    });
                },
                responsive: true,
                ordering: [[0, 'desc']]
            });

            recolecciones_table = $("#table_recolecciones").DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                dom: 'ltipr',
                responsive: true,
                columnDefs: [
                    {targets: 0, visible: false},
                    {targets: 2, className: 'text-right'},
                ]
            });

            $(".chosen").selectpicker({
                liveSearch: true
            });

            $('#_cliente').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                var value = $(this).val();
                regex = value ? '^' + value + '$' : '';
                entradas_table.column(3).search(regex, true, false).draw();
            });

            $('#_compuesto').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                var value = $(this).val();
                regex = value ? '^' + value + '$' : '';
                entradas_table.column(5).search(regex, true, false).draw();
            });

            $(".categoria").on('change', function () {
                var value = $(this).val();
                entradas_table.column(7).search(value).draw();
            });

            $(".vista").on('change', function () {
                var vista = $(this).val();
                activeColumns(vista);
            });

            activeColumns();

            /*            $("#albaran").change(function (e) {
                            var valor = $(this).val();
                            if (valor != "") {
                                var fecha = moment(valor).format('DD/MM/YYYY');
                                entradas_table.column(12).search(fecha).draw();
                            } else {
                                entradas_table.column(12).search("").draw();
                            }
                        });*/

            $("#desde, #hasta").on("change", function (e) {
                var desde = $("#desde").val();
                var hasta = $("#hasta").val();

                entradas_table.draw(false);
            });

            $("#form_edit").validate({
                ignore: '',
            });
        });

        function activeColumns(vista = null) {
            if (vista == null) {
                $("#vista_totales").prop('checked', true);
                vista = "totales";
            }
            var colStart = 10;
            var kgsColumns = [
                (colStart + 1),
                (colStart + 2),
                (colStart + 3),
                (colStart + 4),
                (colStart + 5),
                (colStart + 6),
                (colStart + 7),
                (colStart + 8),
                (colStart + 19),
                (colStart + 20),
                (colStart + 21),
            ];
            colStart = (colStart + 8);
            var totalColumns = [
                (colStart + 1),
                (colStart + 2),
                (colStart + 3),
                (colStart + 4),
                (colStart + 5),
                (colStart + 6),
                (colStart + 7),
                (colStart + 8),
                (colStart + 14),
                (colStart + 15),
                (colStart + 16),
            ];

            if (vista === "kgs") {
                entradas_table.columns(kgsColumns).visible(true);
                entradas_table.columns(totalColumns).visible(false);
            }
            if (vista === "totales") {
                entradas_table.columns(kgsColumns).visible(false);
                entradas_table.columns(totalColumns).visible(true);
            }
        }

        function addRecoleccion() {
            var trazabilidad_id = $("#trazabilidad").val();
            if (trazabilidad_id == null || trazabilidad_id === "") {
                swal('Aviso', 'El campo "Trazabilidad" es requerido', 'warning');
                return;
            }
            var trazabilidad = $("#trazabilidad").find('option:selected').html();

            var precio = $("#precio_recoleccion").val();
            if (precio == null || precio === "") {
                swal('Aviso', 'El campo "Precio" es requerido', 'warning');
                return;
            }

            var opciones = '<a href="javascript:void(0);" class="text-danger mr-2"\n' +
                'data-toggle="tooltip" data-placement="right" title=""\n' +
                'data-original-title="Borrar" onclick="RemoveTrazabilidad(this)">\n' +
                '<i class="nav-icon i-Close-Window font-weight-bold "></i>\n' +
                '</a>';

            recolecciones_table.row.add([
                trazabilidad_id,
                trazabilidad.toString(2),
                precio,
                opciones +
                '<input type="hidden" name="trazabilidades[]" value="' + trazabilidad_id + '">' +
                '<input type="hidden" name="precios[]" value="' + precio + '">',
            ]).draw();

            var suma = recolecciones_table.column(2).data().sum();
            $("#recoleccion").val(suma);

            $("#trazabilidad").val(null).selectpicker('refresh');
            $("#precio_recoleccion").val(null);
        }

        function RemoveTrazabilidad(elem) {
            var tr = $(elem).closest('tr');
            recolecciones_table.row(tr).remove().draw(false);
            var suma = recolecciones_table.column(2).data().sum();
            $("#recoleccion").val(suma);
        }
    </script>

    <script>

    </script>
@endsection
