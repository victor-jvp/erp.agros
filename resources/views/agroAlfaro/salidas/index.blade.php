@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Agro Alfaro</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Salidas</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Salidas</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}

                    {{--Modal Generar Salida--}}
                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                         aria-hidden="true" id="modal-salida">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="/agroAlfaro/salidas/store" method="POST" id="salida_form">
                                    @csrf
                                    <input type="hidden" name="salida_id" id="salida_id">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-salida-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="traza">Traza</label>
                                                <input type="text" class="form-control" id="traza" readonly
                                                       placeholder="Traza Salida" name="traza" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="fecha">Fecha</label>
                                                <input type="date" class="form-control" id="fecha" placeholder="Fecha"
                                                       required="" name="fecha">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="entrada">Entradas</label>
                                                <select name="entrada_id" id="entrada" class="form-control chosen"
                                                        required>
                                                    <option value=""></option>
                                                    @foreach ($entradas as $entrada)
                                                        @php($disponible = round($entrada->cantidad - $entrada->salidas->sum('cantidad') - $entrada->merma, 2))
                                                        @if ($disponible>0)
                                                            <option value="{{ $entrada->id }}"
                                                                    data-max="{{ $disponible }}">
                                                                {{ "Traza: ".$entrada->traza. " - Albaran: ". $entrada->albaran." - Disponible: ". $disponible }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="proveedor">Proveedor</label>
                                                <select name="proveedor_id" id="proveedor" required
                                                        class="form-control chosen">
                                                    <option value=""></option>
                                                    @foreach ($proveedores as $proveedor)
                                                        <option value="{{ $proveedor->id }}">{{ $proveedor->proveedor }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="producto">Producto</label>
                                                <select name="producto_id" id="producto" class="form-control chosen"
                                                        required>
                                                    <option value=""></option>
                                                    @foreach ($compuestos as $compuesto)
                                                        <option value="{{ $compuesto->id }}">
                                                            {{ $compuesto->compuesto->cultivo->cultivo. " - ".$compuesto->compuesto->compuesto. " - ".$compuesto->variable }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="cliente">Cliente</label>
                                                <select name="cliente_id" id="cliente" class="form-control chosen">
                                                    <option value=""></option>
                                                    @foreach ($clientes as $cliente)
                                                        <option
                                                            value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="cajas">Cajas</label>
                                                <input type="number" class="form-control" id="cajas" placeholder="Cajas"
                                                       name="cajas">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="cantidad">Kilos</label>
                                                <input type="number" class="form-control" id="cantidad" required
                                                       name="cantidad" placeholder="Kilos">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="precio">Precio Venta</label>
                                                <input type="number" class="form-control" id="precio"
                                                       placeholder="Precio Venta" name="precio">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="coste">Coste</label>
                                                <input type="number" class="form-control" id="coste" placeholder="Coste"
                                                       name="coste">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="comision">Comisión</label>
                                                <input type="number" class="form-control" id="comision"
                                                       placeholder="Comisión" name="comision">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="precio_liquidacion">Precio Liquidación</label>
                                                <input type="number" class="form-control" id="precio_liquidacion"
                                                       placeholder="Precio Liquidación" name="precio_liquidacion"
                                                       readonly>
                                            </div>
                                            <div class="col-md-3 mb-3 mt-4">
                                                <label class="checkbox checkbox-primary">
                                                    <input type="checkbox" id="eco" name="eco">
                                                    <span>ECO</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-3 mb-3 mt-4">
                                                <label class="checkbox checkbox-primary">
                                                    <input type="checkbox" id="pagada" name="pagada">
                                                    <span>Pagada</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Cerrar
                                        </button>
                                        @can('AgroAlfaro - Salidas | Crear')
                                            <button type="submit" class="btn btn-primary">Guardar</button>
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
                                <table id="salidas_table" class="display table table-striped table-bordered"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th scope="col">Traza Salida</th>
                                        <th scope="col">Fecha</th>
                                        <th>proveedor_id</th>
                                        <th scope="col">Proveedor</th>
                                        <th>producto_id</th>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Cajas</th>
                                        <th scope="col">Kilos</th>
                                        <th scope="col">Precio Venta</th>
                                        <th>cliente_id</th>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">Coste</th>
                                        <th scope="col">Comisión</th>
                                        <th scope="col">Precio Liquidación</th>
                                        <th>eco</th>
                                        <th scope="col">ECO</th>
                                        <th>pagada</th>
                                        <th scope="col">Pagada</th>
                                        <th>entrada_id</th>
                                        <th>Entrada</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($salidas))
                                        @foreach ($salidas as $salida)
                                            <tr>
                                                <td>{{ $salida->id }}</td>
                                                <td>{{ $salida->traza }}</td>
                                                <td>{{ date("d/m/Y", strtotime($salida->fecha)) }}</td>
                                                <td>{{ $salida->proveedor_id }}</td>
                                                <td>{{ (isset($salida->proveedor)) ? $salida->proveedor->proveedor : "" }}</td>
                                                <td>{{ $salida->producto_id }}</td>
                                                <td>{{ (!is_null($salida->producto_id)) ? $salida->producto->compuesto->cultivo->cultivo. " - ".$salida->producto->compuesto->compuesto. " - ".$salida->producto->variable : "" }}</td>
                                                <td class="text-right">{{ round($salida->cajas, 2) }}</td>
                                                <td class="text-right">{{ round($salida->cantidad, 2) }}</td>
                                                <td class="text-right">{{ round($salida->precio, 2) }}</td>
                                                <td>{{ $salida->cliente_id }}</td>
                                                <td>{{ (!is_null($salida->cliente_id)) ? $salida->cliente->razon_social : "" }}</td>
                                                <td class="text-right">{{ round($salida->coste, 2) }}</td>
                                                <td class="text-right">{{ round($salida->comision, 2) }}</td>
                                                <td class="text-right">{{ round($salida->precio_liquidacion, 2) }}</td>
                                                <td>{{ $salida->eco }}</td>
                                                <td class="text-center">
                                                    <label class="checkbox checkbox-primary">
                                                        <input type="checkbox" {{ ($salida->eco) ? "checked" : "" }} disabled>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{ $salida->pagada }}</td>
                                                <td class="text-center">
                                                    <label class="checkbox checkbox-primary">
                                                        <input type="checkbox" {{ ($salida->pagada) ? "checked" : "" }} disabled>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{ $salida->entrada_id }}</td>
                                                <td>
                                                    @if(isset($salida->entrada))
                                                    <ul class="pl-2">
                                                        <li>Traza: {{ $salida->entrada->traza }}</li>
                                                        <li>Albarán: {{ $salida->entrada->albaran }}</li>
                                                        <li>Disponible: {{ round($salida->entrada->cantidad - $salida->entrada->salidas->sum('cantidad') - $salida->entrada->merma, 2) }}</li>
                                                        <li>Merma: {{ round($salida->entrada->merma, 2)  }}</li>
                                                    </ul>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @can('AgroAlfaro - Salidas | Modificar')
                                                        <a href="javascript:void(0);" class="text-success mr-2 edit"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="Editar">
                                                            <i class="nav-icon i-Pen-2 font-weight-bold "></i>
                                                        </a>
                                                    @endcan
                                                    @can('AgroAlfaro - Salidas | Borrar')
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
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/bootstrap-select.min.css')}}">
@endsection

@section('bottom-js')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap-select/i18n/defaults-es_ES.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/calendar/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/jquery.validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/jquery.validation/messages_es.js')}}"></script>

    <script>
        var table_salidas;
        var salida_form;

        $(document).ready(function () {
            $(".chosen").selectpicker({
                liveSearch: true
            });

            salida_form = $("#salida_form").validate({
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    if ($(element).is('select')) {
                        element.parent().after(error); // special placement for select elements
                    } else {
                        error.insertAfter(element); // default placement for everything else
                    }
                }
            });
        });

        $(function () {
            // Configuracion de Datatable
            table_salidas = $('#salidas_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [{
                    targets: [0, 3, 5, 10, 15, 17, 19],
                    visible: false
                },],
                responsive: false,
                sorting: [
                    [0, 'desc']
                ]
            });

            $('#salidas_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_salidas.row(tr).data();

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
                    $.ajax({
                        type: 'GET',
                        url: "{{ url('agroAlfaro/salidas/delete') }}" + "/" + row[0],
                        dataType: 'JSON',
                        success: function (json) {
                            if (json == null || json == false) return;
                            window.location.reload();
                        },
                        error: function (error) {
                            console.log(error)
                            alert('Error. Check Console Log');
                        },
                    });
                })
            });

            $("#entradas_table .liquidacion").on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_entradas.row(tr).data();
                var id = row[0];

                $("#salida_id").val(id);

                LimpiarCamposSalida();
                $("#modal-salida-title").html("Generar Liquidación");
                $("#modal-salida").modal('show');
            });

            $("#salidas_table .edit").on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_salidas.row(tr).data();

                LimpiarCamposSalida();

                //console.log(row);
                $("#salida_id").val(row[0]);
                $("#traza").val(row[1]);
                var fecha = moment(row[2], "DD/MM/YYYY").format("YYYY-MM-DD");
                $("#fecha").val(fecha);
                $("#proveedor").val(row[3]).selectpicker('refresh');
                $("#producto").val(row[5]).selectpicker('refresh');
                $("#cajas").val(row[7]);
                $("#cantidad").val(row[8]);
                $("#precio").val(row[9]);
                $("#cliente").val(row[10]).selectpicker('refresh');
                $("#coste").val(row[12]);
                $("#comision").val(row[13]);
                $("#precio_liquidacion").val(row[14]);
                $("#eco").prop('checked', (row[15] == 1));
                $("#pagada").prop('checked', (row[17] == 1));
                $("#entrada").val(row[19]).selectpicker('refresh');

                $("#modal-salida-title").html("Detalles de Salida");
                $("#modal-salida").modal('show');
            });

            $("#cantidad, #precio, #comision, #coste").change(function (e) {
                var kilos = parseFloat($("#cantidad").val());
                var precio = parseFloat($("#precio").val());
                var coste = parseFloat($("#coste").val());
                var comision = parseFloat($("#comision").val());
                var precio_liquidacion = "";

                if (kilos > 0 && precio > 0 && coste > 0 && comision > 0) {
                    var total_comision = precio * (comision / 100);
                    precio_liquidacion = (precio - total_comision - coste).toFixed(2);
                }

                $("#precio_liquidacion").val(precio_liquidacion);
            });

            $('#entrada').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                var valor = $(this).val();
                $("#cantidad").removeAttr('max');

                if (valor != "") {
                    var max = $(this).find('option:selected').data('max');
                    $("#cantidad").attr('max', max);
                }
            });

        });

        function LimpiarCamposSalida() {
            var fecha = moment().format("YYYY-MM-DD");
            $("#fecha").val(fecha);
            $('#salida_id, #traza, #cajas, #cantidad, #precio, #cliente, #coste, #precio_liquidacion, #comision').val(null);
            $("#proveedor, #producto, #cliente, #entrada").val(null).selectpicker("refresh");
            $("#pagada, #eco").prop('checked', false);
        }

    </script>
@endsection
