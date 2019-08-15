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
                                <form action="/maestros/productos-compuestos/store" method="POST"
                                      id="producto_form">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <input type="hidden" name="compuesto_id" id="compuesto_id"
                                           value="{{ $producto->id }}">
                                    <input type="hidden" name="id" id="det_id" value="">

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
                                                            <option value="{{ $caja->id }}">{{ $caja->formato.' | '.$caja->modelo }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active show" id="EuroPallet-tab"
                                                           data-toggle="tab" href="#EuroPallet" role="tab"
                                                           aria-controls="EuroPallet" aria-selected="true">Euro
                                                            Pallet</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="PalletGrande-tab" data-toggle="tab"
                                                           href="#PalletGrande" role="tab" aria-controls="PalletGrande"
                                                           aria-selected="false">Pallet Grande</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade active show" id="EuroPallet"
                                                         role="tabpanel"
                                                         aria-labelledby="EuroPallet-tab">
                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="euro_pallet_id">Europalet</label>
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
                                                            <div class="col-md-4 mb-3">
                                                                <label for="euro_pallet_id">Cantidad</label>
                                                                <input type="number" class="form-control"
                                                                       id="euro_cantidad"
                                                                       placeholder="Cantidad" name="euro_cantidad">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="euro_pallet_id">Kilogramos</label>
                                                                <input type="number" class="form-control"
                                                                       id="euro_kg"
                                                                       placeholder="Kg" name="euro_kg">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="cantoneras">Cantoneras</label>
                                                                <input type="text" class="form-control" id="cantoneras"
                                                                       placeholder="Cantoneras" name="cantoneras">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="variedad">Cubres</label>
                                                                <select name="cubre_id" id="cubre_id"
                                                                        class="form-control chosen"
                                                                        data-placeholder="Seleccione...">
                                                                    <option value=""></option>
                                                                    @if (isset($cubres))
                                                                        @foreach ($cubres as $cubre)
                                                                            <option value="{{ $cubre->id }}">{{ $cubre->formato }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="cubre_cantidad">Cantidad Cubres</label>
                                                                <input type="number" class="form-control"
                                                                       id="cubre_cantidad"
                                                                       placeholder="Cantidad Cubres"
                                                                       name="cubre_cantidad">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 mb-3">
                                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active show"
                                                                           id="tarrinas-tab"
                                                                           data-toggle="tab" href="#tarrinas" role="tab"
                                                                           aria-controls="tarrinas"
                                                                           aria-selected="true">Tarrinas</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" id="auxiliares-tab"
                                                                           data-toggle="tab"
                                                                           href="#auxiliares" role="tab"
                                                                           aria-controls="auxiliares"
                                                                           aria-selected="false">Auxiliares</a>
                                                                    </li>
                                                                </ul>
                                                                <div class="tab-content" id="myTabContent">
                                                                    <div class="tab-pane fade active show" id="tarrinas"
                                                                         role="tabpanel"
                                                                         aria-labelledby="tarrinas-tab">

                                                                        <div class="row">
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="tarrina_modelo">Tarrina</label>
                                                                                <select id="tarrina_modelo"
                                                                                        class="form-control chosen"
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
                                                                                <input type="number"
                                                                                       class="form-control"
                                                                                       id="tarrina_cantidad"
                                                                                       placeholder="Cantidad"
                                                                                       step="0.01">
                                                                            </div>
                                                                            <div class="col-md-2 mb-3">
                                                                                <br>
                                                                                <button id="btnAddTarrina" type="button"
                                                                                        class="btn btn-success btn-icon">
                                                                                    <i class="i-Add"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12 mb-3">
                                                                                <div class="table-responsive">
                                                                                    <table id="tarrinas_table"
                                                                                           class="display table table-striped table-bordered"
                                                                                           style="width:100%">
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <th>modelo_id</th>
                                                                                            <th scope="col">Tarrina</th>
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
                                                                    <div class="tab-pane fade" id="auxiliares"
                                                                         role="tabpanel"
                                                                         aria-labelledby="auxiliares-tab">

                                                                        <div class="row">
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="auxiliar_modelo">Auxiliar</label>
                                                                                <select id="auxiliar_modelo"
                                                                                        class="form-control chosen"
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
                                                                                <input type="number"
                                                                                       class="form-control"
                                                                                       id="auxiliar_cantidad"
                                                                                       placeholder="Cantidad"
                                                                                       step="0.01">
                                                                            </div>
                                                                            <div class="col-md-2 mb-3">
                                                                                <br>
                                                                                <button id="btnAddAuxiliar"
                                                                                        type="button" data-index=""
                                                                                        class="btn btn-success btn-icon">
                                                                                    <i class="i-Add"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12 mb-3">
                                                                                <div class="table-responsive">
                                                                                    <table id="auxiliares_table"
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
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="PalletGrande" role="tabpanel"
                                                         aria-labelledby="PalletGrande-tab">
                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="grand_pallet_id">Pallet Grande</label>
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
                                                            <div class="col-md-4 mb-3">
                                                                <label for="grand_cantidad">Cantidad</label>
                                                                <input type="number" class="form-control"
                                                                       id="grand_cantidad"
                                                                       placeholder="Cantidad" name="grand_cantidad">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="grand_kg">Kilogramos</label>
                                                                <input type="number" class="form-control"
                                                                       id="grand_kg"
                                                                       placeholder="Kg" name="grand_kg">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="cantoneras">Cantoneras</label>
                                                                <input type="text" class="form-control" id="cantoneras"
                                                                       placeholder="Cantoneras" name="cantoneras">
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="variedad">Cubres</label>
                                                                <select name="cubre_id" id="cubre_id"
                                                                        class="form-control chosen"
                                                                        data-placeholder="Seleccione...">
                                                                    <option value=""></option>
                                                                    @if (isset($cubres))
                                                                        @foreach ($cubres as $cubre)
                                                                            <option value="{{ $cubre->id }}">{{ $cubre->formato }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="cubre_cantidad">Cantidad Cubres</label>
                                                                <input type="number" class="form-control"
                                                                       id="cubre_cantidad"
                                                                       placeholder="Cantidad Cubres"
                                                                       name="cubre_cantidad">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 mb-3">
                                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active show"
                                                                           id="tarrinas-tab"
                                                                           data-toggle="tab" href="#tarrinas" role="tab"
                                                                           aria-controls="tarrinas"
                                                                           aria-selected="true">Tarrinas</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" id="auxiliares-tab"
                                                                           data-toggle="tab"
                                                                           href="#auxiliares" role="tab"
                                                                           aria-controls="auxiliares"
                                                                           aria-selected="false">Auxiliares</a>
                                                                    </li>
                                                                </ul>
                                                                <div class="tab-content" id="myTabContent">
                                                                    <div class="tab-pane fade active show" id="tarrinas"
                                                                         role="tabpanel"
                                                                         aria-labelledby="tarrinas-tab">

                                                                        <div class="row">
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="tarrina_modelo">Tarrina</label>
                                                                                <select id="tarrina_modelo"
                                                                                        class="form-control chosen"
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
                                                                                <input type="number"
                                                                                       class="form-control"
                                                                                       id="tarrina_cantidad"
                                                                                       placeholder="Cantidad"
                                                                                       step="0.01">
                                                                            </div>
                                                                            <div class="col-md-2 mb-3">
                                                                                <br>
                                                                                <button id="btnAddTarrina" type="button"
                                                                                        class="btn btn-success btn-icon">
                                                                                    <i class="i-Add"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12 mb-3">
                                                                                <div class="table-responsive">
                                                                                    <table id="tarrinas_table"
                                                                                           class="display table table-striped table-bordered"
                                                                                           style="width:100%">
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <th>modelo_id</th>
                                                                                            <th scope="col">Tarrina</th>
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
                                                                    <div class="tab-pane fade" id="auxiliares"
                                                                         role="tabpanel"
                                                                         aria-labelledby="auxiliares-tab">

                                                                        <div class="row">
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="auxiliar_modelo">Auxiliar</label>
                                                                                <select id="auxiliar_modelo"
                                                                                        class="form-control chosen"
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
                                                                                <input type="number"
                                                                                       class="form-control"
                                                                                       id="auxiliar_cantidad"
                                                                                       placeholder="Cantidad"
                                                                                       step="0.01">
                                                                            </div>
                                                                            <div class="col-md-2 mb-3">
                                                                                <br>
                                                                                <button id="btnAddAuxiliar"
                                                                                        type="button" data-index=""
                                                                                        class="btn btn-success btn-icon">
                                                                                    <i class="i-Add"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12 mb-3">
                                                                                <div class="table-responsive">
                                                                                    <table id="auxiliares_table"
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
                        <div class="col-md-12 mb-4">
                            <div class="table-responsive">
                                <table id="productos_table" class="display table table-striped table-bordered"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th scope="col">Variable</th>
                                        <th scope="col">Caja</th>
                                        <th scope="col">EuroPallet<br>Formato</th>
                                        <th scope="col">EuroPallet<br>Cantidad</th>
                                        <th scope="col">EuroPallet<br>Kg</th>
                                        <th scope="col">Pallet Grande<br>Formato</th>
                                        <th scope="col">Pallet Grande<br>Cantidad</th>
                                        <th scope="col">Pallet Grande<br>Kg</th>
                                        <th scope="col">Cantoneras</th>
                                        <th scope="col">Cubre</th>
                                        <th scope="col">Cubre<br>Cantidad</th>
                                        <th scope="col">Tarrinas</th>
                                        <th scope="col">Auxiliares</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($detalles as $detalle)
                                        <tr>
                                            <td>{{ $detalle->id }}</td>
                                            <td>{{ $detalle->variable }}</td>
                                            <td>{{ (!is_null($detalle->caja_id)) ? $detalle->caja->formato : "" }}</td>
                                            <td>{{ (!is_null($detalle->euro_pallet_id)) ? $detalle->euro_pallet->formato : "" }}</td>
                                            <td>{{ $detalle->euro_cantidad }}</td>
                                            <td>{{ $detalle->euro_kg }}</td>
                                            <td>{{ (!is_null($detalle->grand_pallet_id)) ? $detalle->grand_pallet->formato : "" }}</td>
                                            <td>{{ $detalle->grand_cantidad }}</td>
                                            <td>{{ $detalle->grand_kg}}</td>
                                            <td>{{ $detalle->cantoneras}}</td>
                                            <td>{{ (!is_null($detalle->cubre_id)) ? $detalle->cubre->formato : "" }}</td>
                                            <td>{{ $detalle->cubre_cantidad }}</td>
                                            <td>
                                                @if(isset($detalle->tarrinas))
                                                    <ul class="list-group text-left">
                                                        @foreach($detalle->tarrinas as $tarrina)
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                {{ $tarrina->tarrina->modelo }}
                                                                <span class="badge badge-primary badge-pill">{{ $tarrina->cantidad }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($detalle->auxiliares))
                                                    <ul class="list-group text-left">
                                                        @foreach($detalle->auxiliares as $auxiliar)
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                {{ $auxiliar->auxiliar->modelo }}
                                                                <span class="badge badge-primary badge-pill">{{ $auxiliar->cantidad }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </td>
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
                info: false,
                paging: false,
                searching: false,
                columnDefs: [
                    {targets: [0], visible: false}
                ]
            });

            $("#btnNuevoDetalle").click(function (e) {
                LimpiarModalDetalles();
                $("#modal-producto-title").html('Agregar Producto');
                $("#det_id").val(null);
                $("#modal-producto").modal("show");
            });

            $('#productos_table .edit').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_productos.row(tr).data();
                var id = row[0];

                LimpiarModalDetalles();
                GetDataModalDetalle(id);

                $("#modal-producto-title").html("Modificar Producto");
                $("#det_id").val(id);
                $("#modal-producto").modal("show");
            });

            $('#productos_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_productos.row(tr).data();

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
                    window.location.href = "{{ url('maestros/productos-compuestos/delete') }}" + "/" + row[0]
                });
            });
        })

        function LimpiarModalDetalles() {
            $('#variable, #euro_cantidad, #euro_kg, #grand_cantidad, #grand_kg, #cantoneras, #cubre_cantidad').val(null);
            $('#cajas, #euro_pallet_id, #grand_pallet_id, #cubre_id').val(null).trigger('chosen:updated');
            table_tarrinas.rows().remove().draw();
            table_auxiliares.rows().remove().draw();
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
                    $('#euro_pallet_id').val(row.euro_pallet_id).trigger('chosen:updated');
                    $('#grand_pallet_id').val(row.grand_pallet_id).trigger('chosen:updated');
                    $('#euro_cantidad').val(row.euro_cantidad);
                    $('#grand_cantidad').val(row.grand_cantidad);
                    $('#euro_kg').val(row.euro_kg);
                    $('#grand_kg').val(row.grand_kg);
                    $('#cantoneras').val(row.cantoneras);
                    $('#cubre_id').val(row.cubre_id).trigger('chosen:updated');
                    $('#cubre_cantidad').val(row.cubre_cantidad);

                    var opciones = '<a href="javascript:void(0);" class="text-success mr-2">\n' +
                        '<i class="nav-icon i-Pen-2 font-weight-bold edit"></i></a>' +
                        '<a href="javascript:void(0);" class="text-danger mr-2">\n' +
                        '<i class="nav-icon i-Close-Window font-weight-bold delete"></i>\n' +
                        '</a>';
                    //Tarrinas table
                    for (i = 0; i < row.tarrinas.length; i++) {
                        var tarrina = row.tarrinas[i];
                        table_tarrinas.row.add([
                            tarrina.tarrina_id,
                            tarrina.tarrina.modelo,
                            tarrina.cantidad,
                            '<input type="hidden" name="tarrinas_id[]" value="' + tarrina.tarrina_id + '">' +
                            '<input type="hidden" name="tarrinas_cantidad[]" value="' + tarrina.cantidad + '"> ' +
                            opciones
                        ]).draw(false);
                    }
                    //Auxiliares Table
                    for (i = 0; i < row.auxiliares.length; i++) {
                        var auxiliar = row.auxiliares[i];
                        table_auxiliares.row.add([
                            auxiliar.auxiliar_id,
                            auxiliar.auxiliar.modelo,
                            auxiliar.cantidad,
                            '<input type="hidden" name="auxiliares_id[]" value="' + auxiliar.auxiliar_id + '">' +
                            '<input type="hidden" name="auxiliares_cantidad[]" value="' + auxiliar.cantidad + '"> ' +
                            opciones
                        ]).draw(false);
                    }
                },
                error: function () {
                    console.log("Error");
                }
            });
        }
    </script>

    <script>
        var table_tarrinas;

        $(function () {
            table_tarrinas = $("#tarrinas_table").DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                ordering: false,
                info: false,
                paging: false,
                searching: false,
                columnDefs: [
                    {targets: [0], visible: false}
                ]
            });

            $("#btnAddTarrina").click(function (e) {
                if (!ValidarTarrina()) return;
                var modelo_id = $("#tarrina_modelo").val();
                var modelo = $("#tarrina_modelo option:selected").text();
                var cantidad = $("#tarrina_cantidad").val();
                var opciones = '<a href="javascript:void(0);" class="text-success mr-2">\n' +
                    '<i class="nav-icon i-Pen-2 font-weight-bold edit"></i></a>' +
                    '<a href="javascript:void(0);" class="text-danger mr-2">\n' +
                    '<i class="nav-icon i-Close-Window font-weight-bold delete"></i>\n' +
                    '</a>';

                var data = [
                    modelo_id,
                    modelo,
                    cantidad,
                    '<input type="hidden" name="tarrinas_id[]" value="' + modelo_id + '">' +
                    '<input type="hidden" name="tarrinas_cantidad[]" value="' + cantidad + '">' +
                    opciones
                ];

                if ($(this).attr('data-index') == null || $(this).attr('data-index') == "") {
                    table_tarrinas.row.add(data).draw(false);
                } else {
                    table_tarrinas.row($(this).attr('data-index')).data(data).draw(false);
                }

                LimpiarTarrina();
            });

            $('#tarrinas_table').on('click', '.edit', function () {
                var tr = $(this).closest('tr');
                var row = table_tarrinas.row(tr).data();
                var index = table_tarrinas.row(tr).index();


                $('#tarrina_modelo').val(row[0]).trigger('chosen:updated');
                $('#tarrina_cantidad').val(row[2]);
                $('#btnAddTarrina').attr('data-index', index);
                // $('#pallet_modelo_id').val(row[2]).trigger('chosen:updated');
                // $('#pallet_form').attr('action', '/maestros/pallets/' + row[0]);
            });

            $('#tarrinas_table').on('click', '.delete', function () {
                var tr = $(this).closest('tr');
                table_tarrinas.row(tr).remove().draw(false);
            });

            function ValidarTarrina() {
                var modelo_id = $("#tarrina_modelo").val();
                if (modelo_id == null || modelo_id == "") {
                    swal("Atención", "El campo Tarrina es requerido.", "warning");
                    return false;
                }

                var cantidad = $("#tarrina_cantidad").val();
                if (cantidad == null || cantidad == "") {
                    swal("Atención", "El campo Cantidad es requerido.", "warning");
                    return false;
                }

                if (table_tarrinas.inTable(modelo_id)) {
                    swal("Atención", "Tarrina cargada en la tabla.", "warning");
                    return false;
                }

                return true;
            }

            function LimpiarTarrina() {
                $('#tarrina_cantidad').val(null);
                $('#btnAddTarrina').attr('data-index', null);
                $('#tarrina_modelo').val(null).trigger('chosen:updated');
            }
        });
    </script>

    <script>
        var table_auxiliares;

        $(function () {

            table_auxiliares = $("#auxiliares_table").DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                ordering: false,
                info: false,
                paging: false,
                searching: false,
                columnDefs: [
                    {targets: [0], visible: false}
                ]
            });

            $("#btnAddAuxiliar").click(function (e) {
                if (!ValidarAuxiliar()) return;
                var modelo_id = $("#auxiliar_modelo").val();
                var modelo = $("#auxiliar_modelo option:selected").text();
                var cantidad = $("#auxiliar_cantidad").val();
                var opciones = '<a href="javascript:void(0);" class="text-success mr-2">\n' +
                    '<i class="nav-icon i-Pen-2 font-weight-bold edit"></i></a>' +
                    '<a href="javascript:void(0);" class="text-danger mr-2">\n' +
                    '<i class="nav-icon i-Close-Window font-weight-bold delete"></i>\n' +
                    '</a>';

                table_auxiliares.row.add([
                    modelo_id,
                    modelo,
                    cantidad,
                    '<input type="hidden" name="auxiliares_id[]" value="' + modelo_id + '">' +
                    '<input type="hidden" name="auxiliares_cantidad[]" value="' + cantidad + '"> ' +
                    opciones
                ]).draw(false);

                LimpiarAuxiliar();
            });

            $('#auxiliares_table').on('click', '.delete', function () {
                var tr = $(this).closest('tr');
                table_auxiliares.row(tr).remove().draw(false);
            });

            function ValidarAuxiliar() {
                var modelo_id = $("#auxiliar_modelo").val();
                if (modelo_id == null || modelo_id == "") {
                    swal("Atención", "El campo Auxiliar es requerido.", "warning");
                    return false;
                }

                var cantidad = $("#auxiliar_cantidad").val();
                if (cantidad == null || cantidad == "") {
                    swal("Atención", "El campo Cantidad es requerido.", "warning");
                    return false;
                }

                if (table_auxiliares.inTable(modelo_id)) {
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
