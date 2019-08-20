@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Comercial</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Clientes</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Cliente: <b>{{ $cliente->razon_social }}</b></h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="datos-fiscales-tab" data-toggle="tab"
                               href="#datos-fiscales"
                               role="tab" aria-controls="datos-fiscales" aria-selected="false">Datos
                                Fiscales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="datos-comerciales-tab" data-toggle="tab" href="#datos-comerciales"
                               role="tab" aria-controls="datos-comerciales" aria-selected="false">Datos Comerciales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contactos-tab" data-toggle="tab" href="#contactos" role="tab"
                               aria-controls="pallets" aria-selected="false">Contactos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="historico-pedidos-tab" data-toggle="tab" href="#historico-pedidos"
                               role="tab" aria-controls="pallets" aria-selected="false">Histórico de Pedidos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contactar-email-tab" data-toggle="tab" href="#contactar-email"
                               role="tab" aria-controls="pallets" aria-selected="false">Contactar via Email</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="documentacion-tab" data-toggle="tab" href="#documentacion"
                               role="tab"
                               aria-controls="pallets" aria-selected="false">Documentación</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="datos-fiscales" role="tabpanel"
                             aria-labelledby="datos-fiscales-tab">
                            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST"
                                  id="datos_comerciales_form">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" name="_tab" value="datos-fiscales">
                                <input type="hidden" name="id" id="id" value="{{ $cliente->id }}">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="cif">CIF</label>
                                        <input type="text" class="form-control" id="cif" value="{{ $cliente->cif }}"
                                               placeholder="CIF" required="" name="cif">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="razon_social">Razón Social</label>
                                        <input type="text" class="form-control" id="razon_social"
                                               value="{{ $cliente->razon_social }}" placeholder="Razón Social"
                                               required=""
                                               name="razon_social">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nombre_comercial">Nombre Comercial</label>
                                        <input type="text" class="form-control" id="nombre_comercial"
                                               value="{{ $cliente->nombre_comercial }}" placeholder="Nombre Comercial"
                                               name="nombre_comercial">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="pais">País</label>
                                        <input type="text" class="form-control" id="pais" value="{{ $cliente->pais }}"
                                               placeholder="País" name="pais">
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label for="localidad">Localidad</label>
                                        <input type="text" class="form-control" id="localidad"
                                               value="{{ $cliente->localidad }}" placeholder="Localidad"
                                               name="localidad">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="provincia">Provincia</label>
                                        <input type="text" class="form-control" id="provincia"
                                               value="{{ $cliente->provincia }}" placeholder="País" name="provincia">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="direccion">Direccion</label>
                                        <input type="text" class="form-control" id="direccion"
                                               value="{{ $cliente->direccion }}" placeholder="Direccion"
                                               name="direccion">
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono"
                                               value="{{ $cliente->telefono }}" placeholder="Teléfono" name="telefono">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" value="{{ $cliente->email }}"
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
                        <div class="tab-pane fade" id="datos-comerciales" role="tabpanel"
                             aria-labelledby="datos-comerciales-tab">
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-primary" type="button" id="btnAddDatosComerciales">Nuevo
                                    </button>
                                </div>
                            </div>

                            {{-- Modal Datos Comerciales --}}

                            <div class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle"
                                 aria-hidden="true" id="modal-datos-comerciales">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST"
                                              id="datos_comerciales_form">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <input type="hidden" name="_tab" value="datos-comerciales">
                                            <input type="hidden" name="id" id="id" value="{{ $cliente->id }}">
                                            <input type="hidden" name="datos_comerciales_id" id="datos_comerciales_id">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-datos-comerciales-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="datos_comerciales_nombre">Nombre</label>
                                                        <input type="text" class="form-control" placeholder="Nombre"
                                                               id="datos_comerciales_nombre"
                                                               required="" name="nombre">
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="datos_comerciales_direccion">Dirección</label>
                                                        <textarea class="form-control" id="datos_comerciales_direccion"
                                                                  placeholder="Dirección" name="direccion"></textarea>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="datos_comerciales_telefono">Teléfono</label>
                                                        <input type="text" class="form-control"
                                                               id="datos_comerciales_telefono"
                                                               placeholder="Teléfono" name="telefono">
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="datos_comerciales_email">Email</label>
                                                        <input type="text" class="form-control"
                                                               id="datos_comerciales_email"
                                                               placeholder="Email" required name="email">
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
                                        <table id="datos_comerciales_table"
                                               class="display table table-striped table-bordered"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Dirección</th>
                                                <th scope="col">Teléfono</th>
                                                <th scope="col">Correo Electrónico</th>
                                                <th scope="col">Accion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (isset($cliente->datosComerciales))
                                                @foreach ($cliente->datosComerciales as $cliente)
                                                    <tr>
                                                        <td>{{ $cliente->id }}</td>
                                                        <td scope="row">{{ $cliente->nombre }}</td>
                                                        <td>{{ $cliente->direccion }}</td>
                                                        <td>{{ $cliente->telefono }}</td>
                                                        <td>{{ $cliente->email }}</td>
                                                        <td>
                                                            <a href="javascript:void(0);"
                                                               class="text-success mr-2 edit">
                                                                <i class="nav-icon i-Pen-2 font-weight-bold "></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                               class="text-danger mr-2 delete">
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
        $(document).ready(function () {
            var tab = '{{ $tab }}';
            $("#"+tab+"").addClass('active show');
            $("#"+tab+"-tab").addClass('active show').attr('aria-selected', true);
        });
    </script>

    {{--Datos Comerciales--}}
    <script>
        var table_datos_comerciales

        $(function () {
            // Configuracion de Datatable
            table_datos_comerciales = $('#datos_comerciales_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [{
                    targets: [0],
                    visible: false
                },]
            });

            $('#datos_comerciales_table .edit').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_datos_comerciales.row(tr).data();
                limpiarCamposDatosComerciales();

                $('#datos_comerciales_id').val(row[0]);
                $('#datos_comerciales_nombre').val(row[1]);
                $('#datos_comerciales_direccion').val(row[2]);
                $('#datos_comerciales_telefono').val(row[3]);
                $('#datos_comerciales_email').val(row[4]);
                $('#datos_comerciales_form').attr('action', '/comercial/clientes/' + row[0]);

                $("#modal-datos-comerciales-title").html("Modificar Datos Comerciales");
                $("#modal-datos-comerciales").modal('show');
            });

            $('#datos_comerciales_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_datos_comerciales.row(tr).data();

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

            $("#btnAddDatosComerciales").click(function (e) {
                limpiarCamposDatosComerciales();
                $("#modal-datos-comerciales-title").html("Nuevos Datos Comerciales");
                $("#modal-datos-comerciales").modal('show');
            })
        });

        function limpiarCamposDatosComerciales() {
            $('#datos_comerciales_id, #datos_comerciales_nombre, #datos_comerciales_direccion, #datos_comerciales_telefono, #datos_comerciales_email').val(null);
        }
    </script>
@endsection