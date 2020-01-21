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
                            <a class="nav-link" id="cultivos-tab" data-toggle="tab" href="#cultivos"
                               role="tab" aria-controls="cajas" aria-selected="false">Cultivos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="variedades-tab" data-toggle="tab" href="#variedades" role="tab"
                               aria-controls="pallets" aria-selected="false">Variedades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="marcas-tab" data-toggle="tab" href="#marcas" role="tab"
                               aria-controls="cubres" aria-selected="false">Marcas</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="cultivos" role="tabpanel" aria-labelledby="cultivos-tab">

                            <div class="row">
                                @can('Maestros - Familias y Marcas | Crear')
                                    <div class="col-md-3">
                                        <button class="btn btn-primary" type="button" id="btnNuevoCultivo">Nuevo
                                        </button>
                                    </div>
                                @endcan
                            </div>

                            <!-- Modal Cultivos-->
                            <div class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle"
                                 aria-hidden="true" id="modal-cultivos">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <form action="/maestros/cultivos" method="POST" id="cultivo_form">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" id="cultivo_method" value="PUT">
                                            <input type="hidden" name="id" id="cultivo_id">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-cultivos-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="validationCustom01">Cultivo</label>
                                                        <input type="text" class="form-control" id="cultivo"
                                                               placeholder="Cultivo" required="" name="cultivo">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Cerrar
                                                </button>
                                                @canany(['Maestros - Familias y Marcas | Crear', 'Maestros - Familias y Marcas | Modificar'])
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                @endcanany
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="cultivos_table" class="display table table-striped table-bordered"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th scope="col">Cultivo</th>
                                                <th scope="col">Accion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (isset($cultivos))
                                                @foreach ($cultivos as $cultivo)
                                                    <tr>
                                                        <td>{{ $cultivo->id }}</td>
                                                        <td scope="row">{{ $cultivo->cultivo }}</td>
                                                        <td>
                                                            @can('Maestros - Familias y Marcas | Modificar')
                                                                <a href="javascript:void(0);" class="text-success mr-2">
                                                                    <i class="nav-icon i-Pen-2 font-weight-bold edit"></i>
                                                                </a>
                                                            @endcan
                                                            @can('Maestros - Familias y Marcas | Borrar')
                                                                <a href="javascript:void(0);" class="text-danger mr-2">
                                                                    <i class="nav-icon i-Close-Window font-weight-bold delete"></i>
                                                                </a>
                                                            @endcan
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
                        <div class="tab-pane fade" id="variedades" role="tabpanel" aria-labelledby="variedades-tab">
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-primary" type="button" id="btnNuevaVariedad">Nuevo</button>
                                </div>
                            </div>

                            <!-- Modal Pallets-->
                            <div class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle"
                                 aria-hidden="true" id="modal-variedades">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <form action="/maestros/variedades" method="POST" id="variedad_form">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" id="variedad_method" value="PUT">
                                            <input type="hidden" name="id" id="variedad_id">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-variedades-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="variedad">Variedad</label>
                                                        <input type="text" class="form-control" id="variedad"
                                                               placeholder="Variedad" required="" name="variedad">
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="variedad_cultivo_id">Cultivo</label>
                                                        <select class="form-control" name="cultivo_id"
                                                                id="variedad_cultivo_id">
                                                            <option value="" hidden>Cultivo...</option>
                                                            @foreach ($cultivos as $cultivo)
                                                                <option
                                                                    value="{{ $cultivo->id }}">{{ $cultivo->cultivo }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Cerrar
                                                </button>
                                                @canany(['Maestros - Familias y Marcas | Crear', 'Maestros - Familias y Marcas | Modificar'])
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                @endcanany
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="variedades_table" class="display table table-striped table-bordered"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th scope="col">Variedad</th>
                                                <th>CULTIVO_ID</th>
                                                <th scope="col">Cultivo</th>
                                                <th scope="col">Accion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (isset($variedades))
                                                @foreach ($variedades as $variedad)
                                                    <tr>
                                                        <td>{{ $variedad->id }}</td>
                                                        <td scope="row">{{ $variedad->variedad }}</td>
                                                        <td>{{ $variedad->cultivo_id }}</td>
                                                        <td>{{ $variedad->cultivo->cultivo }}</td>
                                                        <td>
                                                            @can('Maestros - Familias y Marcas | Modificar')
                                                                <a href="javascript:void(0);" class="text-success mr-2">
                                                                    <i class="nav-icon i-Pen-2 font-weight-bold edit"></i>
                                                                </a>
                                                            @endcan
                                                            @can('Maestros - Familias y Marcas | Borrar')
                                                                <a href="javascript:void(0);" class="text-danger mr-2">
                                                                    <i class="nav-icon i-Close-Window font-weight-bold delete"></i>
                                                                </a>
                                                            @endcan
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
                        <div class="tab-pane fade" id="marcas" role="tabpanel" aria-labelledby="marcas-tab">
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-primary" type="button" id="btnNuevaMarca">Nuevo</button>
                                </div>
                            </div>

                            <!-- Modal Cubres-->
                            <div class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle"
                                 aria-hidden="true" id="modal-marcas">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <form action="/maestros/marcas" method="POST" id="marca_form">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" id="marca_method" value="PUT">
                                            <input type="hidden" name="id" id="marca_id">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-marcas-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="marca">Marca</label>
                                                        <input type="text" class="form-control" id="marca"
                                                               placeholder="Marca" required="" name="marca">
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="marca_cultivo_id">Cultivo</label>
                                                        <select class="form-control" name="cultivo_id"
                                                                id="marca_cultivo_id">
                                                            <option value="" hidden>Cultivo...</option>
                                                            @foreach ($cultivos as $cultivo)
                                                                <option
                                                                    value="{{ $cultivo->id }}">{{ $cultivo->cultivo }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Cerrar
                                                </button>
                                                @canany(['Maestros - Familias y Marcas | Crear', 'Maestros - Familias y Marcas | Modificar'])
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                @endcanany
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="marcas_table" class="display table table-striped table-bordered"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th scope="col">Marca</th>
                                                <th>cultivo_id</th>
                                                <th scope="col">Cultivo</th>
                                                <th scope="col">Accion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (isset($marcas))
                                                @foreach ($marcas as $marca)
                                                    <tr>
                                                        <td>{{ $marca->id }}</td>
                                                        <td scope="row">{{ $marca->marca }}</td>
                                                        <td>{{ $marca->cultivo_id }}</td>
                                                        <td>{{ $marca->cultivo->cultivo }}</td>
                                                        <td>
                                                            @can('Maestros - Familias y Marcas | Modificar')
                                                                <a href="javascript:void(0);"
                                                                   class="text-success mr-2 edit">
                                                                    <i class="nav-icon i-Pen-2 font-weight-bold "></i>
                                                                </a>
                                                            @endcan
                                                            @can('Maestros - Familias y Marcas | Borrar')
                                                                <a href="javascript:void(0);"
                                                                   class="text-danger mr-2 delete">
                                                                    <i class="nav-icon i-Close-Window font-weight-bold "></i>
                                                                </a>
                                                            @endcan
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

    <script>
        $(function () {
            var activeNav = "{{ session('activeNav') }}";
            if (activeNav == undefined || activeNav == "") {
                activeNav = "cultivos";
            }
            $("#" + activeNav + "-tab").attr('aria-selected', true).addClass('active show');
            $("#" + activeNav).addClass('active show');
        });
    </script>

    {{--Cultivos--}}
    <script>
        var table_cultivos

        $(document).ready(function () {
            // Configuracion de Datatable
            table_cultivos = $('#cultivos_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [{
                    targets: [0],
                    visible: false
                },]
            });

            $('#cultivos_table .edit').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_cultivos.row(tr).data();
                limpiarCamposCultivo();

                $('#cultivo_id').val(row[0]);
                $('#cultivo').val(row[1]);
                $('#cultivo_form').attr('action', '/maestros/cultivos/' + row[0]);

                $("#modal-cultivos-title").html("Modificar Cultivo");
                $("#cultivo_method").val('PUT');
                $("#modal-cultivos").modal('show');
            });

            $('#cultivos_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_cultivos.row(tr).data();

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
                    window.location.href = "{{ url('maestros/cultivos/delete') }}" + "/" + row[0]
                })
            });

            $("#btnNuevoCultivo").click(function (e) {
                limpiarCamposCultivo();
                $("#modal-cultivos-title").html("Nuevo Cultivo");
                $("#cultivo_method").val(null);
                $("#modal-cultivos").modal('show');
            })
        });

        function limpiarCamposCultivo() {
            $('#cultivo_id, #cultivo').val(null);
        }
    </script>

    {{--Variedades--}}
    <script>
        var table_variedades

        $(document).ready(function () {
            // Configuracion de Datatable
            table_variedades = $('#variedades_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [{
                    targets: [0, 2],
                    visible: false
                },]
            });

            $('#variedades_table .edit').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_variedades.row(tr).data();
                $('#variedad_id').val(row[0]);
                $('#variedad').val(row[1]);
                $('#variedad_cultivo_id').find('option[value="' + row[2] + '"]').attr("selected",
                    "selected");
                $('#variedad_form').attr('action', '/maestros/variedades/' + row[0]);

                $("#modal-variedades-title").html("Modificar Variedad");
                $("#variedad_method").val('PUT');
                $("#modal-variedades").modal('show');
            });

            $('#modal-variedades').on('hidden.bs.modal', function () {
                limpiarCamposVariedades();
            })

            $('#variedades_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_variedades.row(tr).data();

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
                    window.location.href = "{{ url('maestros/variedades/delete') }}" + "/" + row[0]
                })
            });

            $("#btnNuevaVariedad").click(function (e) {
                limpiarCamposVariedades();
                $("#modal-variedades-title").html("Nueva Variedad");
                $("#variedad_method").val(null);
                $("#modal-variedades").modal('show');
            })
        });

        function limpiarCamposVariedades() {
            $('#variedad_id, #variedad').val(null);
            $('#variedad_cultivo_id option[selected="selected"]').removeAttr('selected');
        }
    </script>

    {{--Marcas--}}
    <script>
        var table_marcas

        $(document).ready(function () {
            // Configuracion de Datatable
            table_marcas = $('#marcas_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [{
                    targets: [0, 2],
                    visible: false
                },]
            });

            $('#marcas_table .edit').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_marcas.row(tr).data();
                $('#marca_id').val(row[0]);
                $('#marca').val(row[1]);
                $('#marca_cultivo_id').find('option[value="' + row[2] + '"]').attr("selected", "selected");
                $('#marca_form').attr('action', '/maestros/marcas/' + row[0]);

                $("#modal-marcas-title").html("Modificar Marcas");
                $("#marca_method").val('PUT');
                $("#modal-marcas").modal('show');
            });

            $('#modal-marcas').on('hidden.bs.modal', function () {
                limpiarCamposMarcas();
            })

            $('#marcas_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_variedades.row(tr).data();

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
                    window.location.href = "{{ url('maestros/marcas/delete') }}" + "/" + row[0]
                })
            });

            $("#btnNuevaMarca").click(function (e) {
                limpiarCamposMarcas();
                $("#modal-marcas-title").html("Nueva Marca");
                $("#marca_method").val(null);
                $("#modal-marcas").modal('show');
            })
        });

        function limpiarCamposMarcas() {
            $('#marca_id, #variedad').val(null);
            $('#marca_cultivo_id option[selected="selected"]').removeAttr('selected');
        }
    </script>
@endsection
