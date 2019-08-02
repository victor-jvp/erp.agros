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
                    <h4 class="card-title mb-3">Producto: <b>{{ $producto->compuesto }}</b></h4>

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
                    <div class="modal fade" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="modal-producto">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="/maestros/productos-compuestos/store/{{ $producto->id }}" method="POST" id="producto_form">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}

                                    <input type="hidden" name="id" value="{{ $producto->id }}">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-producto-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="variable">Variable</label>
                                                <input type="text" class="form-control" id="variable"
                                                       placeholder="Variable" required="" name="variable">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="caja_id">Cajas</label>
                                                <select name="caja_id" id="caja_id" class="form-control chosen"
                                                        data-placeholder="Seleccione...">
                                                    <option value=""></option>
                                                    @if (isset($cajas))
                                                        @foreach ($cajas as $caja)
                                                            <option value="{{ $caja->id }}">{{ $caja->$caja }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Europalet</label>
                                                <div class="form-group">
                                                    <select name="euro_pallet_id" id="euro_pallet_id"
                                                            class="form-control chosen"
                                                            data-placeholder="Seleccione...">
                                                        <option value=""></option>
                                                        @if (isset($euro_pallets))
                                                            @foreach ($euro_pallets as $euro)
                                                                <option value="{{ $euro->id }}">{{ $euro->formato }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="number" class="form-control" id="euro_cantidad"
                                                           placeholder="Cantidad" name="euro_cantidad">
                                                </div>
                                                <div class="form-group">
                                                    <input type="number" class="form-control" id="euro_kg"
                                                           placeholder="Kg" name="euro_kg">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Pallet Grande</label>
                                                <div class="form-group">
                                                    <select name="grand_pallet_id" id="grand_pallet_id"
                                                            class="form-control chosen"
                                                            data-placeholder="Seleccione...">
                                                        <option value=""></option>
                                                        @if (isset($grand_pallets))
                                                            @foreach ($grand_pallets as $grand)
                                                                <option value="{{ $grand->id }}">{{ $grand->formato }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="number" class="form-control" id="grand_cantidad"
                                                           placeholder="Cantidad" name="grand_cantidad">
                                                </div>
                                                <div class="form-group">
                                                    <input type="number" class="form-control" id="grand_kg"
                                                           placeholder="Kg" name="grand_kg">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="cestas">Cestas</label>
                                                <input type="text" class="form-control" id="cestas"
                                                       placeholder="Cestas" name="cestas">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="tapas">Tapas</label>
                                                <input type="text" class="form-control" id="tapas"
                                                       placeholder="Tapas" name="tapas">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="cantoneras">Cantoneras</label>
                                                <input type="text" class="form-control" id="cantoneras"
                                                       placeholder="Cantoneras" name="cantoneras">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="variedad">Cubres</label>
                                                <select name="cubre_id" id="cubre_id" class="form-control chosen"
                                                        data-placeholder="Seleccione...">
                                                    <option value=""></option>
                                                    @if (isset($cubres))
                                                        @foreach ($cubres as $cubre)
                                                            <option value="{{ $cubre->id }}">{{ $cubre->cubre }}</option>
                                                        @endforeach
                                                    @endif
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
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="table-responsive">
                                <table id="productos_table" class="display table table-striped table-bordered"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th scope="col">Variable</th>
                                        <th scope="col">Caja</th>
                                        <th scope="col">EuroPallet<br>Formato</th>
                                        <th scope="col">EuroPallet<br>Cantidad</th>
                                        <th scope="col">EuroPallet<br>Kg</th>
                                        <th scope="col">Pallet Grande<br>Formato</th>
                                        <th scope="col">Pallet Grande<br>Cantidad</th>
                                        <th scope="col">Pallet Grande<br>Kg</th>
                                        <th scope="col">Cestas</th>
                                        <th scope="col">Tapas</th>
                                        <th scope="col">Cantoneras</th>
                                        <th scope="col">Cubre</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($detalles as $detalle)
                                        <tr>
                                            <td>{{ $detalle->variable }}</td>
                                            <td>{{ $detalle->caja_id }}</td>
                                            <td>{{ $detalle->euro_pallet_id }}</td>
                                            <td>{{ $detalle->euro_cantidad }}</td>
                                            <td>{{ $detalle->euro_kg }}</td>
                                            <td>{{ $detalle->grand_pallet_id}}</td>
                                            <td>{{ $detalle->grand_cantidad }}</td>
                                            <td>{{ $detalle->grand_kg}}</td>
                                            <td>{{ $detalle->cestas}}</td>
                                            <td>{{ $detalle->cantoneras}}</td>
                                            <td>{{ $detalle->cubre}}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="text-success mr-2">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold edit"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="text-danger mr-2">
                                                    <i class="nav-icon i-Close-Window font-weight-bold delete"></i>
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

    <script>
        var table_productos

        $(function () {
            var table_productos = $("#productos_table").DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                },
                ordering: false,
                info: false,
                paging: false,
                searching: false,
            });

            $("#btnNuevoDetalle").click(function (e) {
                $("#modal-producto-title").html('Agregar Producto');
                $("#modal-producto").modal("show");
            });


        })
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
@endsection
