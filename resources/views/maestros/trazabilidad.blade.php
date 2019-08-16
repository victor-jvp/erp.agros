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
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <form action="/maestros/trazabilidad" method="POST" id="trazabilidad_form">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" id="trazabilidad_method" value="">
                                    <input type="hidden" name="id" id="trazabilidad_id">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-trazabilidad-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="col-md-12 mb-3">
                                            <label for="finca_id">Finca</label>
                                            <select class="form-control chosen" name="finca_id"
                                                    id="finca_id" data-placeholder="Seleccione...">
                                                <option value=""></option>
                                                @foreach ($fincas as $finca)
                                                    <option value="{{ $finca->id }}">{{ $finca->finca }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="parcela_id">Parcela</label>
                                            <select class="form-control chosen" name="parcela_id"
                                                    id="parcela_id" data-placeholder="Seleccione...">
                                            </select>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="cultivo_id">Cultivo</label>
                                            <select class="form-control chosen" name="cultivo_id"
                                                    id="cultivo_id" data-placeholder="Seleccione...">
                                                <option value=""></option>
                                                @foreach ($cultivos as $cultivo)
                                                    <option value="{{ $cultivo->id }}">{{ $cultivo->cultivo }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="variedad">Variedad</label>
                                            <select class="form-control chosen" name="variedad_id"
                                                    id="variedad_id" data-placeholder="Seleccione...">
                                            </select>
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
                                        <th scope="col">Traza</th>
                                        <th scope="col">Finca</th>
                                        <th scope="col">Parcela</th>
                                        <th scope="col">Cultivo</th>
                                        <th scope="col">Variedad</th>
                                        <th scope="col">Acción</th>
                                        <th>finca_id</th>
                                        <th>parcela_id</th>
                                        <th>cultivo_id</th>
                                        <th>variedad_id</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($trazabilidades))
                                        @foreach($trazabilidades as $trazabilidad)
                                            <tr>
                                                <td>{{ $trazabilidad->id }}</td>
                                                <td>{{ $trazabilidad->traza }}</td>
                                                <td>{{ $trazabilidad->parcela->finca->finca }}</td>
                                                <td>{{ $trazabilidad->parcela->parcela }}</td>
                                                <td>{{ $trazabilidad->variedad->cultivo->cultivo }}</td>
                                                <td>{{ $trazabilidad->variedad->variedad }}</td>
                                                <td>
                                                    <a href="javascript:void(0);" class="text-success mr-2">
                                                        <i class="nav-icon i-Pen-2 font-weight-bold edit"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="text-danger mr-2">
                                                        <i class="nav-icon i-Close-Window font-weight-bold delete"></i>
                                                    </a>
                                                </td>
                                                <td>{{ $trazabilidad->parcela->finca->id }}</td>
                                                <td>{{ $trazabilidad->parcela->id }}</td>
                                                <td>{{ $trazabilidad->variedad->cultivo->id }}</td>
                                                <td>{{ $trazabilidad->variedad->id }}</td>
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
{{--    <script src="{{asset('assets/js/vendor/calendar/moment.min.js')}}"></script>--}}

    <script>
        var table_trazabilidad

        $(document).ready(function () {
            var table_trazabilidad = $("#trazabilidad_table").DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0, 7, 8, 9, 10], visible: false},
                ]
            });

            $(".chosen").chosen({
                width: "100%",
                no_results_text: "No se encontraron resultados... ",
                allow_single_deselect: true
            });

            $("#btnNuevaTrazabilidad").click(function (e) {
                limpiarCamposTrazabilidad();
                $("#modal-trazabilidad-title").html('Agregar Trazabilidad');
                $("#modal-trazabilidad").modal("show");
            });

            $('#trazabilidad_table .edit').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_trazabilidad.row(tr).data();
                limpiarCamposTrazabilidad();

                $("#trazabilidad_id").val(row[0]);

                $('#finca_id').val(row[7]);
                $('#cultivo_id').val(row[9]);

                $("#finca_id, #cultivo_id").trigger('chosen:updated');

                ajaxSelectParcela(row[7], row[8]);
                ajaxSelectByCultivo(row[9], row[10]);

                $('#trazabilidad_form').attr('action', '/maestros/trazabilidad/' + row[0]);

                $("#modal-trazabilidad-title").html("Modificar Trazabilidad");
                $("#trazabilidad_method").val('PUT');
                $("#modal-trazabilidad").modal('show');
            });

            $('#trazabilidad_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_trazabilidad.row(tr).data();

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
                    window.location.href = "{{ url('maestros/trazabilidad/delete') }}" + "/" + row[0]
                })
            });
        });

        function limpiarCamposTrazabilidad() {
            $("#finca_id, #cultivo_id").val(null).trigger('chosen:updated');
            $("#variedad_id, #parcela_id").html(null).append('<option value=""></option>');
            $("#variedad_id, #parcela_id").trigger('chosen:updated');
        }
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
                ajaxSelectParcela(valor);
            });

            $('#cultivo_id').on('change', function (evt, params) {
                var valor = $(this).val();
                ajaxSelectByCultivo(valor);
            });
        });

        function ajaxSelectParcela(id, selected) {
            $.ajax({
                type: 'POST',
                url: "{{ route('trazabilidad.ajaxSelectParcela') }}",
                dataType: 'JSON',
                data: {
                    id: id
                },
                success: function (data) {
                    ClearParcela();
                    if (data == null || data.length <= 0) return;

                    for (i = 0; i < data.length; i++) {
                        var value = data[i].id;
                        var text = data[i].parcela;

                        var isSelected = "";
                        if (selected != null && value == selected) isSelected = "selected";

                        var option = "<option " + isSelected + " value='" + value + "'>" + text + "</option>";
                        $("#parcela_id").append(option);
                    }

                    $("#parcela_id").trigger('chosen:updated');
                },
                error: function (error) {
                    console.log(error)
                    alert('Error. Check Console Log');
                },
            });
        }

        function ajaxSelectByCultivo(id, selected_variedad_id) {
            $.ajax({
                type: 'POST',
                url: "{{ route('trazabilidad.ajaxSelectByCultivo') }}",
                dataType: 'JSON',
                data: {
                    id: id
                },
                success: function (data) {
                    ClearByCultivos();

                    if (data.variedades != null && data.variedades.length > 0) {
                        for (i = 0; i < data.variedades.length; i++) {
                            var variedad_id = data.variedades[i].id;
                            var variedad = data.variedades[i].variedad;

                            var isSelected = "";
                            if (selected_variedad_id != null && selected_variedad_id == variedad_id) isSelected = "selected";

                            var option_variedad = "<option " + isSelected + " value='" + variedad_id + "'>" + variedad + "</option>";
                            $("#variedad_id").append(option_variedad);
                        }
                        $("#variedad_id").trigger('chosen:updated');
                    }
                },
                error: function (error) {
                    console.log(error)
                    alert('Error. Check Console Log');
                },
            });
        }

        function ClearParcela() {
            $("#parcela_id").html(null).append('<option value=""></option>');
        }

        function ClearByCultivos() {
            $("#variedad_id").html(null).append('<option value=""></option>').trigger('chosen:updated');
        }

    </script>
@endsection
