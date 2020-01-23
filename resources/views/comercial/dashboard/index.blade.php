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

                    <form action="/comercial/dashboard" method="GET" id="form_fecha_act">

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
                        </div>

                    </form>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Cultivos</label>

                            <ul class="nav nav-pills" id="myPillTab" role="tablist">
                                @foreach ($cultivos as $c => $cultivo)
                                    <li class="nav-item">
                                        <a class="nav-link {{ ($c==0) ? 'active show' : '' }} btn_cultivos"
                                           id="home-icon-pill"
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
                                        <div class="row mb-3">
                                            <div class="col-md-8 mb-3">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card text-left">
                                                            <div class="card-body">
                                                                <h4 class="card-title mb-3">Resumen de la Semana</h4>
                                                                {{--                                                                <p>Add <code>.table-sm</code> to make tables more compact by--}}
                                                                {{--                                                                    cutting cell padding in half.</p>--}}
                                                                <div class="table-responsive">
                                                                    <table
                                                                        class="table table-sm table-bordered table_resumen"
                                                                        width="100%">
                                                                        <thead>
                                                                        <tr class="text-center">
                                                                            <th width="20%" scope="col"></th>
                                                                            <th width="10%" scope="col">X</th>
                                                                            <th width="10%" scope="col">J</th>
                                                                            <th width="10%" scope="col">V</th>
                                                                            <th width="10%" scope="col">S</th>
                                                                            <th width="10%" scope="col">D</th>
                                                                            <th width="10%" scope="col">L</th>
                                                                            <th width="10%" scope="col">M</th>
                                                                            <th width="10%" scope="col">TOTAL</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr class="text-right">
                                                                            <th class="text-right" scope="row">
                                                                                KG/Prevision
                                                                            </th>
                                                                            <td>{{ $cultivo->resumen['prev_dia'][0] }}</td>
                                                                            <td>{{ $cultivo->resumen['prev_dia'][1] }}</td>
                                                                            <td>{{ $cultivo->resumen['prev_dia'][2] }}</td>
                                                                            <td>{{ $cultivo->resumen['prev_dia'][3] }}</td>
                                                                            <td>{{ $cultivo->resumen['prev_dia'][4] }}</td>
                                                                            <td>{{ $cultivo->resumen['prev_dia'][5] }}</td>
                                                                            <td>{{ $cultivo->resumen['prev_dia'][6] }}</td>
                                                                            <th>{{ $cultivo->resumen['total_prev'] }}</th>
                                                                        </tr>
                                                                        <tr class="text-right">
                                                                            <th class="text-right" scope="row">
                                                                                KG/Venta
                                                                            </th>
                                                                            <td>{{ $cultivo->resumen['pedc_dia'][0] }}</td>
                                                                            <td>{{ $cultivo->resumen['pedc_dia'][1] }}</td>
                                                                            <td>{{ $cultivo->resumen['pedc_dia'][2] }}</td>
                                                                            <td>{{ $cultivo->resumen['pedc_dia'][3] }}</td>
                                                                            <td>{{ $cultivo->resumen['pedc_dia'][4] }}</td>
                                                                            <td>{{ $cultivo->resumen['pedc_dia'][5] }}</td>
                                                                            <td>{{ $cultivo->resumen['pedc_dia'][6] }}</td>
                                                                            <th>{{ $cultivo->resumen['total_pedc'] }}</th>
                                                                        </tr>
                                                                        <tr class="text-right">
                                                                            <th class="text-right">TOTAL</th>
                                                                            <th>{{ $cultivo->resumen['total_dia'][0] }}</th>
                                                                            <th>{{ $cultivo->resumen['total_dia'][1] }}</th>
                                                                            <th>{{ $cultivo->resumen['total_dia'][2] }}</th>
                                                                            <th>{{ $cultivo->resumen['total_dia'][3] }}</th>
                                                                            <th>{{ $cultivo->resumen['total_dia'][4] }}</th>
                                                                            <th>{{ $cultivo->resumen['total_dia'][5] }}</th>
                                                                            <th>{{ $cultivo->resumen['total_dia'][6] }}</th>
                                                                            <th>{{ $cultivo->resumen['total'] }}</th>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card text-left">
                                                            <div class="card-body">
                                                                <h4 class="card-title mb-3">Panel Venta</h4>
                                                                <div class="echarts" id="chart_{{ $cultivo->id }}"
                                                                     data-prev="{{ $cultivo->resumen['chart_prevision'] }}"
                                                                     data-venta="{{ $cultivo->resumen['chart_venta'] }}"
                                                                     style="height: 200px;"></div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6 mb-3">

                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="card mb-3">
                                                            <div class="card-body p-0">
                                                                <div
                                                                    class="card-title border-bottom d-flex align-items-center m-0 p-3">
                                                                    <span>{{ $cultivo->cultivo }}</span>
                                                                    <span class="flex-grow-1"></span>
                                                                    <span
                                                                        class="badge badge-pill badge-primary">Semanal</span>
                                                                </div>

                                                                <div
                                                                    class="d-flex border-bottom justify-content-between p-3">
                                                                    <div class="flex-grow-1">
                                                                        <span class="text-small text-muted">Kg</span>
                                                                        <h5 class="m-0">{{ $cultivo->resumen['promSemanaKg'] }}</h5>
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <span
                                                                            class="text-small text-muted">Precio</span>
                                                                        <h5 class="m-0">{{ $cultivo->resumen['promSemanaPrecio'] }}
                                                                            €</h5>
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <span class="text-small text-muted">€/Kg</span>
                                                                        <h5 class="m-0">{{ $cultivo->resumen['promSemanaAmbos'] }}</h5>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="card-title border-bottom d-flex align-items-center m-0 p-3">
                                                                    <span>{{ $cultivo->cultivo }}</span>
                                                                    <span class="flex-grow-1"></span>
                                                                    <span
                                                                        class="badge badge-pill badge-primary">Anual</span>
                                                                </div>
                                                                <div
                                                                    class="d-flex border-bottom justify-content-between p-3">
                                                                    <div class="flex-grow-1">
                                                                        <span class="text-small text-muted">Kg</span>
                                                                        <h5 class="m-0">{{ $cultivo->resumen['promAnualKg'] }}</h5>
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <span
                                                                            class="text-small text-muted">Precio</span>
                                                                        <h5 class="m-0">{{ $cultivo->resumen['promAnualPrecio'] }}
                                                                            €</h5>
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <span class="text-small text-muted">€/Kg</span>
                                                                        <h5 class="m-0">{{ $cultivo->resumen['promAnualAmbos'] }}</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="card text-left">
                                                            <div class="card-body">
                                                                {{--                                                                <h4 class="card-title mb-3">Light Small Table</h4>--}}
                                                                {{--                                                                <p>Add <code>.table-sm</code> to make tables more compact by--}}
                                                                {{--                                                                    cutting cell padding in half.</p>--}}
                                                                <div class="row">
                                                                    <div class="col-md-6 form-group mb-3">
                                                                        <label>Cliente</label>
                                                                        <select class="form-control chosen cliente_a">
                                                                            <option value=""></option>
                                                                            @foreach($clientes as $cliente)
                                                                                <option
                                                                                    value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3 form-group mb-3">
                                                                        <label>Desde</label>
                                                                        <input type="date"
                                                                               class="form-control cliente_a_desde"
                                                                               placeholder="dd/mm/aaaa">
                                                                    </div>
                                                                    <div class="col-md-3 form-group mb-3">
                                                                        <label>Hasta</label>
                                                                        <input type="date"
                                                                               class="form-control cliente_a_hasta"
                                                                               placeholder="dd/mm/aaaa">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="table-responsive">
                                                                            <table
                                                                                class="table table-sm table-bordered table_cliente_kilos_a"
                                                                                width="100%">
                                                                                <thead class="text-center">
                                                                                <tr>
                                                                                    <th scope="col" colspan="2">Kg
                                                                                        Venta
                                                                                    </th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="col">Totales</th>
                                                                                    <th scope="col">€</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody></tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="table-responsive">
                                                                            <table
                                                                                class="table table-sm table-bordered table_cliente_ventas_a"
                                                                                width="100%">
                                                                                <thead class="text-center">
                                                                                <tr>
                                                                                    <th scope="col" colspan="2">Formato
                                                                                        Ventas
                                                                                    </th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="col">Formato</th>
                                                                                    <th scope="col">€</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody></tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="card text-left">
                                                            <div class="card-body">
                                                                {{--                                                                <h4 class="card-title mb-3">Light Small Table</h4>--}}
                                                                {{--                                                                <p>Add <code>.table-sm</code> to make tables more compact by--}}
                                                                {{--                                                                    cutting cell padding in half.</p>--}}
                                                                <div class="row">
                                                                    <div class="col-md-6 form-group mb-3">
                                                                        <label>Cliente</label>
                                                                        <select class="form-control chosen cliente_b">
                                                                            <option value=""></option>
                                                                            @foreach($clientes as $cliente)
                                                                                <option
                                                                                    value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3 form-group mb-3">
                                                                        <label>Desde</label>
                                                                        <input type="date"
                                                                               class="form-control cliente_b_desde"
                                                                               placeholder="dd/mm/aaaa">
                                                                    </div>
                                                                    <div class="col-md-3 form-group mb-3">
                                                                        <label>Hasta</label>
                                                                        <input type="date"
                                                                               class="form-control cliente_b_hasta"
                                                                               placeholder="dd/mm/aaaa">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="table-responsive">
                                                                            <table
                                                                                class="table table-sm table-bordered table_cliente_kilos_b"
                                                                                width="100%">
                                                                                <thead class="text-center">
                                                                                <tr>
                                                                                    <th scope="col" colspan="2">Kg
                                                                                        Venta
                                                                                    </th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="col">Totales</th>
                                                                                    <th scope="col">€</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody></tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="table-responsive">
                                                                            <table
                                                                                class="table table-sm table-bordered table_cliente_ventas_b"
                                                                                width="100%">
                                                                                <thead class="text-center">
                                                                                <tr>
                                                                                    <th scope="col" colspan="2">Formato
                                                                                        Ventas
                                                                                    </th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="col">Formato</th>
                                                                                    <th scope="col">€</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody></tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <div class="row mb-4">
                                                    <div class="col-md-8">
                                                        <div class="card mb-4">
                                                            <div class="card-body">
                                                                <label for="fecha_pedidos">ESTADO DE PEDIDOS EN
                                                                    PRODUCCIÓN</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"
                                                                              id="basic-addon3">Fecha</span>
                                                                    </div>
                                                                    <input type="date" class="form-control"
                                                                           id="fecha_pedidos"
                                                                           aria-describedby="basic-addon3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="card text-left">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-12 table-responsive">
                                                                        <table
                                                                            class="table table-sm table-bordered table_pedidos_produccion"
                                                                            width="100%">
                                                                            <thead class="text-center">
                                                                            <tr>
                                                                                <th scope="col">Nº Orden</th>
                                                                                <th scope="col">Cliente</th>
                                                                                <th scope="col">Formato</th>
                                                                                <th scope="col">Estado</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody class="text-center">
                                                                            <tr>
                                                                                <td scope="row">1000</td>
                                                                                <td>155.00 €</td>
                                                                                <td>10x500 / 1</td>
                                                                                <td>500.00 €</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">1455</td>
                                                                                <td>222.00 €</td>
                                                                                <td>10x500 / 4</td>
                                                                                <td>425.00 €</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">1321</td>
                                                                                <td>111.00 €</td>
                                                                                <td>12x400</td>
                                                                                <td>1000.00 €</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">1000</td>
                                                                                <td>155.00 €</td>
                                                                                <td>10x500 / 1</td>
                                                                                <td>500.00 €</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">1455</td>
                                                                                <td>222.00 €</td>
                                                                                <td>10x500 / 4</td>
                                                                                <td>425.00 €</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row">1321</td>
                                                                                <td>111.00 €</td>
                                                                                <td>12x400</td>
                                                                                <td>1000.00 €</td>
                                                                            </tr>
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

                                        <div class="row mb-3">
                                            <div class="col-md-12 mb-3">
                                                <div class="card text-left">
                                                    <div class="card-body">
                                                        <h4 class="card-title mb-3">Resumen Semanal por Proveedor</h4>
                                                        {{--                                                                <p>Add <code>.table-sm</code> to make tables more compact by--}}
                                                        {{--                                                                    cutting cell padding in half.</p>--}}
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <select class="form-control chosen" id="proveedor"
                                                                        data-cultivo="{{ $cultivo->id }}">
                                                                    <option value=""></option>
                                                                    @foreach($clientes as $cliente)
                                                                        <option
                                                                            value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 mb-3 table-responsive">
                                                                <table
                                                                    class="table table-sm table-bordered table_resumen_semana_cliente"
                                                                    width="100%">
                                                                    <thead>
                                                                    <tr class="text-center">
                                                                        <th></th>
                                                                        @for($i = $semana_ini; $i <= $semana_fin; $i++ )
                                                                            <th>{{ $i }}</th>
                                                                        @endfor
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody></tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12 mb-3">
                                                <div class="card text-left">
                                                    <div class="card-body">
                                                        <h4 class="card-title mb-3">Resumen Semanal</h4>
                                                        {{--                                                                <p>Add <code>.table-sm</code> to make tables more compact by--}}
                                                        {{--                                                                    cutting cell padding in half.</p>--}}
                                                        <div class="row">
                                                            <div class="col-xs-12 table-responsive">
                                                                <table
                                                                    class="table table-sm table-bordered table_resumen_semana"
                                                                    width="100%">
                                                                    <thead>
                                                                    <tr class="text-center">
                                                                        <th></th>
                                                                        @for($i = $semana_ini; $i <= $semana_fin; $i++ )
                                                                            <th>{{ $i }}</th>
                                                                        @endfor
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <th>Kg Vendidos</th>
                                                                        @for($i = $semana_ini; $i <= $semana_fin; $i++ )
                                                                            <td>{{ ($cultivo->resumen['venta'][$i]>0) ? $cultivo->resumen['venta'][$i] : "-" }}</td>
                                                                        @endfor
                                                                    </tr>
                                                                    <tr>
                                                                        <th>€/Kg</th>
                                                                        @for($i = $semana_ini; $i <= $semana_fin; $i++ )
                                                                            <td>{{ ($cultivo->resumen['precio'][$i]>0) ? $cultivo->resumen['precio'][$i] : "-" }}</td>
                                                                        @endfor
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
        <!-- end of col -->
    </div>
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/bootstrap-select.min.css')}}">
@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/calendar/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-select/i18n/defaults-es_ES.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/echarts.min.js')}}"></script>
    <script src="{{asset('assets/js/es5/echart.options.min.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.extend(true, $.fn.dataTable.defaults, {
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });

        $(function () {

            $("#semana_act, #anio_act").change(function () {
                $("#form_fecha_act").submit();
            });

            $(".chosen").selectpicker({
                liveSearch: true
            });

            $(".cliente_a").on('changed.bs.select', function (e) {
                var cliente_id = $(this).val();
                var desde = $(this).closest('div.row').find("input.cliente_a_desde").val();
                var hasta = $(this).closest('div.row').find("input.cliente_a_hasta").val();
                if (cliente_id == "" || desde == "" || hasta == "") return;

                cliente = cliente_id;
                fecha_desde = desde;
                fecha_hasta = hasta;

                var table_cliente_kilos = $(this).closest('div.row').next().find('table.table_cliente_kilos_a').DataTable();
                var table_cliente_ventas = $(this).closest('div.row').next().find('table.table_cliente_ventas_a').DataTable();
                table_cliente_kilos.ajax.reload();
                table_cliente_ventas.ajax.reload();
            });

            $(".cliente_a_desde, .cliente_a_hasta").change(function (e) {
                var cliente_id = $(this).closest('div.row').find("select.cliente_a").val();
                var desde = $(this).closest('div.row').find("input.cliente_a_desde").val();
                var hasta = $(this).closest('div.row').find("input.cliente_a_hasta").val();
                if (cliente_id == "" || desde == "" || hasta == "") return;

                cliente = cliente_id;
                fecha_desde = desde;
                fecha_hasta = hasta;

                var table_cliente_kilos = $(this).closest('div.row').next().find('table.table_cliente_kilos_a').DataTable();
                var table_cliente_ventas = $(this).closest('div.row').next().find('table.table_cliente_ventas_a').DataTable();
                table_cliente_kilos.ajax.reload();
                table_cliente_ventas.ajax.reload();
            });

            $(".cliente_b").on('changed.bs.select', function (e) {
                var cliente_id = $(this).val();
                var desde = $(this).closest('div.row').find("input.cliente_b_desde").val();
                var hasta = $(this).closest('div.row').find("input.cliente_b_hasta").val();
                if (cliente_id == "" || desde == "" || hasta == "") return;

                cliente = cliente_id;
                fecha_desde = desde;
                fecha_hasta = hasta;

                var table_cliente_kilos = $(this).closest('div.row').next().find('table.table_cliente_kilos_b').DataTable();
                var table_cliente_ventas = $(this).closest('div.row').next().find('table.table_cliente_ventas_b').DataTable();
                table_cliente_kilos.ajax.reload();
                table_cliente_ventas.ajax.reload();
            });

            $(".cliente_b_desde, .cliente_b_hasta").change(function (e) {
                var cliente_id = $(this).closest('div.row').find("select.cliente_b").val();
                var desde = $(this).closest('div.row').find("input.cliente_b_desde").val();
                var hasta = $(this).closest('div.row').find("input.cliente_b_hasta").val();
                if (cliente_id == "" || desde == "" || hasta == "") return;

                cliente = cliente_id;
                fecha_desde = desde;
                fecha_hasta = hasta;

                var table_cliente_kilos = $(this).closest('div.row').next().find('table.table_cliente_kilos_b').DataTable();
                var table_cliente_ventas = $(this).closest('div.row').next().find('table.table_cliente_ventas_b').DataTable();
                table_cliente_kilos.ajax.reload();
                table_cliente_ventas.ajax.reload();
            });

            $(".btn_cultivos").click(function (e) {
                setTimeout(function () {
                    $('.table_resumen_semana').DataTable()
                        .columns.adjust()
                        .responsive.recalc();
                }, 350);
            });

            $("#proveedor").on('changed.bs.select', function (e) {
                proveedor_id = $(this).val();
                cultivo_id = $(this).data('cultivo');
                anio_act = $("#anio_act").val();
                var table_proveedor = $(this).closest('div.row').next().find('table.table_resumen_semana_cliente').DataTable();
                table_proveedor.ajax.reload();
            });

            $("#fecha_pedidos").change(function (e) {
                fecha_pedidos = $(this).val();
                var table_pedidos_produccion = $(this).closest('div.row').next().find('table.table_pedidos_produccion').DataTable();
                table_pedidos_produccion.ajax.reload();
            });
        })
    </script>

    <script>
        var cliente = null;
        var fecha_desde = null;
        var fecha_hasta = null;
        var proveedor_id = null;
        var cultivo_id = null;
        var anio_act = null;
        var fecha_pedidos = null;

        $(function () {
            // Configuracion de Datatable
            $('.table_resumen').DataTable({
                // language: {url: "{{ asset('assets/Spanish.json')}}"},
                // columnDefs: [{
                //     targets: [0],
                //     visible: false
                // },]
                responsive: true,
                paging: false,
                info: false,
                searching: false,
                ordering: false,
            });

            $('.table_resumen_semana').DataTable({
                // language: {url: "{{ asset('assets/Spanish.json')}}"},
                // columnDefs: [{
                //     targets: [0],
                //     visible: false
                // },]
                responsive: true,
                paging: false,
                info: false,
                searching: false,
                ordering: false,
            });

            $('.table_cliente_kilos_b').DataTable({
                // language: {url: "{{ asset('assets/Spanish.json')}}"},
                ajax: {
                    url: "{{ route('comercial.ajaxClienteResumenKilos') }}",
                    type: "GET",
                    data: function (a) {
                        a.cliente = cliente;
                        a.desde = fecha_desde;
                        a.hasta = fecha_hasta;
                    }
                },
                columns: [
                    {data: 'kilos', className: 'text-right'},
                    {data: 'precio', className: 'text-right'},
                ],
                responsive: true,
                paging: false,
                info: false,
                searching: false,
                ordering: false,
                //lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
            });

            $('.table_cliente_kilos_a').DataTable({
                // language: {url: "{{ asset('assets/Spanish.json')}}"},
                ajax: {
                    url: "{{ route('comercial.ajaxClienteResumenKilos') }}",
                    type: "GET",
                    data: function (a) {
                        a.cliente = cliente;
                        a.desde = fecha_desde;
                        a.hasta = fecha_hasta;
                    }
                },
                columns: [
                    {data: 'kilos', className: 'text-right'},
                    {data: 'precio', className: 'text-right'},
                ],
                responsive: true,
                paging: false,
                info: false,
                searching: false,
                ordering: false,
                //lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
            });

            $('.table_cliente_ventas_a').DataTable({
                // language: {url: "{{ asset('assets/Spanish.json')}}"},
                ajax: {
                    url: "{{ route('comercial.ajaxClienteResumenVentas') }}",
                    type: "GET",
                    data: function (a) {
                        a.cliente = cliente;
                        a.desde = fecha_desde;
                        a.hasta = fecha_hasta;
                    }
                },
                columns: [
                    {data: 'formato', className: 'text-right'},
                    {data: 'precio', className: 'text-right'},
                ],
                responsive: true,
                paging: false,
                info: false,
                searching: false,
                ordering: false,
            });

            $('.table_resumen_semana_cliente').DataTable({
                ajax: {
                    url: "{{ route('comercial.ajaxClienteResumenPorSemana') }}",
                    type: "GET",
                    data: function (a) {
                        a.proveedor_id = proveedor_id;
                        a.cultivo_id = cultivo_id;
                        a.anio_act = anio_act;
                    }
                },
                responsive: true,
                paging: false,
                info: false,
                searching: false,
                ordering: false,
                //lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
            });

            $('.table_cliente_ventas_b').DataTable({
                // language: {url: "{{ asset('assets/Spanish.json')}}"},
                ajax: {
                    url: "{{ route('comercial.ajaxClienteResumenVentas') }}",
                    type: "GET",
                    data: function (a) {
                        a.cliente = cliente;
                        a.desde = fecha_desde;
                        a.hasta = fecha_hasta;
                    }
                },
                columns: [
                    {data: 'formato', className: 'text-right'},
                    {data: 'precio', className: 'text-right'},
                ],
                responsive: true,
                paging: false,
                info: false,
                searching: false,
                ordering: false,
            });

            $('.table_pedidos_produccion').DataTable({
                ajax: {
                    url: "{{ route('comercial.ajaxEstadoPedidosProduccion') }}",
                    type: "GET",
                    data: function (a) {
                        a.fecha = fecha_pedidos;
                    }
                },
                columns: [
                    {data: 'nro_orden', className: 'text-center'},
                    {data: 'cliente'},
                    {data: 'formato', className: 'text-center'},
                    {data: 'estado', className: 'text-center'},
                ],
                responsive: true,
                paging: false,
                info: false,
                searching: false,
                ordering: true,
            });
        });
    </script>

    <script>
        // Chart in Dashboard version 2
        $(document).ready(function () {

            $(".echarts").each(function (elem) {
                var chart = $(this).attr('id');
                var prev = $(this).attr('data-prev');
                var venta = $(this).attr('data-venta');
                var echartElem = document.getElementById(chart);
                if (echartElem) {
                    var echart = echarts.init(echartElem);
                    echart.setOption(_extends({}, echartOptions.defaultOptions, {
                        legend: {
                            show: true,
                            bottom: 0
                        },
                        series: [_extends({
                            type: 'pie'
                        }, echartOptions.pieRing, {

                            label: echartOptions.pieLabelCenterHover,
                            data: [{
                                name: 'Previsión',
                                value: prev,
                                itemStyle: {
                                    color: '#e90e01'
                                }
                            }, {
                                name: 'Venta',
                                value: venta,
                                itemStyle: {
                                    color: '#15c100'
                                }
                            }]
                        })]
                    }));

                    $(window).on('resize', function () {
                        setTimeout(function () {
                            echart.resize();
                        }, 500);
                    });
                }
            });
        });
    </script>

    <script>
        function limpiarCamposTransporte() {
            $('#cif, #razon_social').val(null);
        }
    </script>
@endsection
