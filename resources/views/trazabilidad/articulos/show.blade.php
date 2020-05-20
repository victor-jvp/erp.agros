@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Trazabilidad</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Artículos</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Artículo: <b>{{ $articulo->razon_social }}</b></h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="datos-fiscales-tab" data-toggle="tab"
                               href="#datos-fiscales"
                               role="tab" aria-controls="datos-fiscales" aria-selected="false">Datos del artículo</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="datos-fiscales" role="tabpanel"
                             aria-labelledby="datos-fiscales-tab">
                            <form action="{{ route('tz.articulos.update', $articulo->id) }}" method="POST"
                                  id="datos_comerciales_form">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="id" id="id" value="{{ $articulo->id }}">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="razon_social">Artículo</label>
                                        <input type="text" class="form-control" id="articulo"
                                               value="{{ $articulo->articulo }}" placeholder="Artículo"
                                               name="articulo">
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
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/bootstrap-select.min.css')}}">

@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/chosen.jquery.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-select/i18n/defaults-es_ES.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/calendar/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('assets/js/tooltip.script.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection
