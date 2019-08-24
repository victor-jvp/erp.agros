@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Almacen</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Listado de Inventario</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Listado de Inventario</h4>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <table id="salidas_table" class="display table table-striped table-bordered"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Material</th>
                                    <th scope="col">Entradas</th>
                                    <th scope="col">Salidas</th>
                                    <th scope="col">Total</th>
{{--                                    <th scope="col">Accion</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @if (isset($inventario))
                                    @foreach ($inventario as $row)
                                        <tr>
                                            <td><b>{{ $row->categoria }}</b></td>
                                            <td>{{ $row->material }}</td>
                                            <td><span class="badge badge-pill badge-success p-2 m-1">{{ $row->entradas }}</span></td>
                                            <td><span class="badge badge-pill badge-danger p-2 m-1">{{ $row->salidas }}</span></td>
                                            <td><span class="badge badge-pill badge-info p-2 m-1">{{ $row->entradas - $row->salidas }}</span></td>
                                            {{--<td>
                                                <a href="javascript:void(0);" class="text-success mr-2 edit">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold "></i>
                                                </a>
                                                <a href="javascript:void(0);" class="text-danger mr-2 delete">
                                                    <i class="nav-icon i-Close-Window font-weight-bold "></i>
                                                </a>
                                            </td>--}}
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
        <!-- end of col -->
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
    <script src="{{asset('assets/js/vendor/calendar/moment.min.js')}}"></script>

    <script>
        var salidas_table

        $(function () {
            // Configuracion de Datatable
            salidas_table = $('#salidas_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
            });
        });

    </script>
@endsection