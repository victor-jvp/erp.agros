@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Maestros</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Productos Compuestos</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Productos Compuestos</h4>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <button class="btn btn-primary" type="button" id="btnNuevoProducto">Nuevo</button>
                        </div>
                    </div>

                    {{--Modal Producto Compuesto--}}
                    <div class="modal fade" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="modal-producto">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="/maestros/productos-compuestos/create" method="POST" id="producto_form">
                                    {{ csrf_field() }}

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-producto-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="compuesto">Compuesto</label>
                                                <input type="text" class="form-control" id="compuesto"
                                                       placeholder="Compuesto" required="" name="compuesto">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="cultivo">Cultivo</label>
                                                <select class="form-control chosen" id="cultivo" name="cultivo"
                                                        required>
                                                    @foreach ($cultivos as $cultivo)
                                                        <option value="{{ $cultivo->id }}">{{ $cultivo->cultivo }}</option>
                                                    @endforeach
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

                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table id="productos_table" class="display table table-striped"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th>Cultivo_id</th>
                                    <th scope="col">Cultivo</th>
                                    <th scope="col">Producto Compuesto</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Nº de Composiciones</th>
                                    <th scope="col">Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($productos as $producto)
                                    <tr>
                                        <td>{{ $producto->id }}</td>
                                        <td>{{ $producto->cultivo_id }}</td>
                                        <td>{{ isset($producto->cultivo) ? $producto->cultivo->cultivo : '' }}</td>
                                        <td>{{ $producto->compuesto }}</td>
                                        <td>{{ date('d/m/Y', strtotime($producto->fecha))}}</td>
                                        <td>{{ (isset($producto->detalles)) ? count($producto->detalles) : 0}}</td>
                                        <td>
                                            <a href="javascript:void(0);" class="text-success mr-2" data-toggle="tooltip"
                                               data-placement="top" title="" data-original-title="Editar">
                                                <i class="nav-icon i-Pen-2 font-weight-bold edit"></i>
                                            </a>
                                            <a href="{{ url('maestros/productos-compuestos/show/'.$producto->id) }}"
                                               class="text-primary mr-2" data-toggle="tooltip"
                                               data-placement="top" title="" data-original-title="Compuestos">
                                                <i class="nav-icon i-Notepad-2 font-weight-bold"></i>
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

    <script>
        $(document).ready(function () {
            $(".chosen").chosen({
                width: "100%",
                no_results_text: "No se encontraron resultados... ",
                placeholder_text_single: "Seleccione una opción...",
                allow_single_deselect: true
            });
        });
    </script>

    <script>
        var table_productos;

        $(function () {
            var table_productos = $("#productos_table").DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0, 1], visible: false},
                ],
                responsive: true,
                //length:[[50, 100, -1],[50, 100, "Todos"]],
                paging: false,
            });

            $("#btnNuevoProducto").click(function (e) {
                $("#modal-producto-title").html('Agregar Producto');
                $("#producto_form").attr('action', "{{ route('productos-compuestos.create') }}");
                $("#modal-producto").modal("show");
            });


            $('#productos_table').on('click', '.edit', function () {
                var current_row = $(this).parents('tr');
                if (current_row.hasClass('child')) {
                    current_row = current_row.prev();
                }
                var row = table_productos.row(current_row).data();
                LimpiarCamposModal();

                $("#cultivo").val(row[1]).trigger('chosen:updated');
                $("#compuesto").val(row[3]);

                $("#modal-producto-title").html('Modificar Producto');
                $("#producto_form").attr('action', "{{ url('maestros/productos-compuestos/update') }}" + "/" + row[0]);
                $("#modal-producto").modal("show");
            });
        });

        function LimpiarCamposModal() {
            $("#compuesto, #cultivo").val(null);
        }
    </script>
@endsection
