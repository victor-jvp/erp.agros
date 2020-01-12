@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Configuración</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Nuevo Rol</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Datos del Rol</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}

                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="rol">Rol</label>
                                <input type="text" class="form-control" id="rol" required name="rol">
                            </div>
                            <div class="col-md-8 mb-3">
                                <label for="descripcion">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" required name="descripcion">
                            </div>
                        </div>

                        <hr>
                        <h4 class="card-title mb-3">Permisos del Rol</h4>

                        <div class="row">
                            <div class="col-md-12 table-responsive">

                                <table id="table_roles" class="display table table-striped table-bordered"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th scope="col">Leer</th>
                                        <th scope="col">Escribir</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($permisos))
                                        @foreach ($permisos as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->rol }}</td>
                                                <td>{{ $item->descripcion }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>

                    </form>
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

    <script !src="">
        var table_roles;

        $(function () {
            // Configuracion de Datatable
            table_roles = $('#table_roles').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0], visible: false},
                ],
                order: [[0, 'desc']]
            });

            $("#btnNuevo").click(function (e) {
                limpiarCamposProveedor();
                $("#modal-cliente-title").html("Nuevo Cliente");
                $("#modal-cliente").modal('show');
            })
        });
    </script>
@endsection
