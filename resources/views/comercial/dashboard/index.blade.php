@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Comercial</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Dashboard</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">

                <div class="card-body">
                    <h4 class="card-title mb-3">Dashboard</h4>
                    {{-- <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface</p> --}}

                    <hr>

                    <div class="row">
                        <div class="col-md-3 form-group mb-3">
                            <label>Año</label>
                            <select class="form-control" name="anio_act" id="anio_act">
                                @for($i = $anio_fin; $i >= $anio_ini; $i--)
                                    <option
                                            {{ ($i == $anio_act) ? 'selected' : '' }} value="{{ $i }}">
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-3 form-group mb-3">
                            <label>Semana</label>
                            <select class="form-control" name="semana_act" id="semana_act">
                                @for($i = $semana_fin; $i >= $semana_ini; $i--)
                                    <option
                                            {{ ($i == $semana_act) ? 'selected' : '' }} value="{{ $i }}">
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        {{--                        <div class="col-md-6  text-right form-group mb-3">--}}
                        {{--                            <br>--}}
                        {{--                            <button class="btn btn-outline-primary" type="button" id="btnAddPedido">Añadir Pedido--}}
                        {{--                            </button>--}}
                        {{--                        </div>--}}
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Cultivos</label>

                            <ul class="nav nav-pills" id="myPillTab" role="tablist">
                                @foreach ($cultivos as $c => $cultivo)
                                    <li class="nav-item">
                                        <a class="nav-link {{ ($c==0) ? 'active show' : '' }}" id="home-icon-pill"
                                           data-toggle="pill" href="#cultivo_{{ $cultivo->id }}_pill" role="tab"
                                           aria-controls="cultivo_{{ $cultivo->id }}_pill"
                                           aria-selected="{{ ($c==0) ? 'true' : 'false' }}">{{ $cultivo->cultivo }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content" id="myPillTabContent">
                                @foreach ($cultivos as $c => $cultivo)
                                    <div class="tab-pane fade {{ ($c==0) ? 'active show' : '' }}"
                                         id="cultivo_{{ $cultivo->id }}_pill" role="tabpanel"
                                         aria-labelledby="cultivo_{{ $cultivo->id }}_pill">
                                        <div class="row mb-3">
                                            <div class="col-md-8 mb-3">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card text-left">
                                                            <div class="card-body">
                                                                <h4 class="card-title mb-3">Resumen de la Semana</h4>
                                                                {{--                                                                <p>Add <code>.table-sm</code> to make tables more compact by--}}
                                                                {{--                                                                    cutting cell padding in half.</p>--}}
                                                                <div class="table-responsive">
                                                                    <table class="table table-sm table-bordered"
                                                                           width="100%">
                                                                        <thead>
                                                                        <tr class="text-center">
                                                                            <th width="20%" scope="col"></th>
                                                                            <th width="10%" scope="col">X</th>
                                                                            <th width="10%" scope="col">J</th>
                                                                            <th width="10%" scope="col">V</th>
                                                                            <th width="10%" scope="col">S</th>
                                                                            <th width="10%" scope="col">D</th>
                                                                            <th width="10%" scope="col">L</th>
                                                                            <th width="10%" scope="col">M</th>
                                                                            <th width="10%" scope="col">TOTAL</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            <th class="text-right" scope="row">
                                                                                KG/Prevision
                                                                            </th>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="text-right" scope="row">
                                                                                KG/Venta
                                                                            </th>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        </tbody>
                                                                        <tfoot>
                                                                        <tr>
                                                                            <th class="text-right">TOTAL</th>
                                                                            <th colspan="8"></th>
                                                                        </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6 mb-3">

                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="card mb-3">
                                                            <div class="card-body p-0">
                                                                <div class="card-title border-bottom d-flex align-items-center m-0 p-3">
                                                                    <span>{{ $cultivo->cultivo }}</span>
                                                                    <span class="flex-grow-1"></span>
                                                                    {{--                                                                    <span class="badge badge-pill badge-warning">Updated daily</span>--}}
                                                                </div>
                                                                <div class="d-flex border-bottom justify-content-between p-3">
                                                                    <div class="flex-grow-1">
                                                                        <span class="text-small text-muted">Media Semanal</span>
                                                                        <h5 class="m-0">1.00 €</h5>
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <span class="text-small text-muted">Media Anual</span>
                                                                        <h5 class="m-0">3.00 €</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="card text-left">
                                                            <div class="card-body">
                                                                {{--                                                                <h4 class="card-title mb-3">Light Small Table</h4>--}}
                                                                {{--                                                                <p>Add <code>.table-sm</code> to make tables more compact by--}}
                                                                {{--                                                                    cutting cell padding in half.</p>--}}
                                                                <div class="row">
                                                                    <div class="col-md-6 form-group mb-3">
                                                                        <label for="picker1">Cliente</label>
                                                                        <select class="form-control">
                                                                            <option>Option 1</option>
                                                                            <option>Option 1</option>
                                                                            <option>Option 1</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3 form-group mb-3">
                                                                        <label for="fecha_desde">Desde</label>
                                                                        <input type="date" class="form-control"
                                                                               id="fecha_desde"
                                                                               placeholder="dd/mm/aaaa">
                                                                    </div>
                                                                    <div class="col-md-3 form-group mb-3">
                                                                        <label for="fecha_hasta">Hasta</label>
                                                                        <input type="date" class="form-control"
                                                                               id="fecha_hasta"
                                                                               placeholder="dd/mm/aaaa">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-sm table-bordered"
                                                                                   width="100%">
                                                                                <thead class="text-center">
                                                                                <tr>
                                                                                    <th scope="col" colspan="2">Kg
                                                                                        Venta
                                                                                    </th>
                                                                                    <th scope="col" colspan="2">Formato
                                                                                        Ventas
                                                                                    </th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="col">Totales</th>
                                                                                    <th scope="col">€</th>
                                                                                    <th scope="col">Formato</th>
                                                                                    <th scope="col">€</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody class="text-center">
                                                                                <tr>
                                                                                    <td scope="row">1000</td>
                                                                                    <td>155.00 €</td>
                                                                                    <td>10x500 / 1</td>
                                                                                    <td>500.00 €</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td scope="row">1455</td>
                                                                                    <td>222.00 €</td>
                                                                                    <td>10x500 / 4</td>
                                                                                    <td>425.00 €</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td scope="row">1321</td>
                                                                                    <td>111.00 €</td>
                                                                                    <td>12x400</td>
                                                                                    <td>1000.00 €</td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="card text-left">
                                                            <div class="card-body">
                                                                {{--                                                                <h4 class="card-title mb-3">Light Small Table</h4>--}}
                                                                {{--                                                                <p>Add <code>.table-sm</code> to make tables more compact by--}}
                                                                {{--                                                                    cutting cell padding in half.</p>--}}
                                                                <div class="row">
                                                                    <div class="col-md-6 form-group mb-3">
                                                                        <label for="picker1">Cliente</label>
                                                                        <select class="form-control">
                                                                            <option>Option 1</option>
                                                                            <option>Option 1</option>
                                                                            <option>Option 1</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3 form-group mb-3">
                                                                        <label for="fecha_desde">Desde</label>
                                                                        <input type="date" class="form-control"
                                                                               id="fecha_desde"
                                                                               placeholder="dd/mm/aaaa">
                                                                    </div>
                                                                    <div class="col-md-3 form-group mb-3">
                                                                        <label for="fecha_hasta">Hasta</label>
                                                                        <input type="date" class="form-control"
                                                                               id="fecha_hasta"
                                                                               placeholder="dd/mm/aaaa">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-sm table-bordered"
                                                                                   width="100%">
                                                                                <thead class="text-center">
                                                                                <tr>
                                                                                    <th scope="col" colspan="2">Kg
                                                                                        Venta
                                                                                    </th>
                                                                                    <th scope="col" colspan="2">Formato
                                                                                        Ventas
                                                                                    </th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="col">Totales</th>
                                                                                    <th scope="col">€</th>
                                                                                    <th scope="col">Formato</th>
                                                                                    <th scope="col">€</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody class="text-center">
                                                                                <tr>
                                                                                    <td scope="row">1000</td>
                                                                                    <td>155.00 €</td>
                                                                                    <td>10x500 / 1</td>
                                                                                    <td>500.00 €</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td scope="row">1455</td>
                                                                                    <td>222.00 €</td>
                                                                                    <td>10x500 / 4</td>
                                                                                    <td>425.00 €</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td scope="row">1321</td>
                                                                                    <td>111.00 €</td>
                                                                                    <td>12x400</td>
                                                                                    <td>1000.00 €</td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <div class="row mb-4">
                                                    <div class="col-md-8">
                                                        <div class="card mb-4">
                                                            <div class="card-body">
                                                                <label for="fecha_pedidos">ESTADO DE PEDIDOS EN
                                                                    PRODUCCIÓN</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"
                                                                              id="basic-addon3">Fecha</span>
                                                                    </div>
                                                                    <input type="date" class="form-control"
                                                                           id="fecha_pedidos"
                                                                           aria-describedby="basic-addon3">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="card text-left">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-sm table-bordered"
                                                                                   width="100%">
                                                                                <thead class="text-center">
                                                                                <tr>
                                                                                    <th scope="col">Nº Orden</th>
                                                                                    <th scope="col">Cliente</th>
                                                                                    <th scope="col">Formato</th>
                                                                                    <th scope="col">Estado</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody class="text-center">
                                                                                <tr>
                                                                                    <td scope="row">1000</td>
                                                                                    <td>155.00 €</td>
                                                                                    <td>10x500 / 1</td>
                                                                                    <td>500.00 €</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td scope="row">1455</td>
                                                                                    <td>222.00 €</td>
                                                                                    <td>10x500 / 4</td>
                                                                                    <td>425.00 €</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td scope="row">1321</td>
                                                                                    <td>111.00 €</td>
                                                                                    <td>12x400</td>
                                                                                    <td>1000.00 €</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td scope="row">1000</td>
                                                                                    <td>155.00 €</td>
                                                                                    <td>10x500 / 1</td>
                                                                                    <td>500.00 €</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td scope="row">1455</td>
                                                                                    <td>222.00 €</td>
                                                                                    <td>10x500 / 4</td>
                                                                                    <td>425.00 €</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td scope="row">1321</td>
                                                                                    <td>111.00 €</td>
                                                                                    <td>12x400</td>
                                                                                    <td>1000.00 €</td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12 mb-3">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card text-left">
                                                            <div class="card-body">
                                                                <h4 class="card-title mb-3">Resumen de la Semana</h4>
                                                                {{--                                                                <p>Add <code>.table-sm</code> to make tables more compact by--}}
                                                                {{--                                                                    cutting cell padding in half.</p>--}}
                                                                <div class="table-responsive">
                                                                    <table class="table table-sm table-bordered"
                                                                           width="100%">
                                                                        <thead>
                                                                        <tr class="text-center">
                                                                            <th></th>
                                                                            @for($i = 1; $i <= 50; $i++ )
                                                                                <th>{{ $i }}</th>
                                                                            @endfor
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            <th>Kg Vendidos</th>
                                                                            @for($i = 1; $i <= 50; $i++ )
                                                                                <td></td>
                                                                            @endfor
                                                                        </tr>
                                                                        <tr>
                                                                            <th>€/Kg</th>
                                                                            @for($i = 1; $i <= 50; $i++ )
                                                                                <td></td>
                                                                            @endfor
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Proveedor €</th>
                                                                            @for($i = 1; $i <= 50; $i++ )
                                                                                <td></td>
                                                                            @endfor
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
        var table_transportes

        $(function () {
            // Configuracion de Datatable
            table_transportes = $('#transportes_table').DataTable({
                language: {
                    url: "{{ asset('assets/Spanish.json')}}"
                },
                columnDefs: [{
                    targets: [0],
                    visible: false
                },]
            });

            $('#transportes_table .delete').on('click', function () {
                var tr = $(this).closest('tr');
                var row = table_transportes.row(tr).data();

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
                    window.location.href = "{{ url('comercial/transportes/delete') }}" + "/" + row[0]
                })
            });

            $("#btnNuevo").click(function (e) {
                limpiarCamposTransporte();
                $("#modal-transporte-title").html("Nuevo Transporte");
                $("#modal-transporte").modal('show');
            })
        });

        function limpiarCamposTransporte() {
            $('#cif, #razon_social').val(null);
        }
    </script>
@endsection