@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Trazabilidad</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Entradas</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Entradas</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}

                    <div class="row">
                        @can('Trazabilidad - Entradas | Crear')
                            <div class="col-md-3">
                                <button class="btn btn-primary" type="button" id="btnNuevo">Nuevo</button>
                            </div>
                        @endcan
                    </div>

                    <!-- Modal Agregar Proveedor-->
                    <div class="modal fade" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="modal-entrada">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="/trazabilidad/entradas/create" method="POST" id="entrada_form">
                                    @csrf

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-entrada-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="fecha">Fecha</label>
                                                <input type="date" class="form-control" id="fecha" value="{{ date('Y-m-d') }}"
                                                       placeholder="Fecha" required="" name="fecha">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="albaran">Albarán</label>
                                                <input type="text" class="form-control" id="albaran"
                                                       placeholder="Albarán" required="" name="albaran">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="traza">Traza de Entrada</label>
                                                <input type="text" class="form-control" id="traza"
                                                       placeholder="Traza de Entrada" name="traza">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="proveedor">Proveedor</label>
                                                <select name="proveedor_id" id="proveedor" class="form-control">
                                                    <option value=""></option>
                                                    @foreach ($proveedores as $proveedor)
                                                        <option value="{{ $proveedor->id }}">{{ $proveedor->proveedor }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="articulo">Artículo</label>
                                                <select name="articulo_id" id="articulo" class="form-control">
                                                    <option value=""></option>
                                                    @foreach ($articulos as $articulo)
                                                        <option value="{{ $articulo->id }}">{{ $articulo->articulo }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="cantidad">Cantidad</label>
                                                <input type="number" class="form-control" id="cantidad" name="cantidad"
                                                       placeholder="Cantidad">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="variedad">Variedad</label>
                                                <input type="text" class="form-control" id="variedad"
                                                       placeholder="Variedad" name="variedad">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Cerrar
                                        </button>
                                        @can('Trazabilidad - Entradas | Crear')
                                            <button type="submit" class="btn btn-primary">Continuar</button>
                                        @endcan
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="entradas_table" class="display table table-striped table-bordered"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Albarán</th>
                                        <th scope="col">Traza Entrada</th>
                                        <th scope="col">Proveedor</th>
                                        <th scope="col">Artículo</th>
                                        <th scope="col">Kilos</th>
                                        <th scope="col">Variedad</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($entradas))
                                        @foreach ($entradas as $entrada)
                                            <tr>
                                                <td>{{ $entrada->id }}</td>
                                                <td>{{ date("d/m/Y", strtotime($entrada->fecha)) }}</td>
                                                <td>{{ $entrada->albaran }}</td>
                                                <td>{{ $entrada->entrada }}</td>
                                                <td>{{ (isset($entrada->proveedor)) ? $entrada->proveedor->proveedor : "" }}</td>
                                                <td>{{ (isset($entrada->articulo)) ? $entrada->articulo->articulo : "" }}</td>
                                                <td>{{ $entrada->cantidad }}</td>
                                                <td>{{ $entrada->variedad }}</td>
                                                <td>
                                                    @can('Trazabilidad - Salidas | Crear')
                                                        <a href="javascript:void(0);" class="text-warning mr-2 salida"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="Borrar">
                                                            <i class="nav-icon i-Arrow-Outside font-weight-bold "></i>
                                                        </a>
                                                    @endcan
                                                    @can('Trazabilidad - Entradas | Modificar')
                                                        <a href="{{ route('tz.entradas.show', $entrada->id) }}"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="Editar" class="text-success mr-2 edit">
                                                            <i class="nav-icon i-Pen-2 font-weight-bold "></i>
                                                        </a>
                                                    @endcan
                                                    @can('Trazabilidad - Entradas | Borrar')
                                                        <a href="javascript:void(0);" class="text-danger mr-2 delete"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="Borrar">
                                                            <i class="nav-icon i-Close-Window font-weight-bold "></i>
                                                        </a>
                                                    @endcan
                                                </td>
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
        var table_entradas

        $(function () {
            // Configuracion de Datatable
            table_entradas = $('#entradas_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0], visible: false},
                ],
                responsive: true
            });

            $('#entradas_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_entradas.row(tr).data();

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
                    window.location.href = "{{ url('trazabilidad/entradas/delete') }}" + "/" + row[0]
                })
            });

            $("#btnNuevo").click(function (e) {
                limpiarCamposProveedor();
                $("#modal-entrada-title").html("Nuevo Entrada");
                $("#modal-entrada").modal('show');
            })
        });

        function limpiarCamposProveedor() {
            $('#cif, #razon_social').val(null);
        }
    </script>
@endsection
