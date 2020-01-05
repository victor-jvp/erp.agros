@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Configuracion</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Email</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Email</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}

                    <form action="" method="POST">

                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="card-title mb-3">Email</div>
                                        <form>
                                            <div class="row">
                                                <div class="col-md-6 form-group mb-3">
                                                    <label for="mail_username">Email</label>
                                                    <input type="email" class="form-control"
                                                           name="mail_username"
                                                           value="{{ $especiales->mail_username }}">
                                                </div>

                                                <div class="col-md-6 form-group mb-3">
                                                    <label for="mail_password">Contraseña</label>
                                                    <input type="password" class="form-control"
                                                           name="mail_password">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 form-group mb-3">
                                                    <label for="mail_host">Host</label>
                                                    <input type="text" class="form-control" name="mail_host"
                                                           value="{{ $especiales->mail_host }}">
                                                </div>

                                                <div class="col-md-6 form-group mb-3">
                                                    <label for="mail_port">Puerto</label>
                                                    <input type="number" class="form-control" name="mail_port"
                                                           value="{{ $especiales->mail_port }}">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 form-group mb-3">
                                                    <label for="mail_driver">Email Driver</label>
                                                    <select name="mail_driver" id="mail_driver" class="form-control">
                                                        <option value="smtp">SMTP</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button class="btn btn-primary" type="submit">Guardar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
