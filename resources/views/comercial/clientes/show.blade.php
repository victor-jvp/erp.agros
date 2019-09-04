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
                            <a class="nav-link" id="datos-fiscales-tab" data-toggle="tab" href="#datos-fiscales"
                               role="tab"
                               aria-controls="datos-fiscales" aria-selected="false">Datos
                                Fiscales</a>
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

                        <div class="tab-pane fade" id="contactos" role="tabpanel" aria-labelledby="contactos-tab">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <button class="btn btn-primary" type="button" id="btnNuevoContacto">Nuevo</button>
                                </div>
                            </div>

                            <!-- Modal Contactos-->
                            <div class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle"
                                 aria-hidden="true" id="modal-contacto">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="/comercial/clientes/{{$cliente->id}}/contactos" method="POST"
                                              id="contacto_form">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_tab" value="contactos">
                                            <input type="hidden" name="contacto_id" value="" id="contacto_id">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-contacto-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="contacto_descripcion">Descripcion</label>
                                                        <input type="text" class="form-control"
                                                               id="contacto_descripcion"
                                                               name="descripcion" required>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="contacto_telefono">Teléfono</label>
                                                        <input type="text" class="form-control" id="contacto_telefono"
                                                               name="telefono">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label for="contacto_telefono">Email</label>
                                                        <input type="email" class="form-control" id="contacto_email"
                                                               name="email" required>
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
                                    <table id="contactos_table" class="display table table-striped table-bordered"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Teléfono</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (isset($cliente->contactos))
                                            @foreach ($cliente->contactos as $contacto)
                                                <tr>
                                                    <td>{{ $contacto->id }}</td>
                                                    <td>{{ $contacto->descripcion }}</td>
                                                    <td>{{ $contacto->telefono }}</td>
                                                    <td>{{ $contacto->email }}</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="text-success mr-2 edit">
                                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="text-danger mr-2 delete">
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

                        <div class="tab-pane fade" id="historico-pedidos" role="tabpanel"
                             aria-labelledby="historico-pedidos-tab">

                        </div>

                        <div class="tab-pane fade" id="contactar-email" role="tabpanel"
                             aria-labelledby="contactar-email-tab">

                            <form action="/comercial/clientes/ajaxSendEmail" method="POST" id="email_form">

                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="exampleInputEmail2">Email</label>
                                        <input type="email" class="form-control form-control-rounded" readonly
                                               name="email"
                                               id="exampleInputEmail2" placeholder="No se ha registrado Email"
                                               value="{{ $cliente->email }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Ingrese su mensaje" required
                                                      name="message" id="message" cols="30" rows="3"></textarea>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-grow-1"></div>
                                            <button title="Enviar Email" data-toggle="tooltip" data-placement="top"
                                                    title="" data-original-title="Enviar Email"
                                                    class="btn btn-icon btn-rounded btn-primary mr-2" {{ (empty($cliente->email)) ? "disabled" : "" }}>
                                                <i class="i-Paper-Plane"></i>
                                            </button>
                                        </div>

                                    </div>
                                </div>

                            </form>

                        </div>

                        <div class="tab-pane fade" id="documentacion" role="tabpanel"
                             aria-labelledby="documentacion-tab">

                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <button class="btn btn-primary" type="button" id="btnNuevoAdjunto">Nuevo</button>
                                </div>
                            </div>

                            <!-- Modal entradas-->
                            <div class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle"
                                 aria-hidden="true" id="modal-adjunto">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="/almacen/proveedores/{{$cliente->id}}/adjuntos" method="POST"
                                              id="adjunto_form" enctype="multipart/form-data">
                                            {{ csrf_field() }}

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modal-adjunto-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-4 mb-3">
                                                        <label for="adjunto_fecha">Fecha</label>
                                                        <input type="date" class="form-control" id="adjunto_fecha"
                                                               value="{{ date('Y-m-d') }}" placeholder="Fecha"
                                                               required="" name="adjunto_fecha">
                                                    </div>

                                                    <div class="col-md-8 mb-3">
                                                        <label for="adjunto_descripcion">Descripcion</label>
                                                        <input type="text" class="form-control" id="adjunto_descripcion"
                                                               name="descripcion">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <div class="card text-left">
                                                            <div class="card-body">
                                                                <h4 class="card-title">Adjuntar</h4>
                                                                <form action="" method="post"
                                                                      enctype="multipart/form-data">
                                                                    <input type="file" name="file"/>
                                                                </form>
                                                            </div>
                                                        </div>
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
                                    <table id="adjuntos_table" class="display table table-striped table-bordered"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col">Accion</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (isset($cliente->adjuntos))
                                            @foreach ($cliente->adjuntos as $adjunto)
                                                <tr>
                                                    <td>{{ $entrada->id }}</td>
                                                    <td>{{ $adjunto->fecha }}</td>
                                                    <td>
                                                        <a href="{{ $adjunto->url }}">{{ $adjunto->descripcion }}</a>
                                                    </td>
                                                    <td>{{ $adjunto->tipo }}</td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="text-success mr-2 edit">
                                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="text-danger mr-2 delete">
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
        <!-- end of col -->
    </div>
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/chosen-bootstrap-4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/dropzone.min.css') }}">
@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/chosen.jquery.js')}}"></script>
    <script src="{{asset('assets/js/vendor/calendar/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/tooltip.script.js')}}"></script>
    <script src="{{asset('assets/js/vendor/dropzone.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            var tab = '{{ $tab }}';
            $("#" + tab + "").addClass('active show');
            $("#" + tab + "-tab").addClass('active show').attr('aria-selected', true);
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    {{--Contacto--}}
    <script>
        var contactos_table;

        $(document).ready(function () {
            // Configuracion de Datatable
            contactos_table = $('#contactos_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0], visible: false},
                ],
                responsive: true,
                order: [[1, 'desc']]
            });

            $("#btnNuevoContacto").click(function (e) {
                LimpiarCamposContactos();
                $("#modal-contacto-title").html("Nuevo Contacto");
                $("#modal-contacto").modal('show');
            });

            $('#contactos_table .edit').on('click', function () {
                LimpiarCamposContactos();
                var tr = $(this).closest('tr');
                var row = contactos_table.row(tr).data();
                console.log(row);

                $("#contacto_id").val(row[0]);
                $("#contacto_descripcion").val(row[1]);
                $("#contacto_telefono").val(row[2]);
                $("#contacto_email").val(row[3]);

                $("#modal-contacto-title").html("Modificar Contacto");
                $("#modal-contacto").modal('show');
            });

            $('#contactos_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = contactos_table.row(tr).data();

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
                    window.location.href = "{{ url('comercial/clientes/delete-contacto') }}" + "/" + row[0]
                });
            });
        });

        function LimpiarCamposContactos() {
            $("#contacto_id, #contacto_descripcion, #contacto_telefono, #contacto_email, #contacto_method").val(null);
        }
    </script>

    {{-- Enviar Email --}}
    <script>
        $(function () {
            $("#email_form").submit(function (e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');

                swal({
                    title: 'Enviando...',
                    text: 'Por favor espere.',
                    //imageUrl: "{{ asset('assets/images/loader.gif') }}",
                    html: '<div class="spinner-bubble spinner-bubble-primary m-5"></div>',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: 'JSON',
                    data: form.serialize(),
                    success: function (data) {
                        swal(data.title, data.message, data.type);
                    },
                    error: function (error) {
                        swal(error.title, error.message, error.type);
                        console.log(error); // show response from the php script.
                    }
                });

            });
        })
    </script>


    {{--Documentos adjuntos--}}
    <script>
        var adjuntos_table;

        $(document).ready(function () {
            // Configuracion de Datatable
            adjuntos_table = $('#adjuntos_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0], visible: false},
                ],
                responsive: true,
                order: [[1, 'desc']]
            });

            $("#btnNuevoAdjunto").click(function (e) {
                $("#modal-adjunto-title").html("Nuevo Adjunto");
                $("#modal-adjunto").modal('show');
            });

            // "myAwesomeDropzone" is the camelized version of the HTML element's ID
            Dropzone.options.myAwesomeDropzone = {
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                accept: function (file, done) {
                    if (file.name == "justinbieber.jpg") {
                        done("Naha, you don't.");
                    } else {
                        done();
                    }
                }
            };
        });
    </script>
@endsection