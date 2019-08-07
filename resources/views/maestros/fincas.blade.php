@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Maestros</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Fincas</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Fincas y Parcelas</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="fincas-tab" data-toggle="tab" href="#fincas"
                               role="tab"
                               aria-controls="cajas" aria-selected="true">Fincas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="parcelas-tab" data-toggle="tab" href="#parcelas" role="tab"
                               aria-controls="pallets" aria-selected="false">Parcelas</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="fincas" role="tabpanel"
                             aria-labelledby="fincas-tab">

                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-primary" type="button" id="btnNuevaFinca">Nuevo</button>
                                </div>
                            </div>

                            <!-- Modal Fincas-->
                            <div class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="modal-fincas">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <form action="/maestros/fincas" method="POST" id="finca_form">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" id="finca_method" value="PUT">
                                            <input type="hidden" name="id" id="finca_id">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-fincas-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="finca">Finca</label>
                                                        <input type="text" class="form-control" id="finca"
                                                               placeholder="Finca" required="" name="finca">
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
                                        <table id="fincas_table" class="display table table-striped table-bordered"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th scope="col">Finca</th>
                                                <th scope="col">Accion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (isset($fincas))
                                                @foreach ($fincas as $finca)
                                                    <tr>
                                                        <td>{{ $finca->id }}</td>
                                                        <td scope="row">{{ $finca->finca }}</td>
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
                        <div class="tab-pane fade" id="parcelas" role="tabpanel" aria-labelledby="parcelas-tab">
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-primary" type="button" id="btnNuevaParcela">Nuevo</button>
                                </div>
                            </div>

                            <!-- Modal Parcelas-->
                            <div class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="modal-parcelas">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <form action="/maestros/parcelas" method="POST" id="parcela_form">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" id="parcela_method" value="PUT">
                                            <input type="hidden" name="id" id="parcela_id">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-parcelas-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="parcela">Parcela</label>
                                                        <input type="text" class="form-control" id="parcela"
                                                               placeholder="Parcela" required="" name="parcela">
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="parcela_finca_id">Finca</label>
                                                        <select class="form-control" name="finca_id"
                                                                id="parcela_finca_id">
                                                            <option value="" hidden>Finca...</option>
                                                            @foreach ($fincas as $finca)
                                                                <option value="{{ $finca->id }}">{{ $finca->finca }}</option>
                                                            @endforeach
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
                                        <table id="parcelas_table" class="display table table-striped table-bordered"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th scope="col">Parcela</th>
                                                <th>finca_id</th>
                                                <th scope="col">Finca</th>
                                                <th scope="col">Accion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (isset($parcelas))
                                                @foreach ($parcelas as $parcela)
                                                    <tr>
                                                        <td>{{ $parcela->id }}</td>
                                                        <td scope="row">{{ $parcela->parcela }}</td>
                                                        <td>{{ $parcela->finca_id }}</td>
                                                        <td>{{ $parcela->finca->finca }}</td>
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

    {{--Fincas--}}
    <script>
        var table_fincas

        $(function () {
            // Configuracion de Datatable
            table_fincas = $('#fincas_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0], visible: false},
                ]
            });

            $('#fincas_table .edit').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_fincas.row(tr).data();
                limpiarCamposFinca();

                $('#finca_id').val(row[0]);
                $('#finca').val(row[1]);
                $('#finca_form').attr('action', '/maestros/fincas/' + row[0]);

                $("#modal-fincas-title").html("Modificar Finca");
                $("#finca_method").val('PUT');
                $("#modal-fincas").modal('show');
            });

            $('#fincas_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_fincas.row(tr).data();

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
                    window.location.href = "{{ url('maestros/fincas/delete') }}" + "/" + row[0]
                })
            });

            $("#btnNuevaFinca").click(function (e) {
                limpiarCamposFinca();
                $("#modal-fincas-title").html("Nueva Finca");
                $("#finca_method").val(null);
                $("#modal-fincas").modal('show');
            })
        });

        function limpiarCamposFinca() {
            $('#finca_id, #finca').val(null);
        }
    </script>

    {{--Parcelas--}}
    <script>
        var table_parcelas

        $(function () {
            // Configuracion de Datatable
            table_parcelas = $('#parcelas_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0,2], visible: false},
                ]
            });

            $('#parcelas_table .edit').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_parcelas.row(tr).data();
                $('#parcela_id').val(row[0]);
                $('#parcela').val(row[1]);
                $('#parcela_finca_id').find('option[value="' + row[2] + '"]').attr("selected", "selected");
                $('#parcela_form').attr('action', '/maestros/parcelas/' + row[0]);

                $("#modal-parcelas-title").html("Modificar Parcela");
                $("#parcela_method").val('PUT');
                $("#modal-parcelas").modal('show');
            });

            $('#modal-parcelas').on('hidden.bs.modal',function () {
                limpiarCamposParcelas();
            })

            $('#parcelas_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_parcelas.row(tr).data();

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
                    window.location.href = "{{ url('maestros/parcelas/delete') }}" + "/" + row[0]
                })
            });

            $("#btnNuevaParcela").click(function (e) {
                limpiarCamposParcelas();
                $("#modal-parcelas-title").html("Nueva Parcela");
                $("#parcela_method").val(null);
                $("#modal-parcelas").modal('show');
            })
        });

        function limpiarCamposParcelas() {
            $('#parcela_id, #parcela').val(null);
            $('#parcela_finca_id option[selected="selected"]').removeAttr('selected');
        }
    </script>
@endsection
