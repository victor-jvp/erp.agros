@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Maestros</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Materiales</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Materiales</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="cajas-tab" data-toggle="tab" href="#cajas" role="tab"
                               aria-controls="cajas" aria-selected="true">Cajas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pallets-tab" data-toggle="tab" href="#pallets" role="tab"
                               aria-controls="pallets" aria-selected="false">Palets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="cubres-tab" data-toggle="tab" href="#cubres" role="tab"
                               aria-controls="cubres" aria-selected="false">Cubres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="auxiliares-tab" data-toggle="tab" href="#auxiliares" role="tab"
                               aria-controls="auxiliares" aria-selected="false">Auxiliares</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tarrinas-tab" data-toggle="tab" href="#tarrinas" role="tab"
                               aria-controls="tarrinas" aria-selected="false">Tarrinas</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="cajas" role="tabpanel" aria-labelledby="cajas-tab">

                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-primary" type="button" id="btnNuevaCaja">Nuevo</button>
                                </div>
                            </div>

                            <!-- Modal Cajas-->
                            <div class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="modal-cajas">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <form action="/maestros/cajas" method="POST" id="caja_form">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" id="caja_method" value="PUT">
                                            <input type="hidden" name="id" id="caja_id">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-cajas-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="validationCustom01">Formato</label>
                                                        <input type="text" class="form-control" id="caja_formato"
                                                               placeholder="Formato" required="" name="formato">
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="validationCustom02">Modelo</label>
                                                        <input type="text" class="form-control" id="caja_modelo"
                                                               placeholder="Modelo" required="" name="modelo">
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="validationCustom02">Kilogramos</label>
                                                        <input type="number" class="form-control" id="caja_kg"
                                                               placeholder="Kilogramos" required="" name="kg"
                                                               step="0.01">
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

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="cajas_table" class="display table table-striped table-bordered"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th scope="col">Formato</th>
                                                <th scope="col">Modelo</th>
                                                <th scope="col">Kilogramos</th>
                                                <th scope="col">Accion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (isset($cajas))
                                                @foreach ($cajas as $caja)
                                                    <tr>
                                                        <td>{{ $caja->id }}</td>
                                                        <td scope="row">{{ $caja->formato }}</td>
                                                        <td>{{ $caja->modelo }}</td>
                                                        <td>{{ $caja->kg }}</td>
                                                        <td>
                                                            {{--                                                            <a href="javascript:void(0);" onclick="EditCaja('{{ $caja->id }}')" class="text-success mr-2">--}}
                                                            {{--                                                                <i class="nav-icon i-Pen-2 font-weight-bold"></i>--}}
                                                            {{--                                                            </a>--}}
                                                            <a href="javascript:void(0);" class="text-success mr-2 edit">
                                                                <i class="nav-icon i-Pen-2 font-weight-bold "></i>
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
                        <div class="tab-pane fade" id="pallets" role="tabpanel" aria-labelledby="pallets-tab">
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-primary" type="button" id="btnNuevoPallet">Nuevo</button>
                                </div>
                            </div>

                            <!-- Modal Pallets-->
                            <div class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="modal-pallets">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <form action="/maestros/pallets" method="POST" id="pallet_form">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" id="pallet_method" value="PUT">
                                            <input type="hidden" name="id" id="pallet_id">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-pallets-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="validationCustom01">Formato</label>
                                                        <input type="text" class="form-control" id="pallet_formato"
                                                               placeholder="Formato" required="" name="formato">
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="">Modelo</label>
                                                        <select name="modelo_id" id="pallet_modelo_id"
                                                                class="form-control chosen" required
                                                                data-placeholder="Seleccione...">
                                                            <option value=""></option>
                                                            @if (isset($palletsModels))
                                                                @foreach ($palletsModels as $modelo)
                                                                    <option value="{{ $modelo->id }}">{{ $modelo->modelo }}</option>
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

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="pallets_table" class="display table table-striped table-bordered"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th scope="col">Formato</th>
                                                <th>modelo_id</th>
                                                <th scope="col">Modelo</th>
                                                <th scope="col">Accion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (isset($pallets))
                                                @foreach ($pallets as $pallet)
                                                    <tr>
                                                        <td>{{ $pallet->id }}</td>
                                                        <td scope="row">{{ $pallet->formato }}</td>
                                                        <td>{{ $pallet->modelo_id }}</td>
                                                        <td>{{ $pallet->modelo->modelo }}</td>
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
                                            @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="cubres" role="tabpanel" aria-labelledby="cubres-tab">
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-primary" type="button" id="btnNuevoCubre">Nuevo</button>
                                </div>
                            </div>

                            <!-- Modal Cubres-->
                            <div class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="modal-cubres">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <form action="/maestros/cubres" method="POST" id="cubre_form">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" id="cubre_method" value="PUT">
                                            <input type="hidden" name="id" id="cubre_id">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-cubres-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="validationCustom01">Formato</label>
                                                        <input type="text" class="form-control" id="cubre_formato"
                                                               placeholder="Formato" required="" name="formato">
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

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="cubres_table" class="display table table-striped table-bordered"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th scope="col">Formato</th>
                                                <th scope="col">Accion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (isset($cubres))
                                                @foreach ($cubres as $cubre)
                                                    <tr>
                                                        <td>{{ $cubre->id }}</td>
                                                        <td scope="row">{{ $cubre->formato }}</td>
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
                                            @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="auxiliares" role="tabpanel" aria-labelledby="auxiliares-tab">
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-primary" type="button" id="btnNuevoAuxiliar">Nuevo</button>
                                </div>
                            </div>

                            <!-- Modal Cubres-->
                            <div class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="modal-auxiliar">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <form action="/maestros/auxiliares" method="POST" id="auxiliar_form">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" id="auxiliar_method" value="PUT">
                                            <input type="hidden" name="id" id="auxiliar_id">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-auxiliar-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="auxiliar_modelo">Modelo</label>
                                                        <input type="text" class="form-control" id="auxiliar_modelo"
                                                               placeholder="Modelo" required="" name="modelo">
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

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="auxiliares_table" class="display table table-striped table-bordered"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th scope="col">Modelo</th>
                                                <th scope="col">Accion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (isset($auxiliares))
                                                @foreach ($auxiliares as $auxiliar)
                                                    <tr>
                                                        <td>{{ $auxiliar->id }}</td>
                                                        <td scope="row">{{ $auxiliar->modelo }}</td>
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
                                            @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tarrinas" role="tabpanel" aria-labelledby="tarrinas-tab">
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-primary" type="button" id="btnNuevoTarrina">Nuevo</button>
                                </div>
                            </div>

                            <!-- Modal Tarrinas-->
                            <div class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="modal-tarrina">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <form action="/maestros/tarrinas" method="POST" id="tarrina_form">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" id="tarrina_method" value="PUT">
                                            <input type="hidden" name="id" id="tarrina_id">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-tarrina-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="tarrina_modelo">Modelo</label>
                                                        <input type="text" class="form-control" id="tarrina_modelo"
                                                               placeholder="Modelo" required="" name="modelo">
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

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="tarrinas_table" class="display table table-striped table-bordered"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th scope="col">Modelo</th>
                                                <th scope="col">Accion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (isset($tarrinas))
                                                @foreach ($tarrinas as $tarrina)
                                                    <tr>
                                                        <td>{{ $tarrina->id }}</td>
                                                        <td scope="row">{{ $tarrina->modelo }}</td>
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
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
        $(function(){
            var activeNav = "{{ session('activeNav') }}";
            if(activeNav == undefined || activeNav == ""){
                activeNav = "cajas";
            }
            $("#"+activeNav+"-tab").attr('aria-selected', true).addClass('active show');
            $("#"+activeNav).addClass('active show');
        });
    </script>

    {{--Cajas--}}
    <script>
        var table_cajas

        $(document).ready(function () {
            // Configuracion de Datatable
            table_cajas = $('#cajas_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0], visible: false},
                ]
            });

            $('#cajas_table .edit').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_cajas.row(tr).data();
                limpiarCamposCaja();

                $('#caja_id').val(row[0]);
                $('#caja_formato').val(row[1]);
                $('#caja_modelo').val(row[2]);
                $('#caja_kg').val(row[3]);
                $('#caja_form').attr('action', '/maestros/cajas/' + row[0]);

                $("#modal-cajas-title").html("Modificar Caja");
                $("#caja_method").val('PUT');
                $("#modal-cajas").modal('show');
            });

            $('#cajas_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_cajas.row(tr).data();

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
                    window.location.href = "{{ url('maestros/cajas/delete') }}" + "/" + row[0]
                })
            });

            $("#btnNuevaCaja").click(function (e) {
                limpiarCamposCaja();
                $("#modal-cajas-title").html("Nueva Caja");
                $("#caja_method").val(null);
                $("#modal-cajas").modal('show');
            })
        });

        function limpiarCamposCaja() {
            $('#caja_id, #caja_formato, #caja_modelo, #caja_kg').val(null);
        }
    </script>

    {{--Pallets--}}
    <script>
        var table_pallets

        $(document).ready(function () {
            $(".chosen").chosen({
                width: "100%",
                no_results_text: "No se encontraron resultados... ",
                allow_single_deselect: true
            });

            // Configuracion de Datatable
            table_pallets = $('#pallets_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0, 2], visible: false},
                ]
            });

            $('#pallets_table .edit').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_pallets.row(tr).data();
                limpiarCamposPallet();

                $('#pallet_id').val(row[0]);
                $('#pallet_formato').val(row[1]);
                $('#pallet_modelo_id').val(row[2]).trigger('chosen:updated');
                $('#pallet_form').attr('action', '/maestros/pallets/' + row[0]);

                $("#modal-pallets-title").html("Modificar Palet");
                $("#pallet_method").val('PUT');
                $("#modal-pallets").modal('show');
            });

            $('#pallets_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_pallets.row(tr).data();

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
                    window.location.href = "{{ url('maestros/pallets/delete') }}" + "/" + row[0]
                });
            });

            $("#btnNuevoPallet").click(function (e) {
                limpiarCamposPallet();
                $("#modal-pallets-title").html("Nuevo Palet");
                $("#pallet_method").val(null);
                $("#modal-pallets").modal('show');
            })
        });

        function limpiarCamposPallet() {
            $('#pallet_id, #pallet_formato').val(null);
            $('#pallet_modelo_id').val(null).trigger('chosen:updated');
        }
    </script>

    {{--Cubres--}}
    <script>
        var table_cubres

        $(document).ready(function () {
            // Configuracion de Datatable
            table_cubres = $('#cubres_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0], visible: false},
                ]
            });

            $('#cubres_table .edit').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_cubres.row(tr).data();
                limpiarCamposCubre();

                $('#cubre_id').val(row[0]);
                $('#cubre_formato').val(row[1]);
                $('#cubre_form').attr('action', '/maestros/cubres/' + row[0]);

                $("#modal-cubres-title").html("Modificar Cubre");
                $("#cubre_method").val('PUT');
                $("#modal-cubres").modal('show');
            });

            $('#cubres_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_cubres.row(tr).data();

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
                    window.location.href = "{{ url('maestros/cubres/delete') }}" + "/" + row[0]
                })
            });

            $("#btnNuevoCubre").click(function (e) {
                limpiarCamposCubre();
                $("#modal-cubres-title").html("Nuevo Cubre");
                $("#cubre_method").val(null);
                $("#modal-cubres").modal('show');
            })
        });

        function limpiarCamposCubre() {
            $('#cubre_id, #cubre_formato').val(null);
        }
    </script>

    {{--Auxiliares--}}
    <script>
        var table_auxiliares

        $(document).ready(function () {
            // Configuracion de Datatable
            table_auxiliares = $('#auxiliares_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0], visible: false},
                ]
            });

            $('#auxiliares_table .edit').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_auxiliares.row(tr).data();
                limpiarCamposAuxiliares();

                $('#auxiliar_id').val(row[0]);
                $('#auxiliar_modelo').val(row[1]);
                $('#auxiliar_form').attr('action', '/maestros/auxiliares/' + row[0]);

                $("#modal-auxiliar-title").html("Modificar Auxiliar");
                $("#auxiliar_method").val('PUT');
                $("#modal-auxiliar").modal('show');
            });

            $('#auxiliares_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_auxiliares.row(tr).data();

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
                    window.location.href = "{{ url('maestros/auxiliares/delete') }}" + "/" + row[0]
                });
            });

            $("#btnNuevoAuxiliar").click(function (e) {
                limpiarCamposAuxiliares();
                $("#modal-auxiliar-title").html("Nuevo Auxiliar");
                $("#auxiliar_method").val(null);
                $("#modal-auxiliar").modal('show');
            })
        });

        function limpiarCamposAuxiliares() {
            $('#auxiliar_id, #auxiliar_modelo').val(null);
        }
    </script>

    {{--tarrinas--}}
    <script>
        var table_tarrinas

        $(document).ready(function () {
            // Configuracion de Datatable
            table_tarrinas = $('#tarrinas_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0], visible: false},
                ]
            });

            $('#tarrinas_table .edit').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_tarrinas.row(tr).data();
                limpiarCamposTarrinas();

                $('#tarrina_id').val(row[0]);
                $('#tarrina_modelo').val(row[1]);
                $('#tarrina_form').attr('action', '/maestros/tarrinas/' + row[0]);

                $("#modal-tarrina-title").html("Modificar Tarrina");
                $("#tarrina_method").val('PUT');
                $("#modal-tarrina").modal('show');
            });

            $('#tarrinas_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_tarrinas.row(tr).data();

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
                    window.location.href = "{{ url('maestros/tarrinas/delete') }}" + "/" + row[0]
                });
            });

            $("#btnNuevoTarrina").click(function (e) {
                limpiarCamposTarrinas();
                $("#modal-tarrina-title").html("Nueva Tarrina");
                $("#tarrina_method").val(null);
                $("#modal-tarrina").modal('show');
            })
        });

        function limpiarCamposTarrinas() {
            $('#tarrina_id, #tarrina_modelo').val(null);
        }
    </script>
@endsection
