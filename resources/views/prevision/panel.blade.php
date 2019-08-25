@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Previsión</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Panel de Control</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">Semanas y Fincas</div>

                    <div class="row">
                        <div class="col-md-3 form-group mb-3">
                            <label>Semana</label>
                            <select class="form-control">
                                @for($i = $semana_ini; $i <= $semana_fin; $i++)
                                    <option {{ ($i == $semana_act) ? 'selected' : '' }} value="{{ $i }}">
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                            <label>Fincas</label>

                            <ul class="nav nav-pills" id="myPillTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-icon-pill" data-toggle="pill"
                                       href="#finca_all_pill"
                                       role="tab" aria-controls="finca_all_pill" aria-selected="true">- Todas -</a>
                                </li>
                                @foreach ($fincas as $finca)
                                    <li class="nav-item">
                                        <a class="nav-link" id="home-icon-pill" data-toggle="pill"
                                           href="#finca_{{ $finca->id }}_pill" role="tab"
                                           aria-controls="finca_{{ $finca->id }}_pill"
                                           aria-selected="false">{{ $finca->finca }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content" id="myPillTabContent">
                                <div class="tab-pane fade show active" id="finca_all_pill" role="tabpanel"
                                     aria-labelledby="finca_all_pill">

                                    @foreach ($fincas as $finca)
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="card-title">{{ $finca->finca }} <small>Semana xx</small>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3 text-right">
                                                <button class="btn btn-outline-primary" type="button">Agregar</button>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Dia</th>
                                                            <th scope="col">Parcela</th>
                                                            <th scope="col">Familia</th>
                                                            <th scope="col">Kg.</th>
                                                            <th scope="col">Estado</th>
                                                            <th scope="col">Acciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($semana_dia as $dia)
                                                            <tr>
                                                                <th scope="row">{{ $dia }}</th>
                                                                <td>Smith Doe</td>
                                                                <td>

                                                                    <img class="rounded-circle m-0 avatar-sm-table "
                                                                         src="/assets/images/faces/1.jpg" alt="">

                                                                </td>

                                                                <td>Smith@gmail.com</td>
                                                                <td><span class="badge badge-success">Active</span></td>
                                                                <td>
                                                                    <a href="#" class="text-success mr-2">
                                                                        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                                    </a>
                                                                    <a href="#" class="text-danger mr-2">
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

                                        <hr>
                                    @endforeach

                                </div>

                                @foreach($fincas as $finca)
                                    <div class="tab-pane fade" id="finca_{{ $finca->id }}_pill" role="tabpanel"
                                         aria-labelledby="finca_{{ $finca->id }}_pill">

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="card-title">{{ $finca->finca }} <small>Semana xx</small>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3 text-right">
                                                <button class="btn btn-outline-primary" type="button">Agregar</button>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Familia / Producto</th>
                                                            <th scope="col">Total Días</th>
                                                            <th scope="col">Total Semanas</th>
                                                            <th scope="col">Porcentaje</th>
                                                            <th scope="col">Comentarios</th>
                                                            <th scope="col">Acciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($cultivos as $cultivo)
                                                            <tr>
                                                                <td>{{ $cultivo->cultivo }}</td>
                                                                <td>
                                                                    <table class="table table-sm table-bordered">
                                                                        <thead class="thead-dark">
                                                                        <tr class="bg-primary">
                                                                            @foreach($semana_dia as $dia_d)
                                                                                <th scope="col">{{ $dia_d }}</th>
                                                                            @endforeach
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            @foreach($semana_dia as $dia_d)
                                                                                <td>0</td>
                                                                            @endforeach
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td>0.00</td>
                                                                <td>0 %</td>
                                                                <td>

                                                                </td>
                                                                <td>
                                                                    <a href="#" class="text-success mr-2">
                                                                        <i class="nav-icon i-Data-Save font-weight-bold"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Dia</th>
                                                            <th scope="col">Parcela</th>
                                                            <th scope="col">Familia</th>
                                                            <th scope="col">Kg.</th>
                                                            <th scope="col">Estado</th>
                                                            <th scope="col">Acciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($semana_dia as $dia)
                                                            <tr>
                                                                <th scope="row">{{ $dia }}</th>
                                                                <td>Smith Doe</td>
                                                                <td>

                                                                    <img class="rounded-circle m-0 avatar-sm-table "
                                                                         src="/assets/images/faces/1.jpg" alt="">

                                                                </td>

                                                                <td>Smith@gmail.com</td>
                                                                <td><span class="badge badge-success">Active</span></td>
                                                                <td>
                                                                    <a href="#" class="text-success mr-2">
                                                                        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                                    </a>
                                                                    <a href="#" class="text-danger mr-2">
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
@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>

    {{--Proveedores--}}
    <script>
        $(function () {


            $("#btnNuevo").click(function (e) {
                limpiarCamposProveedor();
                $("#modal-proveedor-title").html("Nuevo Proveedor");
                $("#modal-proveedor").modal('show');
            })
        });

        function limpiarCamposProveedor() {
            $('#cif, #razon_social').val(null);
        }
    </script>
@endsection