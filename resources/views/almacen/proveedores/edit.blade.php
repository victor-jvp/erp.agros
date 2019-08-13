@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Almacén</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Proveedores</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Proveedor: <b>{{ $proveedor->razon_social }}</b></h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="datos-fiscales-tab" data-toggle="tab"
                               href="#datos-fiscales" role="tab" aria-controls="cajas" aria-selected="true">Datos
                                Fiscales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="datos-comerciales-tab" data-toggle="tab" href="#datos-comerciales"
                               role="tab"
                               aria-controls="pallets" aria-selected="false">Datos Comerciales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contactos-tab" data-toggle="tab" href="#contactos" role="tab"
                               aria-controls="pallets" aria-selected="false">Contactos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="historico-pedidos-tab" data-toggle="tab" href="#historico-pedidos"
                               role="tab"
                               aria-controls="pallets" aria-selected="false">Histórico de Pedidos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contactar-email-tab" data-toggle="tab" href="#contactar-email"
                               role="tab"
                               aria-controls="pallets" aria-selected="false">Contactar via Email</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="documentacion-tab" data-toggle="tab" href="#documentacion"
                               role="tab"
                               aria-controls="pallets" aria-selected="false">Documentación</a>
                        </li>
                    </ul>


                    <div class="tab-content" id="myTabContent">
                        <form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST" id="finca_form">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input type="hidden" name="id" id="id" value="{{ $proveedor->id }}">

                            <div class="tab-pane fade active show" id="datos-fiscales" role="tabpanel"
                                 aria-labelledby="datos-fiscales-tab">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="cif">CIF</label>
                                        <input type="text" class="form-control" id="cif" value="{{ $proveedor->cif }}"
                                               placeholder="CIF" required="" name="cif">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="razon_social">Razón Social</label>
                                        <input type="text" class="form-control" id="razon_social"
                                               value="{{ $proveedor->razon_social }}"
                                               placeholder="Razón Social" required="" name="razon_social">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nombre_comercial">Nombre Comercial</label>
                                        <input type="text" class="form-control" id="nombre_comercial"
                                               value="{{ $proveedor->nombre_comercial }}"
                                               placeholder="Nombre Comercial" name="nombre_comercial">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="pais">País</label>
                                        <input type="text" class="form-control" id="pais" value="{{ $proveedor->pais }}"
                                               placeholder="País" name="pais">
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label for="localidad">Localidad</label>
                                        <input type="text" class="form-control" id="localidad"
                                               value="{{ $proveedor->localidad }}"
                                               placeholder="Localidad" name="localidad">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="provincia">Provincia</label>
                                        <input type="text" class="form-control" id="provincia"
                                               value="{{ $proveedor->provincia }}"
                                               placeholder="País" name="provincia">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="direccion">Direccion</label>
                                        <input type="text" class="form-control" id="direccion"
                                               value="{{ $proveedor->direccion }}"
                                               placeholder="Direccion" name="direccion">
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono"
                                               value="{{ $proveedor->telefono }}"
                                               placeholder="Teléfono" name="telefono">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email"
                                               value="{{ $proveedor->email }}"
                                               placeholder="Email" name="email">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <button class="btn btn-primary" type="submit">Guardar
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </form>
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
                                                            @if(isset($fincas))
                                                                @foreach ($fincas as $finca)
                                                                    <option value="{{ $finca->id }}">{{ $finca->finca }}</option>
                                                                @endforeach
                                                            @endif
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
                                                <th scope="col">Por definir</th>
                                                <th>finca_id</th>
                                                <th scope="col">Por definir</th>
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
