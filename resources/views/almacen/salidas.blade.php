@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Almacen</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Salida de Productos</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Salida de Productos</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}
                    <div class="row">
                        <div class="col-md-3">
                            <button class="btn btn-primary" type="button" id="btnNuevo">Nuevo</button>
                        </div>
                    </div>

                    <!-- Modal Salidas-->
                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                         aria-hidden="true" id="modal-salidas">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <form action="/almacen/salida-productos" method="POST" id="salida_form">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" id="salida_method" value="PUT">
                                    <input type="hidden" name="id" id="salida_id">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-salidas-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="nro_salida">Nro. Salida</label>
                                                <input type="text" class="form-control" id="nro_salida"
                                                       value="{{ $nro_salida }}" placeholder="Nro. Salida" readonly
                                                       name="nro_salida">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="fecha">Fecha Salida</label>
                                                <input type="date" class="form-control" id="fecha"
                                                       value="{{ date('Y-m-d') }}" placeholder="Fecha Salida"
                                                       required=""
                                                       name="fecha">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="cantidad">Cantidad</label>
                                                <input type="number" class="form-control" id="cantidad" step="0.01"
                                                       placeholder="Cantidad" required="" name="cantidad">
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label for="categoria">Categoria</label>
                                                <select class="form-control chosen" name="categoria" id="categoria"
                                                        data-placeholder="Seleccione...">
                                                    <option value=""></option>
                                                    <option value="Caja">Cajas</option>
                                                    <option value="Palet">Palets</option>
                                                    <option value="Cubre">Cubres</option>
                                                    <option value="Auxiliar">Auxiliares</option>
                                                    <option value="Tarrina">Tarrinas</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="material">Material</label>
                                                <select class="form-control chosen" name="material" id="material"
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

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <table id="salidas_table" class="display table table-striped table-bordered"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th scope="col">N° Salida</th>
                                    <th scope="col">Fecha Salida</th>
                                    <th scope="col">Categoria</th>
                                    <th>categoria_id</th>
                                    <th scope="col">Material</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Accion</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (isset($salidas))
                                    @foreach ($salidas as $salida)
                                        <tr>
                                            <td>{{ $salida->id }}</td>
                                            <td>{{ $salida->nro_lote }}</td>
                                            <td>{{ date('d/m/Y', strtotime($salida->fecha)) }}</td>
                                            <td>{{ $salida->categoria }}</td>
                                            <td>{{ $salida->categoria_id }}</td>
                                            <td>{{ $salida->material }}</td>
                                            <td>{{ $salida->cantidad }}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="text-success mr-2 edit">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold "></i>
                                                </a>
                                                <a href="javascript:void(0);" class="text-danger mr-2 delete">
                                                    <i class="nav-icon i-Close-Window font-weight-bold "></i>
                                                </a>
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

    {{--Entradas--}}
    <script>
        var salidas_table

        $(function () {
            // Configuracion de Datatable
            salidas_table = $('#salidas_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [
                    {targets: [0, 4], visible: false}
                ],
                order: [[1, 'desc']],
                responsive: true
            });

            $('#salidas_table').on('click', '.edit',function () {
                var current_row = $(this).parents('tr');
                if (current_row.hasClass('child')) {
                    current_row = current_row.prev();
                }
                var row = salidas_table.row(current_row).data();
                LimpiarCamposSalidas();

                $('#salida_id').val(row[0]);
                $('#nro_salida').val(row[1]);
                $("#fecha").val(moment(row[2], 'DD/MM/YYYY').format("YYYY-MM-DD"));
                $("#categoria").val(row[3]).trigger("chosen:updated");
                loadMaterial(row[3], row[4]);
                $("#cantidad").val(row[6]);
                $('#salida_form').attr('action', '/almacen/salida-productos/' + row[0]);

                $("#modal-salidas-title").html("Modificar Salida");
                $("#salida_method").val('PUT');
                $("#modal-salidas").modal('show');
            });

            $('#salidas_table').on('click', '.delete',function () {
                var current_row = $(this).parents('tr');
                if (current_row.hasClass('child')) {
                    current_row = current_row.prev();
                }
                var row = salidas_table.row(current_row).data();

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
                    window.location.href = "{{ url('almacen/salida-productos/delete') }}" + "/" + row[0]
                })
            });

            $("#btnNuevo").click(function (e) {
                LimpiarCamposSalidas();
                $("#modal-salidas-title").html("Nueva Salida");
                $("#salida_method").val(null);
                $("#modal-salidas").modal('show');
            })
        });

        function LimpiarCamposSalidas() {
            $('#categoria, #material, #cantidad').val(null);
            $("#categoria, #material").trigger("chosen:updated");
        }
    </script>

    <script>
        $(document).ready(function () {
            $(".chosen").chosen({
                width: "100%",
                no_results_text: "No se encontraron resultados... ",
                allow_single_deselect: true
            });
        })
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#categoria').on('change', function (evt, params) {
                var value = $(this).val();
                loadMaterial(value);
            });
        });

        function loadMaterial(valor, selected) {
            $.ajax({
                type: 'POST',
                url: "{{ route('salida-productos.selectMaterial') }}",
                dataType: 'JSON',
                data: {
                    "categoria": valor
                },
                success: function (data) {
                    ClearMaterial();
                    if (data == null) return;

                    for (i = 0; i < data.length; i++) {
                        var value = data[i].id;
                        if(data[i].modelo != null && data[i].modelo != undefined && data[i].modelo != ""){
                            var text = data[i].formato+ " | " + data[i].modelo;
                        }else{
                            var text = data[i].formato;
                        }

                        var option = "<option value='" + value + "'>" + text + "</option>";
                        $("#material").append(option);
                    }

                    if (selected != null) {
                        $("#material").val(selected).trigger('chosen:updated');
                    } else {
                        $("#material").trigger('chosen:updated');
                    }
                },
                error: function (error) {
                    console.log(error)
                    alert('Error. Check Console Log');
                },
            });
        }

        function ClearMaterial() {
            $("#material").html(null).append('<option value=""></option>');
        }
    </script>
@endsection