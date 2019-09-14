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

                    <form action="/prevision" method="GET" id="form_semana_act">
                        <div class="row">
                            <div class="col-md-3 mb-3">
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
                            <div class="col-md-3 form-group mb-3">
                                <label>Fecha</label>
                                <input type="date" name="fecha_act" id="fecha_act" class="form-control"
                                       value="{{ $fecha_act }}">
                            </div>
                        </div>
                    </form>
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
@endsection