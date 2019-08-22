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
                            <form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST"
                                  id="finca_form">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" name="_tab" value="datos-fiscales">
                                <input type="hidden" name="id" id="id" value="{{ $proveedor->id }}">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="cif">CIF</label>
                                        <input type="text" class="form-control" id="cif" value="{{ $proveedor->cif }}"
                                               placeholder="CIF" required="" name="cif">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="razon_social">Razón Social</label>
                                        <input type="text" class="form-control" id="razon_social"
                                               value="{{ $proveedor->razon_social }}" placeholder="Razón Social"
                                               required=""
                                               name="razon_social">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nombre_comercial">Nombre Comercial</label>
                                        <input type="text" class="form-control" id="nombre_comercial"
                                               value="{{ $proveedor->nombre_comercial }}" placeholder="Nombre Comercial"
                                               name="nombre_comercial">
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
                                               value="{{ $proveedor->localidad }}" placeholder="Localidad"
                                               name="localidad">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="provincia">Provincia</label>
                                        <input type="text" class="form-control" id="provincia"
                                               value="{{ $proveedor->provincia }}" placeholder="País" name="provincia">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="direccion">Direccion</label>
                                        <input type="text" class="form-control" id="direccion"
                                               value="{{ $proveedor->direccion }}" placeholder="Direccion"
                                               name="direccion">
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono"
                                               value="{{ $proveedor->telefono }}" placeholder="Teléfono"
                                               name="telefono">
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
                                        <form action="/almacen/proveedores/{{$proveedor->id}}/contactos" method="POST"
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
                                        @if (isset($proveedor->contactos))
                                            @foreach ($proveedor->contactos as $contacto)
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

                            <div class="row">
                                <div class="col-md-12">
                                    <table id="entradas_table" class="display table table-striped table-bordered"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">N° Lote</th>
                                            <th scope="col">Fecha Entrada</th>
                                            <th scope="col">Categoria</th>
                                            <th scope="col">Material</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Nº Albaran</th>
                                            <th scope="col">Fecha Albaran</th>
                                            <th scope="col">Transporte Adecuado</th>
                                            <th scope="col">Control Plagas</th>
                                            <th scope="col">Estado Palets</th>
                                            <th scope="col">Ficha Técnica</th>
                                            <th scope="col">Material Dañado</th>
                                            <th scope="col">Material Limpio</th>
                                            <th scope="col">Control Grapas</th>
                                            <th scope="col">Cantidad Conforme</th>
                                            {{--                                            <th scope="col">Accion</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (isset($proveedor->entradas))
                                            @foreach ($proveedor->entradas as $entrada)
                                                <tr>
                                                    <td>{{ $entrada->id }}</td>
                                                    <td>{{ $entrada->nro_lote }}</td>
                                                    <td>{{ date('d/m/Y',strtotime($entrada->fecha)) }}</td>
                                                    @if($entrada->caja_id != null)
                                                        <td>Caja</td>
                                                        <td>{{ $entrada->caja->formato }}</td>
                                                    @else
                                                        <td>Palet</td>
                                                        <td>{{ $entrada->pallet->formato }}</td>
                                                    @endif
                                                    <td>{{ $entrada->cantidad }}</td>
                                                    <td>{{ $entrada->nro_albaran }}</td>
                                                    <td>{{ date('d/m/Y',strtotime($entrada->fecha_albaran)) }}</td>
                                                    <td class="text-center">
                                                        <label class="checkbox checkbox-success"
                                                               style="display: inline-block">
                                                            <input disabled
                                                                   type="checkbox" {{ ($entrada->transporte_adecuado) ? 'checked' : '' }}>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="checkbox checkbox-success"
                                                               style="display: inline-block">
                                                            <input disabled
                                                                   type="checkbox" {{ ($entrada->control_plagas) ? 'checked' : '' }}>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="checkbox checkbox-success"
                                                               style="display: inline-block">
                                                            <input disabled
                                                                   type="checkbox" {{ ($entrada->estado_pallets) ? 'checked' : '' }}>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="checkbox checkbox-success"
                                                               style="display: inline-block">
                                                            <input disabled
                                                                   type="checkbox" {{ ($entrada->ficha_tecnica) ? 'checked' : '' }}>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="checkbox checkbox-success"
                                                               style="display: inline-block">
                                                            <input disabled
                                                                   type="checkbox" {{ ($entrada->material_daniado) ? 'checked' : '' }}>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="checkbox checkbox-success"
                                                               style="display: inline-block">
                                                            <input disabled
                                                                   type="checkbox" {{ ($entrada->material_limpio) ? 'checked' : '' }}>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="checkbox checkbox-success"
                                                               style="display: inline-block">
                                                            <input disabled
                                                                   type="checkbox" {{ ($entrada->control_grapas) ? 'checked' : '' }}>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="checkbox checkbox-success"
                                                               style="display: inline-block">
                                                            <input disabled
                                                                   type="checkbox" {{ ($entrada->cantidad_conforme) ? 'checked' : '' }}>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </td>
                                                    {{--                                                    <td>--}}
                                                    {{--                                                        <a href="javascript:void(0);"--}}
                                                    {{--                                                           onclick="LoadEntrada({{ $entrada->id }})"--}}
                                                    {{--                                                           class="text-success mr-2">--}}
                                                    {{--                                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                        <a href="javascript:void(0);" class="text-danger mr-2 delete">--}}
                                                    {{--                                                            <i class="nav-icon i-Close-Window font-weight-bold "></i>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                    </td>--}}
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="contactar-email" role="tabpanel"
                             aria-labelledby="contactar-email-tab">

                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="exampleInputEmail2">Email</label>
                                    <input type="email" class="form-control form-control-rounded" readonly
                                           id="exampleInputEmail2" placeholder="No se ha registrado Email"
                                           value="{{ $proveedor->email }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <form class="inputForm">
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Ingrese su mensaje" required
                                                      name="message" id="message" cols="30" rows="3"></textarea>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-grow-1"></div>
                                            <button title="Enviar Email" data-toggle="tooltip" data-placement="top"
                                                    title="" data-original-title="Enviar Email"
                                                    class="btn btn-icon btn-rounded btn-primary mr-2" {{ (empty($proveedor->email)) ? "disabled" : "" }}>
                                                <i class="i-Paper-Plane"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

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
                                        <form action="/almacen/proveedores/{{$proveedor->id}}/adjuntos" method="POST"
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
                                                                <form action="" method="post" enctype="multipart/form-data">
                                                                    <input type="file" name="file" />
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
                                        @if (isset($proveedor->adjuntos))
                                            @foreach ($proveedor->adjuntos as $adjunto)
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
    </script>

    {{--Entradas--}}
    <script>
        var entradas_table;

        $(document).ready(function () {
            // Configuracion de Datatable
            entradas_table = $('#entradas_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0, 3], visible: false},
                ],
                responsive: true,
                order: [[1, 'desc']]
            });

            $("#btnNuevo").click(function (e) {
                limpiarCamposEntrada();
                $("#modal-entradas-title").html("Nueva Entrada");
                var nextNroLote = $("#nextNroLote").val();
                $("#nro_lote").val(nextNroLote);
                $("#entrada_method").val(null);
                $("#modal-entradas").modal('show');
            });

            $('#entradas_table').on('click', '.delete', function () {
                var current_row = $(this).parents('tr');//Get the current row
                if (current_row.hasClass('child')) {//Check if the current row is a child row
                    current_row = current_row.prev();//If it is, then point to the row before it (its 'parent')
                }
                var row = entradas_table.row(current_row).data();//At this point, current_row refers to a valid row in the table, whether is a child row (collapsed by the DataTable's responsiveness) or a 'normal' row
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
                    window.location.href = "{{ url('almacen/entrada-productos/delete') }}" + "/" + row[0];
                })
            });
        });

        function LoadEntrada(id) {
            limpiarCamposEntrada();


            $.ajax({
                type: 'POST',
                url: "{{ route('entrada-productos.GetEntrada') }}",
                dataType: 'JSON',
                data: {
                    id: id
                },
                success: function (data) {
                    if (data == null) return;

                    $("#nro_lote").val(data.nro_lote);
                    $("#fecha").val(moment(data.fecha).format("YYYY-MM-DD"));
                    var material = null;
                    if (data.pallet_id != null) {
                        $('#categoria').val("pallets").trigger('chosen:updated');
                        material = data.pallet_id;
                        loadMaterial("pallets", material)
                    } else {
                        $('#categoria').val("cajas").trigger('chosen:updated');
                        material = data.caja_id;
                        loadMaterial("cajas", material)
                    }
                    $("#cantidad").val(data.cantidad);
                    $("#nro_albaran").val(data.nro_albaran);
                    $("#fecha_albaran").val(moment(data.fecha_albaran).format("YYYY-MM-DD"));
                    $("input[name='transporte_adecuado']").prop('checked', (data.transporte_adecuado == 1));
                    $("input[name='control_plagas']").prop('checked', (data.control_plagas == 1));
                    $("input[name='estado_pallets']").prop('checked', (data.estado_pallets == 1));
                    $("input[name='ficha_tecnica']").prop('checked', (data.ficha_tecnica == 1));
                    $("input[name='material_daniado']").prop('checked', (data.material_daniado == 1));
                    $("input[name='material_limpio']").prop('checked', (data.material_limpio == 1));
                    $("input[name='control_grapas']").prop('checked', (data.control_grapas == 1));
                    $("input[name='cantidad_conforme']").prop('checked', (data.cantidad_conforme == 1));
                    $('#proveedor').val(data.proveedor_id).trigger('chosen:updated');

                    $('#entrada_form').attr('action', '/almacen/entrada-productos/' + data.id);

                    $("#modal-entradas-title").html("Modificar Entrada");
                    $("#entrada_method").val('PUT');
                    $("#modal-entradas").modal('show');
                },
                error: function (error) {
                    console.log(error)
                    alert('Error. Check Console Log');
                },
            });
        }

        function limpiarCamposEntrada() {
            $('#nro_lote, #fecha, #cantidad, #nro_albaran, #fecha_albaran').val(null);
            $(".chosen").val(null).trigger('chosen:updated');
            $("#modal-entradas input[type=checkbox]").prop('checked', true);
            $("#modal-entradas input[name='material_daniado']").prop("checked", false);
        }
    </script>

    <script>
        $(document).ready(function () {
            $(".chosen").chosen({
                width: "100%",
                no_results_text: "No se encontraron resultados... ",
                allow_single_deselect: true
            });
        })
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#categoria').on('change', function (evt, params) {
                var value = $(this).val();
                loadMaterial(value);
            });
        });

        function loadMaterial(valor, selected) {
            $.ajax({
                type: 'POST',
                url: "{{ route('entrada-productos.selectMaterial') }}",
                dataType: 'JSON',
                data: {
                    "categoria": valor
                },
                success: function (data) {
                    ClearMaterial();
                    if (data == null) return;

                    for (i = 0; i < data.length; i++) {
                        var value = data[i].id;
                        var text = data[i].formato;
                        var option = "<option value='" + value + "'>" + text + "</option>";
                        $("#material").append(option);
                    }

                    if (selected != null) {
                        $("#material").val(selected).trigger('chosen:updated');
                    } else {
                        $("#material").trigger('chosen:updated');
                    }
                },
                error: function (error) {
                    console.log(error)
                    alert('Error. Check Console Log');
                },
            });
        }

        function ClearMaterial() {
            $("#material").html(null).append('<option value=""></option>');
        }

    </script>
    {{--Fin Entradas--}}

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
                    window.location.href = "{{ url('almacen/proveedores/delete-contacto') }}" + "/" + row[0]
                });
            });
        });

        function LimpiarCamposContactos() {
            $("#contacto_id, #contacto_descripcion, #contacto_telefono, #contacto_email, #contacto_method").val(null);
        }
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
                accept: function(file, done) {
                    if (file.name == "justinbieber.jpg") {
                        done("Naha, you don't.");
                    }
                    else { done(); }
                }
            };
        });
    </script>
@endsection