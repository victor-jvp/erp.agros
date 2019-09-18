@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Comercial</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Pedidos Comerciales</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">Pedidos Comerciales</div>

                    <form action="/comercial/pedidos-comercial" method="POST" id="pedido_form">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" id="pedido_method" value="">

                        <!-- Modal Pedido-->
                        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                             aria-hidden="true" id="modal-pedido">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-pedido-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="nro_orden">Nº Orden</label>
                                                <input type="text" name="nro_orden" id="nro_orden" class="form-control">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="anio">Año</label>
                                                <input type="text" name="anio" id="anio" class="form-control" readonly>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="semana">Semana</label>
                                                <input type="text" name="semana" id="semana" class="form-control"
                                                       readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="cliente">Cliente</label>
                                                <select class="form-control chosen" id="cliente" name="cliente">
                                                    @foreach ($clientes as $cliente)
                                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="destino_comercial">Destino Comercial</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <a href="javascript:void(0);" class="input-group-text"
                                                           id="btnDestinoComercial"><i class="i-Information"></i></a>
                                                    </div>
                                                    <input type="text" name="destino_comercial" id="destino_comercial"
                                                           class="form-control" value="" aria-label="Username"
                                                           aria-describedby="zona_info">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="cultivo">Cultivo</label>
                                                <select class="form-control chosen" id="cultivo" name="cultivo">
                                                    @foreach ($cultivos as $cultivo)
                                                        <option value="{{ $cultivo->id }}">{{ $cultivo->cultivo }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="dias[]" value="1" class="dias">
                                                    <span>Miércoles</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="dias[]" value="2" class="dias">
                                                    <span>Jueves</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="dias[]" value="3" class="dias">
                                                    <span>Viernes</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="dias[]" value="4" class="dias">
                                                    <span>Sábado</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="dias[]" value="5" class="dias">
                                                    <span>Domingo</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="dias[]" value="6" class="dias">
                                                    <span>Lunes</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="dias[]" value="7" class="dias">
                                                    <span>Martes</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="etiqueta">Etiqueta</label>
                                                <input type="text" class="form-control" name="etiqueta" id="etiqueta">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="transporte">Transporte</label>
                                                <select class="form-control chosen" id="transporte" name="transporte_id">
                                                    @foreach ($transportes as $transporte)
                                                        <option value="{{ $transporte->id }}">{{ $transporte->razon_social }} | {{ $transporte->cif }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="producto">Producto</label>
                                                <select class="form-control chosen" id="producto">
                                                    @foreach ($productos as $producto)
                                                        <option value="{{ $producto->id }}">{{ $producto->compuesto }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="producto_compuesto">Compuesto</label>
                                                <select class="form-control chosen" id="producto_compuesto"
                                                        name="producto_compuesto">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="modelo_palet">Tipo de Palet</label>
                                                <select class="form-control chosen" id="modelo_palet">
                                                    @foreach ($modelos as $modelo)
                                                        <option value="{{ $modelo->id }}">{{ $modelo->modelo }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="formato_palet">Formato de Palet</label>
                                                <select class="form-control chosen" id="formato_palet"
                                                        name="formato_palet">
                                                </select>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="cantidad">Cantidad</label>
                                                <input type="number" class="form-control" name="cantidad" id="cantidad"
                                                       step="0.01" min="0.00" placeholder="0.00">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="precio">Precio Kg</label>
                                                <input type="number" name="precio" id="precio" class="form-control"
                                                       step="0.01" min="0.00" placeholder="0.00">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="kilos">Kilos</label>
                                                <input type="number" class="form-control" name="kilos" id="kilos" readonly placeholder="0.00">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="comentario">
                                                    Comentario
                                                </label>
                                                <textarea class="form-control" name="comentario" id="comentario"
                                                          rows="2"></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="estado">Estado</label>
                                                <select name="estado" id="estado" class="form-control">
                                                    @foreach ($estados as $estado)
                                                        <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
                                                    @endforeach
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
                                </div>
                            </div>
                        </div>
                        {{-- Fin modal Pedido --}}

                        {{--Modal Destino Comercial--}}
                        <div class="modal fade" id="modal-destino_comercial" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-destino_comercial-title">Destinos Comerciales
                                            del
                                            Cliente</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 mb-3 table-responsive">
                                                <table class="table table-striped table-sm" width="100%"
                                                       id="table_destinos_comerciales">
                                                    <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Destino</th>
                                                        <th>Direccion</th>
                                                        <th>Poblacion</th>
                                                        <th>Ciudad</th>
                                                        <th>Pais</th>
                                                        <th>Accion</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" id="btnCloseModalDestinoComercial">Cerrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--FIN Modal Destino Comercial--}}
                    </form>

                    <form action="/comercial/pedidos-comercial" method="GET" id="form_fecha_act">
                        <div class="row">

                            <div class="col-md-3 form-group mb-3">
                                <label>Año</label>
                                <select class="form-control" name="anio_act" id="anio_act">
                                    @for($i = $anio_ini; $i <= $anio_fin; $i++)
                                        <option
                                                {{ ($i == $anio_act) ? 'selected' : '' }} value="{{ $i }}">
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-3 form-group mb-3">
                                <label>Semana</label>
                                <select class="form-control" name="semana_act" id="semana_act">
                                    @for($i = $semana_ini; $i <= $semana_fin; $i++)
                                        <option
                                                {{ ($i == $semana_act) ? 'selected' : '' }} value="{{ $i }}">
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-6  text-right form-group mb-3">
                                <br>
                                <button class="btn btn-outline-primary" type="button" id="btnAddPedido">Añadir Pedido
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Cultivos</label>

                            <ul class="nav nav-pills" id="myPillTab" role="tablist">
                                @foreach ($cultivos as $c => $cultivo)
                                    <li class="nav-item">
                                        <a class="nav-link {{ ($c==0) ? 'active show' : '' }}" id="home-icon-pill"
                                           data-toggle="pill" href="#cultivo_{{ $cultivo->id }}_pill" role="tab"
                                           aria-controls="cultivo_{{ $cultivo->id }}_pill"
                                           aria-selected="{{ ($c==0) ? 'true' : 'false' }}">{{ $cultivo->cultivo }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content" id="myPillTabContent">
                                @foreach ($cultivos as $c => $cultivo)
                                    <div class="tab-pane fade {{ ($c==0) ? 'active show' : '' }}"
                                         id="cultivo_{{ $cultivo->id }}_pill" role="tabpanel"
                                         aria-labelledby="cultivo_{{ $cultivo->id }}_pill">
                                        <div class="row">
                                            <div class="col-md-12 mb-3 table-responsive">
                                                <table class="table table_pedidos" width="100%">
                                                    <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nº Orden</th>
                                                        <th>Año</th>
                                                        <th>Semana</th>
                                                        <th>Dia</th>
                                                        <th>Cliente</th>
                                                        <th>Destino</th>
                                                        <th>Formato</th>
                                                        <th>Etiqueta</th>
                                                        <th>Transporte</th>
                                                        <th>Precio €/Kg</th>
                                                        <th>Observación</th>
                                                        <th>Estado</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($cultivo->pedidos as $pedido)
                                                        <tr>
                                                            <td>{{ $pedido->id }}</td>
                                                            <td>{{ $pedido->nro_orden }}</td>
                                                            <td>{{ $pedido->anio }}</td>
                                                            <td>{{ $pedido->semana }}</td>
                                                            <td>{{ $pedido->dia->dia }}</td>
                                                            <td>{{ (!is_null($pedido->cliente)) ? $pedido->cliente->razon_social : "" }}</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>{{ $pedido->etiqueta }}</td>
                                                            <td></td>
                                                            <td>{{ $pedido->precio }}</td>
                                                            <td>{{ $pedido->comentarios }}</td>
                                                            <td>{{ $pedido->estado->estado }}</td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/chosen-bootstrap-4.css')}}">
@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/chosen.jquery.js')}}"></script>
    <script src="{{asset('assets/js/vendor/calendar/moment-with-locales.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $(".chosen").chosen({
                width: "100%",
                no_results_text: "No se encontraron resultados... ",
                placeholder_text_single: "Seleccione una opción...",
                allow_single_deselect: true
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        $(function () {
            $("#semana_act, #anio_act").change(function () {
                $("#form_fecha_act").submit();
            });
        })
    </script>

    <script>
        var nro_orden = "{{ $nro_orden }}";
        var table_destinos;
        $(document).ready(function () {
            // Configuracion de Datatable
            $('.table_pedidos').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [{
                    targets: [0],
                    visible: false
                },],
                responsive: true
            });

            table_destinos = $('#table_destinos_comerciales').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0], visible: false}
                ],
                responsive: true,
                info: false,
                paging: false
            });

            // $.fn.dataTable
            //     .tables( { visible: true, api: true } )
            //     .columns.adjust();

            $('.table_pedidos .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_clientes.row(tr).data();

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
                    window.location.href = "{{ url('comercial/clientes/delete') }}" + "/" + row[0]
                })
            });

            $("#btnAddPedido").click(function (e) {
                limpiarCamposPedido();
                $("#nro_orden").val(nro_orden);
                $("#anio").val($("#anio_act").val())
                $("#semana").val($("#semana_act").val())
                $("#modal-pedido-title").html("Nuevo Pedido");
                $("#pedido_method").val(null);
                $("#modal-pedido").modal('show');
            });

            $("#btnDestinoComercial").click(function (e) {
                $("#modal-destino_comercial").modal('show');
            });

            $("#btnCloseModalDestinoComercial").click(function (e) {
                $("#modal-destino_comercial").modal('toggle');
                $('#modal-pedido').css('overflow-y', 'auto');

            });

            $("#cliente").change(function () {
                var cliente = $(this).val();
                LoadDestinosComerciales(cliente);
            });

            $("#producto").on('change', function () {
                var compuesto_id = $(this).val();
                loadCompuesto(compuesto_id)
            });

            $("#modelo_palet").on('change', function () {
                var modelo_id = $(this).val();
                loadPalet(modelo_id)
            });
        });

        function limpiarCamposPedido() {
            $('#nro_orden, #cliente, #destino_comercial, #cultivo, #formato, #etiqueta, #transporte, #precio, #kilos, #comentario')
                .val(null);
            $('#producto, #producto_compuesto, #modelo_palet, #formato_palet, #cantidad').val(null);
            $(".dias").prop("checked", false).prop('disabled', false);
            $(".chosen").trigger("chosen:updated");
        }

        function LoadDestinosComerciales(valor, selected) {
            $.ajax({
                type: 'POST',
                url: "{{ route('pedidos-comercial.ajaxGetDestinosComerciales') }}",
                dataType: 'JSON',
                data: {
                    "id": valor
                },
                success: function (data) {
                    ClearDestinosComerciales();
                    if (data == null) return;

                    for (i = 0; i < data.length; i++) {
                        var row = data[i];
                        var options = '<label class="checkbox checkbox-success"><input type="checkbox" name="destinos[]" value="' + row.id + '"><span class="checkmark"></span></label>';
                        table_destinos.row.add([
                            row.id,
                            row.descripcion,
                            row.direccion,
                            row.poblacion,
                            row.ciudad,
                            row.pais,
                            options
                        ]).draw();
                    }
                },
                error: function (error) {
                    console.log(error);
                    alert('Error. Check Console Log');
                },
            });
        }

        function ClearDestinosComerciales() {
            table_destinos.rows().remove().draw();
        }

        function loadCompuesto(valor, selected) {
            $.ajax({
                type: 'POST',
                url: "{{ route('productos-compuestos.ajaxGetDetalles') }}",
                dataType: 'JSON',
                data: {
                    "id": valor
                },
                success: function (data) {
                    ClearCompuesto();
                    if (data == null) return;

                    for (i = 0; i < data.length; i++) {
                        var value = data[i].id;
                        var text = data[i].variable;
                        var option = "<option value='" + value + "'>" + text + "</option>";
                        $("#producto_compuesto").append(option);
                    }

                    if (selected != null) {
                        $("#producto_compuesto").val(selected).trigger('chosen:updated');
                    } else {
                        $("#producto_compuesto").trigger('chosen:updated');
                    }
                },
                error: function (error) {
                    console.log(error)
                    alert('Error. Check Console Log');
                },
            });
        }

        function ClearCompuesto() {
            $("#producto_compuesto").html(null).append('<option value=""></option>');
        }

        function loadPalet(valor, selected) {
            $.ajax({
                type: 'POST',
                url: "{{ route('pallets.ajaxGetPalletByModelo') }}",
                dataType: 'JSON',
                data: {
                    "id": valor
                },
                success: function (data) {
                    ClearPalet();
                    if (data == null) return;

                    for (i = 0; i < data.length; i++) {
                        var value = data[i].id;
                        var text = data[i].formato;
                        var option = "<option value='" + value + "'>" + text + "</option>";
                        $("#formato_palet").append(option);
                    }

                    if (selected != null) {
                        $("#formato_palet").val(selected).trigger('chosen:updated');
                    } else {
                        $("#formato_palet").trigger('chosen:updated');
                    }
                },
                error: function (error) {
                    console.log(error)
                    alert('Error. Check Console Log');
                },
            });
        }

        function ClearPalet() {
            $("#formato_palet").html(null).append('<option value=""></option>');
        }
    </script>
@endsection