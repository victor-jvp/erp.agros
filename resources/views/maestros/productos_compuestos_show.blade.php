@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Maestros</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Productos Compuestos</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">
                        {!! (isset($producto->cultivo)) ? "Cultivo: <b>".$producto->cultivo->cultivo."</b><br>" : "" !!}
                        Producto: <b>{{ $producto->compuesto }}</b></h4>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="producto">Fecha</label>
                            <input type="date" class="form-control" id="fecha" disabled
                                   value="{{ date('Y-m-d', strtotime($producto->fecha)) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <button class="btn btn-primary" type="button" id="btnNuevoDetalle">Agregar Detalle
                            </button>
                        </div>
                    </div>

                    {{--Modal Producto Compuesto--}}
                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                         aria-hidden="true" id="modal-producto">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="/maestros/productos-compuestos/store" method="POST" id="producto_form">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <input type="hidden" name="compuesto_id" id="compuesto_id"
                                           value="{{ $producto->id }}">
                                    <input type="hidden" name="id" id="det_id" value="">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-producto-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="variable">Variable</label>
                                                <input type="text" class="form-control" id="variable"
                                                       placeholder="Variable"
                                                       required="" name="variable">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="caja_id">Caja</label>
                                                <select name="caja_id" id="caja_id" class="form-control chosen"
                                                        data-placeholder="Seleccione...">
                                                    <option value=""></option>
                                                    @if (isset($cajas))
                                                        @foreach ($cajas as $caja)
                                                            <option value="{{ $caja->id }}">{{ $caja->formato.' | '.$caja->modelo }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="tarrina_modelo">Tarrina</label>
                                                <select id="tarrina_modelo" class="form-control chosen"
                                                        data-placeholder="Seleccione...">
                                                    <option value=""></option>
                                                    @if (isset($tarrinas))
                                                        @foreach ($tarrinas as $tarrina)
                                                            <option value="{{ $tarrina->id }}">{{ $tarrina->modelo }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="tarrina_cantidad">Cantidad</label>
                                                <input type="number" class="form-control" id="tarrina_cantidad"
                                                       placeholder="Cantidad" step="0.01" min="0.00">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <br>
                                                <button id="btnAddTarrina" type="button" data-index=""
                                                        class="btn btn-success btn-icon">
                                                    <i class="i-Add"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="auxiliar_modelo">Auxiliar</label>
                                                <select id="auxiliar_modelo" class="form-control chosen"
                                                        data-placeholder="Seleccione...">
                                                    <option value=""></option>
                                                    @if (isset($auxiliares))
                                                        @foreach ($auxiliares as $auxiliar)
                                                            <option value="{{ $auxiliar->id }}">{{ $auxiliar->modelo }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="auxiliar_cantidad">Cantidad</label>
                                                <input type="number" class="form-control" id="auxiliar_cantidad"
                                                       placeholder="Cantidad" step="0.01" min="0.00">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <br>
                                                <button id="btnAddAuxiliar" type="button" data-index=""
                                                        class="btn btn-success btn-icon">
                                                    <i class="i-Add"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <div class="table-responsive">
                                                    <table id="tarrinas_auxiliares_table"
                                                           class="display table table-striped table-bordered"
                                                           style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th>modelo_id</th>
                                                            <th scope="col">Tarrina | Auxiliar</th>
                                                            <th scope="col">Desripción</th>
                                                            <th scope="col">Cantidad</th>
                                                            <th scope="col">Acción</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active show" id="EuroPallet-tab"
                                                           data-toggle="tab" href="#EuroPallet" role="tab"
                                                           aria-controls="EuroPallet" aria-selected="true">Euro
                                                            Palet</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="PalletGrande-tab" data-toggle="tab"
                                                           href="#PalletGrande" role="tab" aria-controls="PalletGrande"
                                                           aria-selected="false">Palet Grande</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade active show" id="EuroPallet"
                                                         role="tabpanel"
                                                         aria-labelledby="EuroPallet-tab">

                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="euro_cantidad">Cantidad</label>
                                                                <input type="number" class="form-control"
                                                                       id="euro_cantidad"
                                                                       placeholder="Cantidad de cajas"
                                                                       name="euro_cantidad" step="0.01" min="0.00">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="euro_pallet_id">Kilogramos</label>
                                                                <input type="number" class="form-control" id="euro_kg"
                                                                       placeholder="Kg" name="euro_kg" step="0.01"
                                                                       min="0.00">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="euro_cantoneras">Cantoneras</label>
                                                                <input type="text" class="form-control"
                                                                       id="euro_cantoneras"
                                                                       placeholder="Cantoneras" name="euro_cantoneras">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="euro_cubre_id">Cubres</label>
                                                                <select name="euro_cubre_id" id="euro_cubre_id"
                                                                        class="form-control chosen"
                                                                        data-placeholder="Seleccione...">
                                                                    <option value=""></option>
                                                                    @if (isset($cubres))
                                                                        @foreach ($cubres as $cubre)
                                                                            <option value="{{ $cubre->id }}">{{ $cubre->formato }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="euro_cubre_cantidad">Cantidad
                                                                    Cubres</label>
                                                                <input type="number" class="form-control"
                                                                       id="euro_cubre_cantidad"
                                                                       placeholder="Cantidad Cubres"
                                                                       name="euro_cubre_cantidad" step="0.01"
                                                                       min="0.00">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="euro_auxiliar_modelo">Auxiliar</label>
                                                                <select id="euro_auxiliar_modelo"
                                                                        class="form-control chosen"
                                                                        data-placeholder="Seleccione...">
                                                                    <option value=""></option>
                                                                    @if (isset($auxiliares))
                                                                        @foreach ($auxiliares as $auxiliar)
                                                                            <option value="{{ $auxiliar->id }}">
                                                                                {{ $auxiliar->modelo }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="euro_auxiliar_cantidad">Cantidad</label>
                                                                <input type="number" class="form-control"
                                                                       id="euro_auxiliar_cantidad"
                                                                       placeholder="Cantidad"
                                                                       step="0.01" min="0.00">
                                                            </div>
                                                            <div class="col-md-2 mb-3">
                                                                <br>
                                                                <button id="btnAddEuroAuxiliar" type="button"
                                                                        data-index=""
                                                                        class="btn btn-success btn-icon">
                                                                    <i class="i-Add"></i>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 mb-3">
                                                                <div class="table-responsive">
                                                                    <table id="euro_auxiliares_table"
                                                                           class="display table table-striped table-bordered"
                                                                           style="width:100%">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>modelo_id</th>
                                                                            <th scope="col">Auxiliar
                                                                            </th>
                                                                            <th scope="col">Cantidad
                                                                            </th>
                                                                            <th scope="col">Acción</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody></tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="PalletGrande" role="tabpanel"
                                                         aria-labelledby="PalletGrande-tab">
                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="grand_cantidad">Cantidad</label>
                                                                <input type="number" class="form-control"
                                                                       id="grand_cantidad"
                                                                       placeholder="Cantidad de cajas"
                                                                       name="grand_cantidad" step="0.01" min="0.00">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="grand_kg">Kilogramos</label>
                                                                <input type="number" class="form-control" id="grand_kg"
                                                                       placeholder="Kg" name="grand_kg" step="0.01"
                                                                       min="0.00">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="grand_cantoneras">Cantoneras</label>
                                                                <input type="text" class="form-control"
                                                                       id="grand_cantoneras" placeholder="Cantoneras"
                                                                       name="grand_cantoneras">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="grand_cubre_id">Cubres</label>
                                                                <select name="grand_cubre_id" id="grand_cubre_id"
                                                                        class="form-control chosen"
                                                                        data-placeholder="Seleccione...">
                                                                    <option value=""></option>
                                                                    @if (isset($cubres))
                                                                        @foreach ($cubres as $cubre)
                                                                            <option value="{{ $cubre->id }}">{{ $cubre->formato }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="grand_cubre_cantidad">Cantidad
                                                                    Cubres</label>
                                                                <input type="number" class="form-control"
                                                                       id="grand_cubre_cantidad"
                                                                       placeholder="Cantidad Cubres"
                                                                       name="grand_cubre_cantidad" step="0.01"
                                                                       min="0.00">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="grand_auxiliar_modelo">Auxiliar</label>
                                                                <select id="grand_auxiliar_modelo"
                                                                        class="form-control chosen"
                                                                        data-placeholder="Seleccione...">
                                                                    <option value=""></option>
                                                                    @if (isset($auxiliares))
                                                                        @foreach ($auxiliares as $auxiliar)
                                                                            <option value="{{ $auxiliar->id }}">
                                                                                {{ $auxiliar->modelo }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="grand_auxiliar_cantidad">Cantidad</label>
                                                                <input type="number" class="form-control"
                                                                       id="grand_auxiliar_cantidad"
                                                                       placeholder="Cantidad"
                                                                       step="0.01">
                                                            </div>
                                                            <div class="col-md-2 mb-3">
                                                                <br>
                                                                <button id="btnAddGrandAuxiliar" type="button"
                                                                        class="btn btn-success btn-icon">
                                                                    <i class="i-Add"></i>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 mb-3">
                                                                <div class="table-responsive">
                                                                    <table id="grand_auxiliares_table"
                                                                           class="display table table-striped table-bordered"
                                                                           style="width:100%">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>modelo_id</th>
                                                                            <th scope="col">Auxiliar</th>
                                                                            <th scope="col">Cantidad
                                                                            </th>
                                                                            <th scope="col">Acción</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody></tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Cerrar
                                        </button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3 table-responsive">
                            <table id="productos_table" class="display table table-sm table-hover table-bordered"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th scope="col">Variable</th>
                                    <th scope="col">Caja</th>
                                    <th scope="col">Tarrinas</th>
                                    <th scope="col">Auxiliares</th>
                                    <th scope="col">Euro Palet<br>Cantidad</th>
                                    <th scope="col">Euro Palet<br>Kg</th>
                                    <th scope="col">Euro Palet<br>Cantoneras</th>
                                    <th scope="col">Euro Palet<br>Cubre</th>
                                    <th scope="col">Euro Palet<br>Cubre Cantidad</th>
                                    <th scope="col">Euro Palet<br>Auxiliares</th>
                                    <th scope="col">Palet Grande<br>Cantidad</th>
                                    <th scope="col">Palet Grande<br>Kg</th>
                                    <th scope="col">Palet Grande<br>Cantoneras</th>
                                    <th scope="col">Palet Grande<br>Cubre</th>
                                    <th scope="col">Palet Grande<br>Cubre Cantidad</th>
                                    <th scope="col">Palet Grande<br>Auxiliares</th>
                                    <th scope="col">Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($detalles as $detalle)
                                    <tr>
                                        <td>{{ $detalle->id }}</td>
                                        <td>{{ $detalle->variable }}</td>
                                        <td>{{ (!is_null($detalle->caja_id)) ? $detalle->caja->formato : "" }}</td>
                                        <td>
                                            @if(isset($detalle->tarrinas))
                                                <ul class="list-group text-left">
                                                    @foreach($detalle->tarrinas as $tarrina)
                                                        <li
                                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                            {{ $tarrina->tarrina->modelo }}
                                                            <span
                                                                    class="badge badge-primary badge-pill">{{ $tarrina->cantidad }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($detalle->auxiliares))
                                                <ul class="list-group text-left">
                                                    @foreach($detalle->auxiliares as $auxiliar)
                                                        <li
                                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                            {{ $auxiliar->auxiliar->modelo }}
                                                            <span
                                                                    class="badge badge-primary badge-pill">{{ $auxiliar->cantidad }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td>{{ $detalle->euro_cantidad }}</td>
                                        <td>{{ $detalle->euro_kg }}</td>
                                        <td>{{ $detalle->euro_cantoneras }}</td>
                                        <td>{{ (!is_null($detalle->euro_cubre_id)) ? $detalle->euro_cubre->formato : "" }}
                                        </td>
                                        <td>{{ $detalle->euro_cubre_cantidad }}</td>
                                        <td>
                                            @if(isset($detalle->euro_auxiliares))
                                                <ul class="list-group text-left">
                                                    @foreach($detalle->euro_auxiliares as $auxiliar)
                                                        <li
                                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                            {{ $auxiliar->auxiliar->modelo }}
                                                            <span
                                                                    class="badge badge-primary badge-pill">{{ $auxiliar->cantidad }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td>{{ $detalle->grand_cantidad }}</td>
                                        <td>{{ $detalle->grand_kg}}</td>
                                        <td>{{ $detalle->grand_cantoneras}}</td>
                                        <td>{{ (!is_null($detalle->grand_cubre_id)) ? $detalle->grand_cubre->formato : "" }}
                                        </td>
                                        <td>{{ $detalle->grand_cubre_cantidad }}</td>
                                        <td>
                                            @if(isset($detalle->grand_auxiliares))
                                                <ul class="list-group text-left">
                                                    @foreach($detalle->grand_auxiliares as $auxiliar)
                                                        <li
                                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                            {{ $auxiliar->auxiliar->modelo }}
                                                            <span
                                                                    class="badge badge-primary badge-pill">{{ $auxiliar->cantidad }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="javascript:void(0);" class="text-success mr-2 edit"
                                               data-toggle="tooltip" data-placement="top" title=""
                                               data-original-title="Editar" title="Editar">
                                                <i class="nav-icon i-Pen-2 font-weight-bold "></i>
                                            </a>
                                            <a href="javascript:void(0);" class="text-danger mr-2 delete"
                                               data-toggle="tooltip" data-placement="top" title=""
                                               data-original-title="Borrar" title="Borrar">
                                                <i class="nav-icon i-Close-Window font-weight-bold "></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
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

    {{--Tabla Principal Productos--}}
    <script>
        $.fn.dataTable.Api.register('inTable()', function (value) {
            return this
                .data()
                .toArray()
                .toString()
                .toLowerCase()
                .split(',')
                .indexOf(value.toString().toLowerCase()) > -1
        })

        var table_productos;

        $(function () {
            table_productos = $("#productos_table").DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                ordering: false,
                info: true,
                paging: false,
                searching: true,
                responsive: true,
                columnDefs: [{
                    targets: [0],
                    visible: false
                }]
            });

            $("#btnNuevoDetalle").click(function (e) {
                LimpiarModalDetalles();
                $("#modal-producto-title").html('Agregar Producto');
                $("#det_id").val(null);
                $("#modal-producto").modal("show");
            });

            $('#productos_table').on('click', '.edit', function () {
                var current_row = $(this).parents('tr');
                if (current_row.hasClass('child')) {
                    current_row = current_row.prev();
                }
                var row = table_productos.row(current_row).data();

                var id = row[0];

                LimpiarModalDetalles();
                setTimeout(function () {
                    GetDataModalDetalle(id);
                }, 200);


                $("#modal-producto-title").html("Modificar Producto");
                $("#det_id").val(id);
                setTimeout(function () {
                    $("#modal-producto").modal("show");
                }, 300);
            });

            $('#productos_table').on('click', '.delete', function () {
                var current_row = $(this).parents('tr');
                if (current_row.hasClass('child')) {
                    current_row = current_row.prev();
                }
                var row = table_productos.row(current_row).data();

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
                    window.location.href = "{{ url('maestros/productos-compuestos/delete') }}" +
                        "/" + row[0]
                });
            });
        })

        function LimpiarModalDetalles() {
            $('#variable, #euro_kg, #grand_kg, #euro_cantoneras, #euro_cubre_cantidad').val(null);
            $('#cajas, #euro_cubre_id').val(null).trigger('chosen:updated');
            tarrinas_auxiliares_table.rows().remove().draw();
            euro_table_auxiliares.rows().remove().draw();
            grand_table_auxiliares.rows().remove().draw();
        }

        function GetDataModalDetalle(id) {
            var myUrl = "{{ url('maestros/productos-compuestos/details') }}" + '/' + id;
            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: myUrl,
                dataType: 'json',
                success: function (data) {
                    var row = data.detalle;

                    $('#variable').val(row.variable);
                    $('#caja_id').val(row.caja_id).trigger('chosen:updated');
                    $('#euro_kg').val(row.euro_kg);
                    $('#grand_kg').val(row.grand_kg);
                    $('#euro_cantoneras').val(row.cantoneras);
                    $('#euro_cubre_id').val(row.cubre_id).trigger('chosen:updated');
                    $('#euro_cubre_cantidad').val(row.cubre_cantidad);

                    var opciones = '<a href="javascript:void(0);" class="text-success mr-2 edit">\n' +
                        '<i class="nav-icon i-Pen-2 font-weight-bold "></i></a>' +
                        '<a href="javascript:void(0);" class="text-danger mr-2 delete">\n' +
                        '<i class="nav-icon i-Close-Window font-weight-bold "></i>\n' +
                        '</a>';

                    //Euro Auxiliares Table
                    for (i = 0; i < row.euro_auxiliares.length; i++) {
                        var auxiliar = row.euro_auxiliares[i];
                        euro_table_auxiliares.row.add([
                            auxiliar.auxiliar_id,
                            auxiliar.auxiliar.modelo,
                            auxiliar.cantidad,
                            '<input type="hidden" name="auxiliares_id[]" value="' + auxiliar
                                .auxiliar_id + '">' +
                            '<input type="hidden" name="auxiliares_cantidad[]" value="' + auxiliar
                                .cantidad + '"> ' +
                            opciones
                        ]).draw();
                    }

                    //Euro Auxiliares Table
                    for (i = 0; i < row.grand_auxiliares.length; i++) {
                        var auxiliar = row.grand_auxiliares[i];
                        grand_table_auxiliares.row.add([
                            auxiliar.auxiliar_id,
                            auxiliar.auxiliar.modelo,
                            auxiliar.cantidad,
                            '<input type="hidden" name="auxiliares_id[]" value="' + auxiliar
                                .auxiliar_id + '">' +
                            '<input type="hidden" name="auxiliares_cantidad[]" value="' + auxiliar
                                .cantidad + '"> ' +
                            opciones
                        ]).draw();
                    }
                },
                error: function () {
                    console.log("Error");
                }
            });
        }
    </script>
    {{--Table Tarrinas | Auxiliares de Caja --}}
    <script>
        var tarrinas_auxiliares_table;

        $(function () {
            tarrinas_auxiliares_table = $("#tarrinas_auxiliares_table").DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json') }}"
                },
                //ordering: false,
                info: false,
                paging: false,
                searching: false,
                columnDefs: [
                    {targets: [1, 2, 3, 4], orderable: false},
                    {targets: [0], visible: false},
                    {targets: [3], className: 'text-right'}
                ],
                ordering: [
                    [1, 'asc'],
                    [2, 'asc'],
                ]
            });
            $('#tarrinas_auxiliares_table').on('click', '.edit', function () {
                var tr = $(this).closest('tr');
                var row = tarrinas_auxiliares_table.row(tr).data();
                var index = tarrinas_auxiliares_table.row(tr).index();

                $('#tarrina_modelo').val(row[0]).trigger('chosen:updated');
                $('#tarrina_cantidad').val(row[2]);
                $('#btnAddTarrina').attr('data-index', index);
            });

            $('#tarrinas_auxiliares_table').on('click', '.delete', function () {
                var tr = $(this).closest('tr');
                tarrinas_auxiliares_table.row(tr).remove().draw(false);
            });

            // Tarrinas
            $("#btnAddTarrina").click(function (e) {
                var tipo = "Tarrina";
                var modelo_id = $("#tarrina_modelo").val();
                if (!ValidarTarrina(tipo + modelo_id)) return;
                var modelo = $("#tarrina_modelo option:selected").text();
                var cantidad = $("#tarrina_cantidad").val();
                var opciones = '<a href="javascript:void(0);" class="text-danger mr-2 delete">\n' +
                    '<i class="nav-icon i-Close-Window font-weight-bold "></i>\n' +
                    '</a>';

                var data = [
                    tipo + modelo_id,
                    tipo,
                    modelo,
                    cantidad,
                    '<input type="hidden" name="tarrinas_id[]" value="' + modelo_id + '">' +
                    '<input type="hidden" name="tarrinas_cantidad[]" value="' + cantidad + '">' +
                    opciones
                ];

                tarrinas_auxiliares_table.row.add(data).draw(false);

                LimpiarTarrina();
            });

            function ValidarTarrina(modelo_id) {
                if (modelo_id == null || modelo_id == "") {
                    swal("Atención", "El campo Tarrina es requerido.", "warning");
                    return false;
                }

                var cantidad = $("#tarrina_cantidad").val();
                if (cantidad == null || cantidad == "") {
                    swal("Atención", "El campo Cantidad es requerido.", "warning");
                    return false;
                }

                if (tarrinas_auxiliares_table.inTable(modelo_id)) {
                    swal("Atención", "Tarrina cargada en la tabla.", "warning");
                    return false;
                }

                return true;
            }

            function LimpiarTarrina() {
                $('#tarrina_cantidad').val(null);
                $('#tarrina_modelo').val(null).trigger('chosen:updated');
            }

            // Auxiliares
            $("#btnAddAuxiliar").click(function (e) {
                var tipo = "Auxiliar";
                var modelo_id = $("#auxiliar_modelo").val();
                if (!ValidarAuxiliar(tipo + modelo_id)) return;
                var modelo = $("#auxiliar_modelo option:selected").text();
                var cantidad = $("#auxiliar_cantidad").val();
                var opciones = '<a href="javascript:void(0);" class="text-danger mr-2 delete">\n' +
                    '<i class="nav-icon i-Close-Window font-weight-bold "></i>\n' +
                    '</a>';

                var data = [
                    tipo + modelo_id,
                    tipo,
                    modelo,
                    cantidad,
                    '<input type="hidden" name="auxiliares_id[]" value="' + modelo_id + '">' +
                    '<input type="hidden" name="auxiliares_cantidad[]" value="' + cantidad + '">' +
                    opciones
                ];

                tarrinas_auxiliares_table.row.add(data).draw(false);

                LimpiarAuxiliar();
            });

            function ValidarAuxiliar(modelo_id) {
                if (modelo_id == null || modelo_id == "") {
                    swal("Atención", "El campo Auxiliar es requerido.", "warning");
                    return false;
                }

                var cantidad = $("#auxiliar_cantidad").val();
                if (cantidad == null || cantidad == "") {
                    swal("Atención", "El campo Cantidad es requerido.", "warning");
                    return false;
                }

                if (tarrinas_auxiliares_table.inTable(modelo_id)) {
                    swal("Atención", "Auxiliar cargada en la tabla.", "warning");
                    return false;
                }

                return true;
            }

            function LimpiarAuxiliar() {
                $('#auxiliar_cantidad').val(null);
                $('#auxiliar_modelo').val(null).trigger('chosen:updated');
            }
        });
    </script>
    {{--Table Euro Pallet Auxiliares--}}
    <script>
        var euro_table_auxiliares;

        $(function () {

            euro_table_auxiliares = $("#euro_auxiliares_table").DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                ordering: false,
                info: false,
                paging: false,
                searching: false,
                columnDefs: [{
                    targets: [0],
                    visible: false
                }]
            });

            $("#btnAddEuroAuxiliar").click(function (e) {
                var index = $(this).attr('data-index');
                if (!ValidarEuroAuxiliar(index)) return;
                var modelo_id = $("#euro_auxiliar_modelo").val();
                var modelo = $("#euro_auxiliar_modelo option:selected").text();
                var cantidad = $("#euro_auxiliar_cantidad").val();
                var opciones = '<a href="javascript:void(0);" class="text-success mr-2 edit">\n' +
                    '<i class="nav-icon i-Pen-2 font-weight-bold "></i></a>' +
                    '<a href="javascript:void(0);" class="text-danger mr-2 delete">\n' +
                    '<i class="nav-icon i-Close-Window font-weight-bold "></i>\n' +
                    '</a>';

                var data = [
                    modelo_id,
                    modelo,
                    cantidad,
                    '<input type="hidden" name="euro_auxiliares_id[]" value="' + modelo_id + '">' +
                    '<input type="hidden" name="euro_auxiliares_cantidad[]" value="' + cantidad +
                    '"> ' +
                    opciones
                ];

                if (index == null || index == "") {
                    euro_table_auxiliares.row.add(data).draw(false);
                } else {
                    euro_table_auxiliares.row(index).data(data).draw(false);
                }

                LimpiarEuroAuxiliar();
            });

            $('#euro_auxiliares_table').on('click', '.edit', function () {
                var tr = $(this).closest('tr');
                var row = euro_table_auxiliares.row(tr).data();
                var index = euro_table_auxiliares.row(tr).index();

                $('#euro_auxiliar_modelo').val(row[0]).trigger('chosen:updated');
                $('#euro_auxiliar_cantidad').val(row[2]);
                $('#btnAddEuroAuxiliar').attr('data-index', index);
            });

            $('#euro_auxiliares_table').on('click', '.delete', function () {
                var tr = $(this).closest('tr');
                euro_table_auxiliares.row(tr).remove().draw(false);
            });

            function ValidarEuroAuxiliar(index) {
                var modelo_id = $("#euro_auxiliar_modelo").val();
                if (modelo_id == null || modelo_id == "") {
                    swal("Atención", "El campo Auxiliar es requerido.", "warning");
                    return false;
                }

                var cantidad = $("#euro_auxiliar_cantidad").val();
                if (cantidad == null || cantidad == "") {
                    swal("Atención", "El campo Cantidad es requerido.", "warning");
                    return false;
                }

                if (euro_table_auxiliares.inTable(modelo_id) && index == null) {
                    swal("Atención", "Auxiliar cargada en la tabla.", "warning");
                    return false;
                }

                return true;
            }

            function LimpiarEuroAuxiliar() {
                $('#euro_auxiliar_cantidad').val(null);
                $('#btnAddEuroAuxiliar').attr('data-index', null);
                $('#euro_auxiliar_modelo').val(null).trigger('chosen:updated');
            }
        });
    </script>
    {{--Table Grand Pallet Auxiliares--}}
    <script>
        var grand_table_auxiliares;

        $(function () {

            grand_table_auxiliares = $("#grand_auxiliares_table").DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                ordering: false,
                info: false,
                paging: false,
                searching: false,
                columnDefs: [{
                    targets: [0],
                    visible: false
                }]
            });

            $("#btnAddGrandAuxiliar").click(function (e) {
                var index = $(this).attr('data-index');
                if (!ValidarGrandAuxiliar(index)) return;
                var modelo_id = $("#grand_auxiliar_modelo").val();
                var modelo = $("#grand_auxiliar_modelo option:selected").text();
                var cantidad = $("#grand_auxiliar_cantidad").val();
                var opciones = '<a href="javascript:void(0);" class="text-success mr-2 edit">\n' +
                    '<i class="nav-icon i-Pen-2 font-weight-bold "></i></a>' +
                    '<a href="javascript:void(0);" class="text-danger mr-2 delete">\n' +
                    '<i class="nav-icon i-Close-Window font-weight-bold "></i>\n' +
                    '</a>';

                var data = [
                    modelo_id,
                    modelo,
                    cantidad,
                    '<input type="hidden" name="grand_auxiliares_id[]" value="' + modelo_id + '">' +
                    '<input type="hidden" name="grand_auxiliares_cantidad[]" value="' + cantidad +
                    '"> ' +
                    opciones
                ];

                if (index == null || index == "") {
                    grand_table_auxiliares.row.add(data).draw(false);
                } else {
                    grand_table_auxiliares.row(index).data(data).draw(false);
                }

                LimpiarGrandAuxiliar();
            });

            $('#grand_auxiliares_table').on('click', '.edit', function () {
                var tr = $(this).closest('tr');
                var row = grand_table_auxiliares.row(tr).data();
                var index = grand_table_auxiliares.row(tr).index();

                $('#grand_auxiliar_modelo').val(row[0]).trigger('chosen:updated');
                $('#grand_auxiliar_cantidad').val(row[2]);
                $('#btnAddGrandAuxiliar').attr('data-index', index);
            });

            $('#grand_auxiliares_table').on('click', '.delete', function () {
                var tr = $(this).closest('tr');
                grand_table_auxiliares.row(tr).remove().draw(false);
            });

            function ValidarGrandAuxiliar(index) {
                var modelo_id = $("#grand_auxiliar_modelo").val();
                if (modelo_id == null || modelo_id == "") {
                    swal("Atención", "El campo Auxiliar es requerido.", "warning");
                    return false;
                }

                var cantidad = $("#grand_auxiliar_cantidad").val();
                if (cantidad == null || cantidad == "") {
                    swal("Atención", "El campo Cantidad es requerido.", "warning");
                    return false;
                }

                if (grand_table_auxiliares.inTable(modelo_id) && index == null) {
                    swal("Atención", "Auxiliar cargada en la tabla.", "warning");
                    return false;
                }

                return true;
            }

            function LimpiarGrandAuxiliar() {
                $('#grand_auxiliar_cantidad').val(null);
                $('#btnAddGrandAuxiliar').attr('data-index', null);
                $('#grand_auxiliar_modelo').val(null).trigger('chosen:updated');
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".chosen").chosen({
                width: "100%",
                no_results_text: "No se encontraron resultados... ",
                placeholder_text_single: "Seleccione una opción...",
                allow_single_deselect: true
            });
        })
    </script>
@endsection