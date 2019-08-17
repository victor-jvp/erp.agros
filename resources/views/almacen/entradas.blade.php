@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Almacen</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Entrada de Productos</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Entrada de Productos</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}
                    <div class="row">
                        <div class="col-md-3">
                            <button class="btn btn-primary" type="button" id="btnNuevo">Nuevo</button>
                        </div>
                    </div>

                    <!-- Modal entradas-->
                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                         aria-hidden="true" id="modal-entradas">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="/almacen/entrada-productos" method="POST" id="entrada_form">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" id="entrada_method" value="PUT">
                                    <input type="hidden" name="id" id="entrada_id">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-entradas-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="nro_lote">Nro. Lote</label>
                                                <input type="hidden" value="{{ $nro_lote }}" id="nextNroLote">
                                                <input type="text" class="form-control" id="nro_lote" readonly>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="fecha">Fecha Entrada</label>
                                                <input type="date" class="form-control" id="fecha"
                                                       value="{{ date('Y-m-d') }}" placeholder="Fecha Entrada"
                                                       required=""
                                                       name="fecha">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="categoria">Categoria</label>
                                                <select class="form-control chosen" name="categoria" id="categoria"
                                                        data-placeholder="Seleccione...">
                                                    <option value=""></option>
                                                    @if (isset($categorias))
                                                        @foreach ($categorias as $categoria)
                                                            <option value="{{ $categoria['value'] }}">{{ $categoria['text'] }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="material">Material</label>
                                                <select class="form-control chosen" name="material" id="material"
                                                        data-placeholder="Seleccione...">
                                                    <option value=""></option>
                                                    @if (isset($cultivos))
                                                        @foreach ($cultivos as $cultivo)
                                                            <option value="{{ $cultivo->id }}">{{ $cultivo->cultivo }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="cantidad">Cantidad</label>
                                                <input type="number" class="form-control" id="cantidad" step="0.01"
                                                       placeholder="Cantidad" required="" name="cantidad">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="nro_albaran">Nro. Albarán</label>
                                                <input type="text" class="form-control" id="nro_albaran"
                                                       placeholder="Nro. Albarán" required="" name="nro_albaran">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="fecha_albaran">Fecha Albarán</label>
                                                <input type="date" class="form-control" id="fecha_albaran"
                                                       value="{{ date('Y-m-d') }}" placeholder="Fecha Albarán"
                                                       required=""
                                                       name="fecha_albaran">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="proveedor">Proveedor</label>
                                                <select class="form-control chosen" name="proveedor" id="proveedor"
                                                        data-placeholder="Seleccione...">
                                                    <option value=""></option>
                                                    @if (isset($proveedores))
                                                        @foreach ($proveedores as $proveedor)
                                                            <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="transporte_adecuado" checked>
                                                    <span>Transporte Adecuado</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="control_plagas" checked>
                                                    <span>Control de Plagas</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="estado_pallets" checked>
                                                    <span>Estado Pallets</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="ficha_tecnica" checked>
                                                    <span>Ficha Técnica</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="material_daniado">
                                                    <span>Material Dañado</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="material_limpio" checked>
                                                    <span>Material Limpio</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="control_grapas" checked>
                                                    <span>Control de Grapas</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="cantidad_conforme" checked>
                                                    <span>Cantidad Conforme</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar
                                        </button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <table id="entradas_table" class="display table table-striped table-bordered"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">N° Lote</th>
                                    <th scope="col">Fecha Entrada</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Material</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Nº Albaran</th>
                                    <th scope="col">Fecha Albaran</th>
                                    <th scope="col">Transporte Adecuado</th>
                                    <th scope="col">Control Plagas</th>
                                    <th scope="col">Estado Pallets</th>
                                    <th scope="col">Ficha Técnica</th>
                                    <th scope="col">Material Dañado</th>
                                    <th scope="col">Material Limpio</th>
                                    <th scope="col">Control Grapas</th>
                                    <th scope="col">Cantidad Conforme</th>
                                    <th scope="col">Proveedor</th>
                                    <th scope="col">Accion</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (isset($entradas))
                                    @foreach ($entradas as $entrada)
                                        <tr>
                                            <td>{{ $entrada->id }}</td>
                                            <td>{{ $entrada->nro_lote }}</td>
                                            <td>{{ date('d/m/Y',strtotime($entrada->fecha)) }}</td>
                                            @if($entrada->caja_id != null)
                                                <td>Caja</td>
                                                <td>{{ $entrada->caja->formato }}</td>
                                            @else
                                                <td>Pallet</td>
                                                <td>{{ $entrada->pallet->formato }}</td>
                                            @endif
                                            <td>{{ $entrada->cantidad }}</td>
                                            <td>{{ $entrada->nro_albaran }}</td>
                                            <td>{{ date('d/m/Y',strtotime($entrada->fecha_albaran)) }}</td>
                                            <td class="text-center">
                                                <label class="checkbox checkbox-success" style="display: inline-block">
                                                    <input disabled
                                                           type="checkbox" {{ ($entrada->transporte_adecuado) ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="checkbox checkbox-success" style="display: inline-block">
                                                    <input disabled
                                                           type="checkbox" {{ ($entrada->control_plagas) ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="checkbox checkbox-success" style="display: inline-block">
                                                    <input disabled
                                                           type="checkbox" {{ ($entrada->estado_pallets) ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="checkbox checkbox-success" style="display: inline-block">
                                                    <input disabled
                                                           type="checkbox" {{ ($entrada->ficha_tecnica) ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="checkbox checkbox-success" style="display: inline-block">
                                                    <input disabled
                                                           type="checkbox" {{ ($entrada->material_daniado) ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="checkbox checkbox-success" style="display: inline-block">
                                                    <input disabled
                                                           type="checkbox" {{ ($entrada->material_limpio) ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="checkbox checkbox-success" style="display: inline-block">
                                                    <input disabled
                                                           type="checkbox" {{ ($entrada->control_grapas) ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="checkbox checkbox-success" style="display: inline-block">
                                                    <input disabled
                                                           type="checkbox" {{ ($entrada->cantidad_conforme) ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td>{{ (!is_null($entrada->proveedor)) ? $entrada->proveedor->razon_social : "" }}</td>
                                            <td>
                                                <a href="javascript:void(0);" onclick="LoadEntrada({{ $entrada->id }})"
                                                   class="text-success mr-2">
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
            </div>
        </div>
        <!-- end of col -->
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
    <script src="{{asset('assets/js/vendor/calendar/moment.min.js')}}"></script>

    {{--Entradas--}}
    <script>
        var entradas_table;

        $(document).ready(function () {
            // Configuracion de Datatable
            entradas_table = $('#entradas_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0, 3], visible: false},
                ],
                responsive: true
            });

            $("#btnNuevo").click(function (e) {
                limpiarCamposEntrada();
                $("#modal-entradas-title").html("Nueva Entrada");
                var nextNroLote = $("#nextNroLote").val();
                $("#nro_lote").val(nextNroLote);
                $("#entrada_method").val(null);
                $("#modal-entradas").modal('show');
            });

            $('#entradas_table').on('click', '.delete', function () {
                var tr = $(this).closest('tr');
                var row = entradas_table.row(tr).data();
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
                    window.location.href = "{{ url('almacen/entrada-productos/delete') }}" + "/" + row[0];
                })
            });
        });

        function LoadEntrada(id) {
            limpiarCamposEntrada();
            // var current_row = $(this).parents('tr');//Get the current row
            // if (current_row.hasClass('child')) {//Check if the current row is a child row
            //     current_row = current_row.prev();//If it is, then point to the row before it (its 'parent')
            // }
            // var row = entradas_table.row(current_row).data();//At this point, current_row refers to a valid row in the table, whether is a child row (collapsed by the DataTable's responsiveness) or a 'normal' row

            $.ajax({
                type: 'POST',
                url: "{{ route('entrada-productos.GetEntrada') }}",
                dataType: 'JSON',
                data: {
                    id: id
                },
                success: function (data) {
                    if (data == null) return;

                    $("#nro_lote").val(data.nro_lote);
                    $("#fecha").val(moment(data.fecha).format("YYYY-MM-DD"));
                    var material = null;
                    if (data.pallet_id != null) {
                        $('#categoria').val("pallets").trigger('chosen:updated');
                        material = data.pallet_id;
                        loadMaterial("pallets", material)
                    } else {
                        $('#categoria').val("cajas").trigger('chosen:updated');
                        material = data.caja_id;
                        loadMaterial("cajas", material)
                    }
                    $("#cantidad").val(data.cantidad);
                    $("#nro_albaran").val(data.nro_albaran);
                    $("#fecha_albaran").val(moment(data.fecha_albaran).format("YYYY-MM-DD"));
                    $("input[name='transporte_adecuado']").prop('checked', (data.transporte_adecuado == 1));
                    $("input[name='control_plagas']").prop('checked', (data.control_plagas == 1));
                    $("input[name='estado_pallets']").prop('checked', (data.estado_pallets == 1));
                    $("input[name='ficha_tecnica']").prop('checked', (data.ficha_tecnica == 1));
                    $("input[name='material_daniado']").prop('checked', (data.material_daniado == 1));
                    $("input[name='material_limpio']").prop('checked', (data.material_limpio == 1));
                    $("input[name='control_grapas']").prop('checked', (data.control_grapas == 1));
                    $("input[name='cantidad_conforme']").prop('checked', (data.cantidad_conforme == 1));
                    $('#proveedor').val(data.proveedor_id).trigger('chosen:updated');

                    $('#entrada_form').attr('action', '/almacen/entrada-productos/' + data.id);

                    $("#modal-entradas-title").html("Modificar Entrada");
                    $("#entrada_method").val('PUT');
                    $("#modal-entradas").modal('show');
                },
                error: function (error) {
                    console.log(error)
                    alert('Error. Check Console Log');
                },
            });
        }

        function limpiarCamposEntrada() {
            $('#nro_lote, #fecha, #cantidad, #nro_albaran, #fecha_albaran').val(null);
            $(".chosen").val(null).trigger('chosen:updated');
            $("input[type=checkbox]").prop('checked', true);
            $("input[name='material_daniado']").prop("checked", false);
        }
    </script>

    <script>
        $(document).ready(function () {
            $(".chosen").chosen({
                width: "100%",
                no_results_text: "No se encontraron resultados... ",
                allow_single_deselect: true
            });
        })
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#categoria').on('change', function (evt, params) {
                var value = $(this).val();
                loadMaterial(value);
            });
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
                        var text = data[i].formato;
                        var option = "<option value='" + value + "'>" + text + "</option>";
                        $("#material").append(option);
                    }

                    if (selected != null) {
                        $("#material").val(selected).trigger('chosen:updated');
                    } else {
                        $("#material").trigger('chosen:updated');
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

    </script>
@endsection