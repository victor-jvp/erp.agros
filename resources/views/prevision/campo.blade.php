@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Previsión</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Pedidos de Campo</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">Semanas y Fincas</div>

                    <!-- Modal Pedido-->
                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                         aria-hidden="true" id="modal-pedido">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="/pedidos-campo" method="POST" id="pedido_form">
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
                                                <label for="finca">Finca</label>
                                                <input type="hidden" id="finca_id" name="finca_id">
                                                <select class="form-control" id="finca" disabled>
                                                    @foreach ($fincas as $finca)
                                                        <option value="{{ $finca->id }}">{{ $finca->finca }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="nro_lote_pedido">Nro. Lote Pedido</label>
                                                <input type="text" readonly name="nro_lote_pedido" id="nro_lote_pedido"
                                                       class="form-control">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="encargado">Encargado</label>
                                                <input type="text" name="encargado" id="encargado" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="parcela">Parcela</label>
                                                <select class="form-control chosen" name="parcela" id="parcela" required
                                                        data-placeholder="Seleccione...">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="formato">Formato</label>
                                                <input type="text" class="form-control" name="formato" id="formato">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="caja">Caja</label>
                                                <input type="text" name="caja" id="caja" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="cantidad">Kilos</label>
                                                <input type="number" class="form-control" name="cantidad" id="cantidad"
                                                       required step="0.01" value="0.00">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="cliente">Cliente</label>
                                                <select class="form-control chosen" name="cliente" id="cliente" required
                                                        data-placeholder="Seleccione...">
                                                    <option value=""></option>
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

                    <form action="/pedidos-campo" method="GET" id="form_fecha_act">
                        <div class="row">

                            <div class="col-md-3 form-group mb-3">
                                <label>Fecha</label>
                                <input type="date" name="fecha_act" id="fecha_act" class="form-control"
                                       value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                            <label>Fincas</label>

                            <ul class="nav nav-pills" id="myPillTab" role="tablist">
                                @if(count($fincas) > 0)
                                    @foreach ($fincas as $f => $finca)
                                        @php($active = ($f == 0) ? 'active show' : '')
                                        @php($selected = ($f == 0) ? 'true' : 'false')
                                        <li class="nav-item">
                                            <a class="nav-link {{ $active }}" id="home-icon-pill" data-toggle="pill"
                                               href="#finca_{{ $finca->id }}_pill" role="tab"
                                               aria-controls="finca_{{ $finca->id }}_pill"
                                               aria-selected="{{ $selected }}">{{ $finca->finca }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                            <div class="tab-content" id="myPillTabContent">
                                @if(count($fincas) > 0)
                                    @foreach($fincas as $f => $finca)
                                        @php($active = ($f == 0) ? 'active show' : '')
                                        <div class="tab-pane fade {{ $active }}" id="finca_{{ $finca->id }}_pill"
                                             role="tabpanel"
                                             aria-labelledby="finca_{{ $finca->id }}_pill">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card-title">{{ $finca->finca }}</div>
                                                </div>

                                                <div class="col-md-6 text-right">
                                                    <button data-finca="{{ $finca->id }}"
                                                            class="btnOpenModalPedido btn btn-outline-primary"
                                                            type="button">Agregar
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <ul class="list-group">
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            Total Pedidos
                                                            <span class="badge badge-primary badge-pill">4</span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            Total Kilos
                                                            <span class="badge badge-success badge-pill">1</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4 mb-3">

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col" width="120" class="text-center">Nº
                                                                    Lote<br>Pedido Campo
                                                                </th>
                                                                <th scope="col">Encargado</th>
                                                                <th scope="col">Parcela</th>
                                                                <th scope="col">Formato</th>
                                                                <th scope="col">Cajas</th>
                                                                <th scope="col">Kilos</th>
                                                                <th scope="col">Cliente</th>
                                                                <th scope="col">Comentario</th>
                                                                <th scope="col">Acción</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
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
            $(".btnOpenModalPedido").click(function (e) {
                //LimpiarCamposPrevision();
                // var finca_id = $(this).attr("data-finca");
                // if (finca_id != null) {
                //     $("#finca").val(finca_id);
                //     $("#finca_id").val(finca_id);
                //     $("#anio").val($("#anio_act").val())
                //     $("#semana").val($("#semana_act").val())
                //     LoadParcelaByFinca(finca_id);
                // }

                $("#modal-pedido-title").html("Nuevo Pedido");
                $("#pedido_id").val(null);
                $("#modal-pedido").modal('show');
            });
        });
    </script>
@endsection