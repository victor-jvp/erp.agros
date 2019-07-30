@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Maestros</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Familias y Marcas</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Familias y Marcas</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="cajas-tab" data-toggle="tab" href="#cajas" role="tab"
                               aria-controls="cajas" aria-selected="true">Cultivos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pallets-tab" data-toggle="tab" href="#pallets" role="tab"
                               aria-controls="pallets" aria-selected="false">Variedades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="cubres-tab" data-toggle="tab" href="#cubres" role="tab"
                               aria-controls="cubres" aria-selected="false">Marcas</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="cajas" role="tabpanel" aria-labelledby="cajas-tab">

                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-primary" type="button" id="btnNuevaCaja">Nuevo</button>
                                </div>
                            </div>

                            <!-- Modal Cajas-->
                            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="modal-cajas">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <form action="/maestros/cajas" method="POST" id="caja_form">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" id="caja_method" value="PUT">
                                            <input type="hidden" name="id" id="caja_id">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-cajas-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                               placeholder="Kilogramos" required="" name="kg" step="0.01">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
                                        <table id="cajas_table" class="display table table-striped table-bordered" style="width:100%">
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
                        <div class="tab-pane fade" id="pallets" role="tabpanel" aria-labelledby="pallets-tab">
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-primary" type="button" id="btnNuevoPallet">Nuevo</button>
                                </div>
                            </div>

                            <!-- Modal Pallets-->
                            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="modal-pallets">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <form action="/maestros/pallets" method="POST" id="pallet_form">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" id="pallet_method" value="PUT">
                                            <input type="hidden" name="id" id="pallet_id">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-pallets-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                        <label for="validationCustom02">Modelo</label>
                                                        <input type="text" class="form-control" id="pallet_modelo"
                                                               placeholder="Modelo" required="" name="modelo">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
                                        <table id="pallets_table" class="display table table-striped table-bordered" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th scope="col">Formato</th>
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
                                                        <td>{{ $pallet->modelo }}</td>
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
                            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="modal-cubres">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <form action="/maestros/cubres" method="POST" id="cubre_form">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" id="cubre_method" value="PUT">
                                            <input type="hidden" name="id" id="cubre_id">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-cubres-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
                                        <table id="cubres_table" class="display table table-striped table-bordered" style="width:100%">
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
@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>

    {{--Cajas--}}
    <script>
        var table_cajas

        $(document).ready(function () {
            // Configuracion de Datatable
            table_cajas = $('#cajas_table').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                },
                columnDefs: [
                    { targets: [0], visible: false},
                ]
            });

            $('#cajas_table .edit').on( 'click', function () {
                var tr = $(this).closest('tr');
                var row = table_cajas.row( tr ).data();
                limpiarCamposCaja();

                $('#caja_id').val(row[0]);
                $('#caja_formato').val(row[1]);
                $('#caja_modelo').val(row[2]);
                $('#caja_kg').val(row[3]);
                $('#caja_form').attr('action', '/maestros/cajas/'+row[0]);

                $("#modal-cajas-title").html("Modificar Caja");
                $("#caja_method").val('PUT');
                $("#modal-cajas").modal('show');
            });

            $('#cajas_table .delete').on( 'click', function () {
                var tr = $(this).closest('tr');
                var row = table_cajas.row( tr ).data();

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
                    window.location.href = "{{ url('maestros/cajas/delete') }}"+"/"+row[0]
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
            // Configuracion de Datatable
            table_pallets = $('#pallets_table').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                },
                columnDefs: [
                    { targets: [0], visible: false},
                ]
            });

            $('#pallets_table .edit').on( 'click', function () {
                var tr = $(this).closest('tr');
                var row = table_pallets.row( tr ).data();
                limpiarCamposPallet();

                $('#pallet_id').val(row[0]);
                $('#pallet_formato').val(row[1]);
                $('#pallet_modelo').val(row[2]);
                $('#pallet_form').attr('action', '/maestros/pallets/'+row[0]);

                $("#modal-pallets-title").html("Modificar Pallet");
                $("#pallet_method").val('PUT');
                $("#modal-pallets").modal('show');
            });

            $('#pallets_table .delete').on( 'click', function () {
                var tr = $(this).closest('tr');
                var row = table_pallets.row( tr ).data();

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
                    window.location.href = "{{ url('maestros/pallets/delete') }}"+"/"+row[0]
                }, function (dismiss) {
                    // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                    // if (dismiss === 'cancel') {
                    //     swal(
                    //         'Cancelled',
                    //         'Your imaginary file is safe :)',
                    //         'error'
                    //     )
                    // }
                })
            });

            $("#btnNuevoPallet").click(function (e) {
                limpiarCamposPallet();
                $("#modal-pallets-title").html("Nuevo Pallet");
                $("#pallet_method").val(null);
                $("#modal-pallets").modal('show');
            })
        });

        function limpiarCamposPallet() {
            $('#pallet_id, #pallet_formato, #pallet_modelo').val(null);
        }
    </script>

    {{--Cubres--}}
    <script>
        var table_cubres

        $(document).ready(function () {
            // Configuracion de Datatable
            table_cubres = $('#cubres_table').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                },
                columnDefs: [
                    { targets: [0], visible: false},
                ]
            });

            $('#cubres_table .edit').on( 'click', function () {
                var tr = $(this).closest('tr');
                var row = table_cubres.row( tr ).data();
                limpiarCamposCubre();

                $('#cubre_id').val(row[0]);
                $('#cubre_formato').val(row[1]);
                $('#cubre_form').attr('action', '/maestros/cubres/'+row[0]);

                $("#modal-cubres-title").html("Modificar Cubre");
                $("#cubre_method").val('PUT');
                $("#modal-cubres").modal('show');
            });

            $('#cubres_table .delete').on( 'click', function () {
                var tr = $(this).closest('tr');
                var row = table_cubres.row( tr ).data();

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
                    window.location.href = "{{ url('maestros/cubres/delete') }}"+"/"+row[0]
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
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                },
                columnDefs: [
                    { targets: [0], visible: false},
                ]
            });

            $('#auxiliares_table .edit').on( 'click', function () {
                var tr = $(this).closest('tr');
                var row = table_auxiliares.row( tr ).data();
                limpiarCamposPallet();

                $('#auxiliar_id').val(row[0]);
                $('#auxiliar_modelo').val(row[1]);
                $('#auxiliar_form').attr('action', '/maestros/auxiliares/'+row[0]);

                $("#modal-auxiliar-title").html("Modificar Auxiliar");
                $("#auxiliar_method").val('PUT');
                $("#modal-auxiliar").modal('show');
            });

            $('#auxiliares_table .delete').on( 'click', function () {
                var tr = $(this).closest('tr');
                var row = table_auxiliares.row( tr ).data();

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
                    window.location.href = "{{ url('maestros/auxiliares/delete') }}"+"/"+row[0]
                });
            });

            $("#btnNuevoAuxiliar").click(function (e) {
                limpiarCamposPallet();
                $("#modal-auxiliar-title").html("Nuevo Auxiliar");
                $("#auxiliar_method").val(null);
                $("#modal-auxiliar").modal('show');
            })
        });

        function limpiarCamposPallet() {
            $('#auxiliar_id, #auxiliar_modelo').val(null);
        }
    </script>
@endsection
