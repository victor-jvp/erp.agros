@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Maestros</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Trazabilidad</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Trazabilidad</h4>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <button class="btn btn-primary" type="button" id="btnNuevaTrazabilidad">Nuevo</button>
                        </div>
                    </div>

                    {{--Modal Producto Compuesto--}}
                    <div class="modal fade" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="modal-trazabilidad">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="/maestros/trazabilidad" method="POST" id="producto_form">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" id="trazabilidad_method" value="PUT">
                                    <input type="hidden" name="id" id="trazabilidad_id">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-trazabilidad-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="parcela_finca_id">Finca</label>
                                                <select class="form-control" name="finca_id"
                                                        id="finca_id" data-placeholder="Seleccione...">
                                                    <option value=""></option>
                                                    @foreach ($fincas as $finca)
                                                        <option value="{{ $finca->id }}">{{ $finca->finca }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="cultivo">Cultivo</label>
                                                <input type="text" class="form-control" id="cultivo"
                                                       placeholder="Cultivo" required="" name="cultivo">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="variedad">Variedad</label>
                                                <input type="text" class="form-control" id="variedad"
                                                       placeholder="Variedad" required="" name="variedad">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="marca">Marca</label>
                                                <input type="text" class="form-control" id="marca"
                                                       placeholder="Marca" required="" name="marca">
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
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="trazabilidad_table" class="display table table-striped table-bordered"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th scope="col">Parcela</th>
                                        <th scope="col">Finca</th>
                                        <th scope="col">Cultivo</th>
                                        <th scope="col">Variedad</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>

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

@section('before-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/chosen-bootstrap-4.css')}}">
@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/chosen.jquery.js')}}"></script>

    <script>
        var table_trazabilidad

        $(document).ready(function () {
            var table_trazabilidad = $("#trazabilidad_table").DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                },
                columnDefs: [
                    {targets: [0], visible: false},
                ]
            });

            $("#finca_id").chosen({
                width: "100%",
                no_results_text: "No se encontraron resultados... ",
                allow_single_deselect: true
            });

            $("#btnNuevaTrazabilidad").click(function (e) {
                $("#modal-trazabilidad-title").html('Agregar Trazabilidad');
                $("#modal-trazabilidad").modal("show");
            });
        });
    </script>
@endsection
