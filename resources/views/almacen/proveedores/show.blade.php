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
                        <a class="nav-link" id="datos-fiscales-tab" data-toggle="tab" href="#datos-fiscales" role="tab"
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
                        <a class="nav-link" id="documentacion-tab" data-toggle="tab" href="#documentacion" role="tab"
                            aria-controls="pallets" aria-selected="false">Documentación</a>
                    </li>
                </ul>


                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="datos-fiscales" role="tabpanel" aria-labelledby="datos-fiscales-tab">
                        <form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST" id="finca_form">
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
                                        value="{{ $proveedor->razon_social }}" placeholder="Razón Social" required=""
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
                                        value="{{ $proveedor->localidad }}" placeholder="Localidad" name="localidad">
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
                                        value="{{ $proveedor->direccion }}" placeholder="Direccion" name="direccion">
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono"
                                        value="{{ $proveedor->telefono }}" placeholder="Teléfono" name="telefono">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" value="{{ $proveedor->email }}"
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

<script>
    $(document).ready(function () {
        var tab = '{{ $tab }}';
        $("#" + tab + "").addClass('active show');
        $("#" + tab + "-tab").addClass('active show').attr('aria-selected', true);
    });
</script>
@endsection