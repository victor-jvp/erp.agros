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

                <!-- Modal Pedido-->
                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                    aria-hidden="true" id="modal-pedido">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form action="/comercial/pedidos-comercial" method="POST" id="pedido_form">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" id="pedido_method" value="">
                                <input type="hidden" name="id" id="pedido_id">

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
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="cliente">Cliente</label>
                                            <select class="form-control chosen" id="cliente" name="producto">
                                                @foreach ($clientes as $cliente)
                                                <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="nro_lote_pedido">Destino Comercial</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <a href="javascript:void(0);" class="input-group-text"
                                                        id="zona_info"><i class="i-Information"></i></a>
                                                </div>
                                                <input type="text" name="destino_comercial" id="destino_comercial"
                                                    class="form-control" value="" aria-label="Username"
                                                    aria-describedby="zona_info">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="producto">Producto</label>
                                            <select class="form-control chosen" id="producto" name="producto">
                                                @foreach ($cultivos as $cultivo)
                                                <option value="{{ $cultivo->id }}">{{ $cultivo->cultivo }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label class="checkbox checkbox-success">
                                                <input type="checkbox" name="dia[]" value="1" class="dias">
                                                <span>Miércoles</span>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="checkbox checkbox-success">
                                                <input type="checkbox" name="dia[]" value="2" class="dias">
                                                <span>Jueves</span>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="checkbox checkbox-success">
                                                <input type="checkbox" name="dia[]" value="3" class="dias">
                                                <span>Viernes</span>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="checkbox checkbox-success">
                                                <input type="checkbox" name="dia[]" value="4" class="dias">
                                                <span>Sábado</span>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label class="checkbox checkbox-success">
                                                <input type="checkbox" name="dia[]" value="5" class="dias">
                                                <span>Domingo</span>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="checkbox checkbox-success">
                                                <input type="checkbox" name="dia[]" value="6" class="dias">
                                                <span>Lunes</span>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="checkbox checkbox-success">
                                                <input type="checkbox" name="dia[]" value="7" class="dias">
                                                <span>Martes</span>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="formato">Formato</label>
                                            <div class="input-group mb-3">                                                
                                                <div class="input-group-prepend">
                                                    <a href="javascript:void(0);" class="input-group-text"
                                                        id="btnOpenFormatoModal"><i class="i-Information"></i></a>
                                                </div>
                                                <input type="text" class="form-control" name="formato" id="formato">
                                            </div>                                            
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="etiqueta">Etiqueta</label>
                                            <input type="text" class="form-control" name="etiqueta" id="etiqueta">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="transporte">Transporte</label>
                                            <input type="text" name="transporte" id="transporte" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="precio">Precio Kg</label>
                                            <input type="text" name="precio" id="precio" class="form-control">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="kilos">Kilos</label>
                                            <input type="number" class="form-control" name="kilos" id="kilos"
                                                step="0.01" min="0.00" placeholder="0.00">
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

                                    <div class="row estado">
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
                            </form>
                        </div>
                    </div>
                </div>
                {{-- Fin modal Pedido --}}

                {{-- Modal Producto compuesto --}}
                <div class="modal fade" id="modal-producto" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-producto-title">Seleccionar Producto Compuesto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="col-md-12 mb-3">
                                    <label for="producto">Producto</label>
                                    <select class="form-control chosen" id="producto" name="producto">
                                        @foreach ($productos as $producto)
                                        <option value="{{ $producto->id }}">{{ $producto->compuesto }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="producto_compuesto">Compuesto</label>
                                    <select class="form-control chosen" id="producto_compuesto" name="producto_compuesto">
                                        <option value=""></option>
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary ml-2">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Fin Modal Producto Compuesto --}}

                <form action="/comercial/pedidos-comercial" method="GET" id="form_fecha_act">
                    <div class="row">
                        <div class="col-md-3 form-group mb-3">
                            <label>Semana</label>
                            <input type="text" readonly value="{{ $semana_act }}" class="form-control">
                        </div>
                        <div class="col-md-3 form-group mb-3">
                            <label>Fecha</label>
                            <input type="date" name="fecha_act" id="fecha_act" class="form-control"
                                value="{{ $fecha_act }}">
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
                                <div class="table-responsive">
                                    <table class="table table_pedidos">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th scope="col">Nº Orden</th>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Cliente</th>
                                                <th scope="col">Destino</th>
                                                <th>Formato</th>
                                                <th>Etiqueta</th>
                                                <th>Transporte</th>
                                                <th>Precio €/Kg</th>
                                                <th>Observación</th>
                                                <th>Estado</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
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
        $("#fecha_act").change(function () {
            $("#form_fecha_act").submit();
        });
    })
</script>

<script>
    $(document).ready(function () {
        // Configuracion de Datatable
        $('.table_pedidos').DataTable({
            language: {
                url: "{{ asset('assets/Spanish.json')}}"
            },
            columnDefs: [{
                targets: [0],
                visible: false
            }, ],
            responsive: true
        });

        $('#clientes_table .delete').on('click', function () {
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
            //limpiarCamposProveedor();
            $("#modal-pedido-title").html("Nuevo Pedido");
            $("#modal-pedido").modal('show');
        })

        $("#btnOpenFormatoModal").click(function (e) {
            $("#modal-producto").modal('show');
        })
    });

    function limpiarCamposProveedor() {
        $('#cif, #razon_social').val(null);
    }
</script>
@endsection