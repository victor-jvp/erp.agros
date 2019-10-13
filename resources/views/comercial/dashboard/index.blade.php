@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Comercial</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Dashboard</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Dashboard</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}

                    <hr>

                    <div class="row">
                        <div class="col-md-3 form-group mb-3">
                            <label>Año</label>
                            <select class="form-control" name="anio_act" id="anio_act">
                                @for($i = $anio_fin; $i >= $anio_ini; $i--)
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
                                @for($i = $semana_fin; $i >= $semana_ini; $i--)
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
                                {{--@foreach ($cultivos as $c => $cultivo)
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
                                                        <th>Semana</th>
                                                        <th>Dia</th>
                                                        <th>Cliente</th>
                                                        <th>Destino</th>
                                                        <th>Formato</th>
                                                        <th>Transporte</th>
                                                        <th>Precio €/Kg</th>
                                                        <th>Total Kilos</th>
                                                        <th>Total Pedido</th>
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
                                                            <td>{{ $pedido->semana }}</td>
                                                            <td>{{ $pedido->dia->dia }}</td>
                                                            <td>{{ (!is_null($pedido->cliente)) ? $pedido->cliente->razon_social : "" }}</td>
                                                            <td>{{ (!is_null($pedido->destino)) ? $pedido->destino->descripcion : "" }}</td>
                                                            <td>{{ (!is_null($pedido->formato)) ? $pedido->formato->formato : "" }}</td>
                                                            <td>{{ (!is_null($pedido->transporte)) ? $pedido->transporte->razon_social : "" }}</td>
                                                            <td>{{ number_format($pedido->precio, 2,",",".") }}</td>
                                                            <td>{{ number_format($pedido->kilos, 2,",",".") }}</td>
                                                            <td>{{ number_format($pedido->precio * $pedido->kilos, 2,",",".") }}</td>
                                                            <td>{{ $pedido->comentarios }}</td>
                                                            <td>{{ $pedido->estado->estado }}</td>
                                                            <td>
                                                                <a href="javascript:void(0);"
                                                                   class="text-success mr-2 edit" data-toggle="tooltip"
                                                                   data-placement="top" title=""
                                                                   data-original-title="Editar">
                                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="text-danger mr-2 delete" data-toggle="tooltip"
                                                                   data-placement="top" title=""
                                                                   data-original-title="Borrar">
                                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach--}}
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
                }, ]
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