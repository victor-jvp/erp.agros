@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Almacen</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Entrada de Productos</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Entrada de Productos</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}
                    <div class="row">
                        <div class="col-md-3">
                            <button class="btn btn-primary" type="button" id="btnNuevo">Nuevo</button>
                        </div>
                    </div>

                    <!-- Modal entradas-->
                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                         aria-hidden="true" id="modal-entradas">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="/almacen/entrada-productos" method="POST" id="entrada_form">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" id="entrada_method" value="PUT">
                                    <input type="hidden" name="id" id="entrada_id">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-entradas-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="nro_lote">Nro. Lote</label>
                                                <input type="text" class="form-control" id="nro_lote"
                                                       placeholder="Nro. Lote" required="" name="nro_lote">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="fecha">Fecha Entrada</label>
                                                <input type="date" class="form-control" id="fecha"
                                                       value="{{ date('Y-m-d') }}" placeholder="Fecha Entrada"
                                                       required=""
                                                       name="fecha">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="categoria">Categoria</label>
                                                <select class="form-control chosen" name="categoria" id="categoria"
                                                        data-placeholder="Seleccione...">
                                                    <option value=""></option>
                                                    @if (isset($categorias))
                                                        @foreach ($categorias as $categoria)
                                                            <option value="{{ $categoria['value'] }}">{{ $categoria['text'] }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="material">Material</label>
                                                <select class="form-control chosen" name="material" id="material"
                                                        data-placeholder="Seleccione...">
                                                    <option value=""></option>
                                                    @if (isset($cultivos))
                                                        @foreach ($cultivos as $cultivo)
                                                            <option value="{{ $cultivo->id }}">{{ $cultivo->cultivo }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="cantidad">Cantidad</label>
                                                <input type="number" class="form-control" id="cantidad" step="0.01"
                                                       placeholder="Cantidad" required="" name="cantidad">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="nro_albaran">Nro. Albarán</label>
                                                <input type="text" class="form-control" id="nro_albaran"
                                                       placeholder="Nro. Albarán" required="" name="nro_albaran">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="fecha_albaran">Fecha Albarán</label>
                                                <input type="date" class="form-control" id="fecha_albaran"
                                                       value="{{ date('Y-m-d') }}" placeholder="Fecha Albarán"
                                                       required=""
                                                       name="fecha_albaran">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="formato">Proveedor</label>
                                                <select class="form-control chosen" name="formato" id="formato"
                                                        data-placeholder="Seleccione...">
                                                    <option value=""></option>
                                                    @if (isset($cultivos))
                                                        @foreach ($cultivos as $cultivo)
                                                            <option value="{{ $cultivo->id }}">{{ $cultivo->cultivo }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="transporte_adecuado" checked>
                                                    <span>Transporte Adecuado</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="control_plagas" checked>
                                                    <span>Control de Plagas</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="estado_pallets" checked>
                                                    <span>Estado Pallets</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="ficha_tecnica" checked>
                                                    <span>Ficha Técnica</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="material_daniado">
                                                    <span>Material Dañado</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="material_limpio" checked>
                                                    <span>Material Limpio</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="control_grapas" checked>
                                                    <span>Control de Grapas</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="cantidad_conforme" checked>
                                                    <span>Cantidad Conforme</span>
                                                    <span class="checkmark"></span>
                                                </label>
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
                            <table id="entradas_table" class="display table table-striped table-bordered"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th scope="col">N° Lote</th>
                                    <th scope="col">Fecha Entrada</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Material</th>
                                    <th scope="col">Formato</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Nº Albaran</th>
                                    <th scope="col">Fecha Albaran</th>
                                    <th scope="col">Transporte Adecuado</th>
                                    <th scope="col">Control de Plagas</th>
                                    <th scope="col">Estado Pallets</th>
                                    <th scope="col">Ficha Técnica</th>
                                    <th scope="col">Material Dañado</th>
                                    <th scope="col">Material Limpio</th>
                                    <th scope="col">Proveedor</th>
                                    <th scope="col">Accion</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (isset($entradas))
                                    @foreach ($entradas as $entrada)
                                        <tr>
                                            <td>{{ $entrada->id }}</td>
                                            <td>{{ $entrada->nro_lote }}</td>
                                            <td>{{ date('d/m/Y',strtotime($entrada->fecha)) }}</td>
                                            <td>{{ $entrada->pallet->formato }}</td>
                                            <td></td>
                                            <td>{{ $entrada->pallet->modelo->formato }}</td>
                                            <td>{{ $entrada->cantidad }}</td>
                                            <td>{{ $entrada->nro_albaran }}</td>
                                            <td>{{ date('d/m/Y',strtotime($entrada->fecha_albaran)) }}</td>
                                            <td>{{ $entrada->transporte_adecuado }}</td>
                                            <td>{{ $entrada->transporte_control_plagas }}</td>
                                            <td>{{ $entrada->estado_pallet  }}</td>
                                            <td>{{ $entrada->ficha_tenica }}</td>
                                            <td>{{ $entrada->material_daniado }}</td>
                                            <td>{{ $entrada->material_limpio }}</td>
                                            <td>{{ $entrada->proveedor }}</td>
                                            <td>{{ $entradas->created_by }}</td>

                                            <td>Europalets S.L.</td>
                                            <td>
                                                <a href="javascript:void(0);" class="text-success mr-2">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold edit"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="text-danger mr-2">
                                                    <i class="nav-icon i-Close-Window font-weight-bold delete"></i>
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

    {{--Entradas--}}
    <script>
        var entradas_table

        $(function () {
            // Configuracion de Datatable
            entradas_table = $('#entradas_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [{
                    targets: [0],
                    visible: false
                },],
                responsive: true
            });

            $('#entradas_table .edit').on('click', function () {
                var tr = $(this).closest('tr');
                var row = entradas_table.row(tr).data();
                limpiarCamposEntrada();

                $('#finca_id').val(row[0]);
                $('#finca').val(row[1]);
                $('#finca_form').attr('action', '/almacen/entrada-productos' + row[0]);

                $("#modal-fincas-title").html("Modificar Entrada");
                $("#finca_method").val('PUT');
                $("#modal-fincas").modal('show');
            });

            $('#entradas_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = entradas_table.row(tr).data();

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
                    window.location.href = "{{ url('almacen/entrada-productos/delete') }}" + "/" +
                        row[0]
                })
            });

            $("#btnNuevo").click(function (e) {
                limpiarCamposEntrada();
                $("#modal-entradas-title").html("Nueva Entrada");
                $("#entrada_method").val(null);
                $("#modal-entradas").modal('show');
            })
        });

        function limpiarCamposEntrada() {
            $('#finca_id, #finca').val(null);
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
                $.ajax({
                    type: 'POST',
                    url: "{{ route('entrada-productos.selectMaterial') }}",
                    dataType: 'JSON',
                    data: {
                        "categoria": value
                    },
                    success: function (data) {
                        ClearMaterial();
                        if (data == null) return;

                        for (i = 0; i < data.length; i++) {
                            var value = data[i].id;
                            var text = data[i].formato;

                            var option = "<option value='" + value + "'>" + text + "</option>";
                            $("#material").append(option);
                        }

                        $("#material").trigger('chosen:updated');
                    },
                    error: function (error) {
                        console.log(error)
                        alert('Error. Check Console Log');
                    },
                });
            });
        });

        function ClearMaterial() {
            $("#material").html(null).append('<option value=""></option>');
        }

    </script>
@endsection