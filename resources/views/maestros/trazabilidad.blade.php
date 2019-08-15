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
                                                <label for="cultivo_id">Cultivo</label>
                                                <select class="form-control chosen" name="cultivo_id"
                                                        id="cultivo_id" data-placeholder="Seleccione...">
                                                    <option value=""></option>
                                                    @foreach ($cultivos as $cultivo)
                                                        <option value="{{ $cultivo->id }}">{{ $cultivo->cultivo }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="variedad">Variedad</label>
                                                <select class="form-control chosen" name="variedad_id"
                                                        id="variedad_id" data-placeholder="Seleccione...">
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="marca">Marca</label>
                                                <select class="form-control chosen" name="marca_id"
                                                        id="marca_id" data-placeholder="Seleccione...">
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="finca_id">Finca</label>
                                                <select class="form-control chosen" name="finca_id"
                                                        id="finca_id" data-placeholder="Seleccione...">
                                                    <option value=""></option>
                                                    @foreach ($fincas as $finca)
                                                        <option value="{{ $finca->id }}">{{ $finca->finca }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="parcela_id">Parcela</label>
                                                <select class="form-control chosen" name="parcela_id"
                                                        id="parcela_id" data-placeholder="Seleccione...">
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
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="trazabilidad_table" class="display table table-striped table-bordered"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th scope="col">Finca</th>
                                        <th scope="col">Parcela</th>
                                        <th scope="col">Cultivo</th>
                                        <th scope="col">Variedad</th>
                                        <th scope="col">Marca</th>
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
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0], visible: false},
                ]
            });

            $(".chosen").chosen({
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

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#finca_id').on('change', function (evt, params) {
                var valor = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('trazabilidad.ajaxSelectParcela') }}",
                    dataType: 'JSON',
                    data: {
                        id: valor
                    },
                    success: function (data) {
                        ClearParcela();
                        if (data == null) return;

                        for (i = 0; i < data.length; i++) {
                            var value = data[i].id;
                            var text = data[i].parcela;

                            var option = "<option value='" + value + "'>" + text + "</option>";
                            $("#parcela_id").append(option);
                        }

                        $("#parcela_id").trigger('chosen:updated');
                    },
                    error: function (error) {
                        console.log(error)
                        alert('Error. Check Console Log');
                    },
                });
            })

            $('#cultivo_id').on('change', function (evt, params) {
                var valor = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('trazabilidad.ajaxSelectByCultivo') }}",
                    dataType: 'JSON',
                    data: {
                        id: valor
                    },
                    success: function (data) {
                        ClearByCultivos();
                        if (data == null) return;

                        for (i = 0; i < data.variedades.length; i++) {
                            var variedad_id = data.variedades[i].id;
                            var variedad = data.variedades[i].variedad;

                            var option_variedad = "<option value='" + variedad_id + "'>" + variedad + "</option>";
                            $("#variedad_id").append(option_variedad);
                        }

                        $("#variedad_id").trigger('chosen:updated');

                        for (i = 0; i < data.marcas.length; i++) {
                            var marca_id = data.marcas[i].id;
                            var marca = data.marcas[i].marca;

                            var option_marca = "<option value='" + marca_id + "'>" + marca + "</option>";
                            $("#marca_id").append(option_marca);
                        }

                        $("#marca_id").trigger('chosen:updated');
                    },
                    error: function (error) {
                        console.log(error)
                        alert('Error. Check Console Log');
                    },
                });
            });
        });

        function ClearParcela() {
            $("#parcela_id").html(null).append('<option value=""></option>');
        }

        function ClearByCultivos() {
            $("#variedad_id").html(null).append('<option value=""></option>');
            $("#marca_id").html(null).append('<option value=""></option>');
        }

    </script>
@endsection
