@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Comercial</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Transportes</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Transportes</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}

                    <div class="row">
                        @can('Comercial - Transportes | Crear')
                            <div class="col-md-3">
                                <button class="btn btn-primary" type="button" id="btnNuevo">Nuevo</button>
                            </div>
                        @endcan
                    </div>

                    <!-- Modal Agregar Proveedor-->
                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                         aria-hidden="true" id="modal-transporte">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <form action="/comercial/transportes" method="POST" id="transporte_form">
                                    {{ csrf_field() }}

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-proveedor-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="cif">CIF</label>
                                                <input type="text" class="form-control" id="cif" placeholder="CIF"
                                                       required="" name="cif">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="razon_social">Razón Social</label>
                                                <input type="text" class="form-control" id="razon_social"
                                                       placeholder="Razón Social" required="" name="razon_social">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Cerrar
                                        </button>
                                        @can('Comercial - Transportes | Crear')
                                            <button type="submit" class="btn btn-primary">Continuar</button>
                                        @endcan
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="transportes_table" class="display table table-striped table-bordered"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th scope="col">CIF</th>
                                        <th scope="col">Razón Social</th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($transportes))
                                        @foreach ($transportes as $transporte)
                                            <tr>
                                                <td>{{ $transporte->id }}</td>
                                                <td>{{ $transporte->cif }}</td>
                                                <td scope="row">{{ $transporte->razon_social }}</td>
                                                <td>{{ $transporte->telefono }}</td>
                                                <td>{{ $transporte->email }}</td>
                                                <td>
                                                    @can('Comercial - Transportes | Modificar')
                                                        <a href="{{ route('transportes.show', $transporte->id) }}"
                                                           class="text-success mr-2 edit">
                                                            <i class="nav-icon i-Pen-2 font-weight-bold "></i>
                                                        </a>
                                                    @endcan
                                                    @can('Comercial - Transportes | Borrar')
                                                        <a href="javascript:void(0);" class="text-danger mr-2 delete">
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

    {{--Proveedores--}}
    <script>
        var table_transportes

        $(function () {
            // Configuracion de Datatable
            table_transportes = $('#transportes_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [{
                    targets: [0],
                    visible: false
                },]
            });

            $('#transportes_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_transportes.row(tr).data();

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
                    window.location.href = "{{ url('comercial/transportes/delete') }}" + "/" + row[0]
                })
            });

            $("#btnNuevo").click(function (e) {
                limpiarCamposTransporte();
                $("#modal-transporte-title").html("Nuevo Transporte");
                $("#modal-transporte").modal('show');
            })
        });

        function limpiarCamposTransporte() {
            $('#cif, #razon_social').val(null);
        }
    </script>
@endsection
