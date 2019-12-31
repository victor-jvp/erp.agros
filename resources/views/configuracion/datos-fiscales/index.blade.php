@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Configuración</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Datos Fiscales de la Empresa</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Datos Fiscales de la Empresa</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}
                    <form action="{{ route('datos-fiscales.update') }}" method="POST"
                          id="datos_comerciales_form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_tab" value="datos-fiscales">
                        <input type="hidden" name="id" id="id" value="{{ $empresa->id }}">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cif">CIF</label>
                                <input type="text" class="form-control" id="cif" value="{{ $empresa->cif }}"
                                       placeholder="CIF" name="cif">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="razon_social">Razón Social</label>
                                <input type="text" class="form-control" id="razon_social"
                                       value="{{ $empresa->razon_social }}" placeholder="Razón Social"
                                       name="razon_social">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre_comercial">Nombre Comercial</label>
                                <input type="text" class="form-control" id="nombre_comercial"
                                       value="{{ $empresa->nombre_comercial }}" placeholder="Nombre Comercial"
                                       name="nombre_comercial">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="inputGroupFile01">Adjuntar logo</label>
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01"
                                           accept="image/gif, image/jpeg, image/png">Adjuntar</label>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <br>

                                @if(file_exists( './logos/logo_emp.jpg' ))
                                    <a href="{{ asset('logos/logo_emp.jpg') }}"
                                       class="btn btn-outline-primary btn-icon m-1">
                                        <span class="ul-btn__icon"><i class="i-File-Text--Image"></i></span>
                                        <span class="ul-btn__text">Ver Logo</span>
                                    </a>
                                @elseif(file_exists( './logos/logo_emp.png' ))
                                    <a href="{{ asset('logos/logo_emp.png') }}"
                                       class="btn btn-outline-primary btn-icon m-1">
                                        <span class="ul-btn__icon"><i class="i-File-Text--Image"></i></span>
                                        <span class="ul-btn__text">Ver Logo</span>
                                    </a>
                                @elseif(file_exists( './logos/logo_emp.gif' ))
                                    <a href="{{ asset('logos/logo_emp.gif') }}"
                                       class="btn btn-outline-primary btn-icon m-1">
                                        <span class="ul-btn__icon"><i class="i-File-Text--Image"></i></span>
                                        <span class="ul-btn__text">Ver Logo</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="direccion">Direccion</label>
                                <input type="text" class="form-control" id="direccion"
                                       value="{{ $empresa->direccion }}" placeholder="Direccion"
                                       name="direccion">
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control" id="telefono"
                                       value="{{ $empresa->telefono }}" placeholder="Teléfono" name="telefono">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" value="{{ $empresa->email }}"
                                       placeholder="Email" name="email">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-primary" type="submit">Guardar
                                </button>
                            </div>
                        </div>
                    </form>
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
                activeNav = "fincas";
            }
            $("#" + activeNav + "-tab").attr('aria-selected', true).addClass('active show');
            $("#" + activeNav).addClass('active show');
        });
    </script>

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
                    {targets: [0, 2], visible: false},
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

            $('#modal-parcelas').on('hidden.bs.modal', function () {
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
