@extends('layouts.master')

@section('main-content')
<div class="breadcrumb">
    <h1>Almacén</h1>
    <ul>
        {{-- <li><a href="">UI Kits</a></li> --}}
        <li>Histórico de Entradas</li>
    </ul>
</div>

<div class="separator-breadcrumb border-top"></div>
{{-- end of breadcrumb --}}

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card text-left">

            <div class="card-body">
                <h4 class="card-title mb-3">Histórico de Entradas</h4>
                {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis dolorem neque repellendus sunt nemo repellat incidunt inventore odio quam! Voluptate maiores commodi quis praesentium inventore laboriosam esse facilis exercitationem vero.</p> --}}

                <hr>

                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                       <label for="bs_datepicker_range_container">Entrada Desde - Hasta</label>
                        <div class="input-daterange input-group"
                                id="bs_datepicker_range_container">
                            <div class="form-line">
                                <input type="text" class="form-control" id="entrada_desde"
                                        placeholder="Desde...">
                            </div>
                            <span class="input-group-addon"> - </span>
                            <div class="form-line">
                                <input type="text" class="form-control" id="entrada_hasta"
                                        placeholder="Hasta...">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 form-group mb-3">
                        <label for="albaran">Fecha Albarán</label>
                        <input type="date" class="form-control" id="albaran">
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-3 form-group mb-3">
                        <label for="categoria">Categoria</label>
                        <select class="form-control chosen" id="categoria" data-size="6">
                            <option value=""></option>
                            <option value="Caja">Cajas</option>
                            <option value="Palet">Palets</option>
                            <option value="Cubre">Cubres</option>
                            <option value="Auxiliar">Auxiliares</option>
                            <option value="Tarrina">Tarrinas</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group mb-3">
                        <label for="material">Material</label>
                        <select class="form-control chosen" id="material" data-size="6">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group mb-3">
                        <label for="proveedor">Proveedor</label>
                        <select class="form-control chosen" id="proveedor" data-size="6">
                            <option value=""></option>
                            @foreach($proveedores as $item)
                            <option value="{{ $item->id }}">{{ $item->razon_social }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table id="entradas_table" class="display table table-striped table-bordered"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">N° Lote</th>
                                    <th scope="col">Fecha Entrada</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Material</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Nº Albaran</th>
                                    <th scope="col">Fecha Albaran</th>
                                    <th>proveedor_id</th>
                                    <th scope="col">Proveedor</th>
                                    <th scope="col">Transporte Adecuado</th>
                                    <th scope="col">Control Plagas</th>
                                    <th scope="col">Estado Palets</th>
                                    <th scope="col">Ficha Técnica</th>
                                    <th scope="col">Material Dañado</th>
                                    <th scope="col">Material Limpio</th>
                                    <th scope="col">Control Grapas</th>
                                    <th scope="col">Cantidad Conforme</th>
                                    {{-- <th scope="col">Accion</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($entradas))
                                @foreach ($entradas as $entrada)
                                <tr>
                                    <td>{{ $entrada->id }}</td>
                                    <td>{{ $entrada->nro_lote }}</td>
                                    <td>{{ date('d/m/Y',strtotime($entrada->fecha)) }}</td>
                                    <td>{{ $entrada->categoria }}</td>
                                    <td>{{ $entrada->material }}</td>
                                    <td>{{ $entrada->cantidad }}</td>
                                    <td>{{ $entrada->nro_albaran }}</td>
                                    <td>{{ (is_null($entrada->fecha_albaran)) ? "" : date('d/m/Y',strtotime($entrada->fecha_albaran)) }}</td>
                                    <td>{{ $entrada->proveedor_id }}</td>
                                    <td>{{ (!is_null($entrada->proveedor)) ? $entrada->proveedor->razon_social : "" }}</td>
                                    <td class="text-center">
                                        <label class="checkbox checkbox-success" style="display: inline-block">
                                            <input disabled type="checkbox"
                                                {{ ($entrada->transporte_adecuado) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label class="checkbox checkbox-success" style="display: inline-block">
                                            <input disabled type="checkbox"
                                                {{ ($entrada->control_plagas) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label class="checkbox checkbox-success" style="display: inline-block">
                                            <input disabled type="checkbox"
                                                {{ ($entrada->estado_pallets) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label class="checkbox checkbox-success" style="display: inline-block">
                                            <input disabled type="checkbox"
                                                {{ ($entrada->ficha_tecnica) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label class="checkbox checkbox-success" style="display: inline-block">
                                            <input disabled type="checkbox"
                                                {{ ($entrada->material_daniado) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label class="checkbox checkbox-success" style="display: inline-block">
                                            <input disabled type="checkbox"
                                                {{ ($entrada->material_limpio) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label class="checkbox checkbox-success" style="display: inline-block">
                                            <input disabled type="checkbox"
                                                {{ ($entrada->control_grapas) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label class="checkbox checkbox-success" style="display: inline-block">
                                            <input disabled type="checkbox"
                                                {{ ($entrada->cantidad_conforme) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    {{-- <td>
                                        <a href="javascript:void(0);" onclick="LoadEntrada({{ $entrada->id }})"
                                    class="text-success mr-2">
                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="text-danger mr-2 delete">
                                        <i class="nav-icon i-Close-Window font-weight-bold "></i>
                                    </a>
                                    </td> --}}
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
<link rel="stylesheet" href="{{asset('assets/styles/vendor/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/bootstrap-datepicker/bootstrap-datepicker.css')}}">
@endsection

@section('bottom-js')
<script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/bootstrap-select/i18n/defaults-es_ES.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/calendar/moment-with-locales.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/js/vendor/bootstrap-datepicker/bootstrap-datepicker.es.min.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function loadMaterial(valor, selected) {
        $.ajax({
            type: 'POST',
            url: "{{ route('entrada-productos.selectMaterial') }}",
            dataType: 'JSON',
            data: {
                "categoria": valor
            },
            success: function (data) {
                ClearMaterial();
                if (data == null) return;

                for (i = 0; i < data.length; i++) {
                    var value = data[i].id;
                    if (data[i].modelo != null && data[i].modelo != undefined && data[i].modelo != "") {
                        var text = data[i].formato + " | " + data[i].modelo;
                    } else {
                        var text = data[i].formato;
                    }

                    var option = "<option value='" + value + "'>" + text + "</option>";
                    $("#material").append(option);
                }

                if (selected != null) {
                    $("#material").val(selected).selectpicker('refresh');
                } else {
                    $("#material").selectpicker('refresh');
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

{{--Entradas--}}
<script>
    var entradas_table;

    $(document).ready(function () {
        // Configuracion de Datatable
        entradas_table = $('#entradas_table').DataTable({
            language: {
                url: "{{ asset('assets/Spanish.json')}}"
            },
            dom: 'ltipr',
            columnDefs: [{
                targets: [0,8],
                visible: false
            }, ],
            responsive: true,
            order: [
                [1, 'desc']
            ]
        });

        $(".chosen").selectpicker({
            liveSearch: true
        });

        $('#categoria').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            var value = $(this).val();
            loadMaterial(value);
            entradas_table.column(3).search(value).draw();
        });

        $('#material').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            var value = $(this).val();
            entradas_table.column(4).search(value).draw();
        });

        $('#proveedor').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            var value = $(this).val();
            entradas_table.column(8).search(value).draw();
        });

        $("#albaran").change(function(e){
            var valor = $(this).val();
            if (valor != "") {
                var fecha = moment(valor).format('DD/MM/YYYY');
                entradas_table.column(7).search(fecha).draw();
            }else{
                entradas_table.column(7).search("").draw();
            }
        });

        $('#bs_datepicker_range_container').datepicker({
            autoclose: true,
            language: 'es',
            container: '#bs_datepicker_range_container',
        }).on('changeDate', function (e) {
            entradas_table.draw();
        });

        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var min = $("#entrada_desde").val();
                var max = $("#entrada_hasta").val();
                var fecha = data[2];

                var startDate = moment(min, "DD/MM/YYYY");
                var endDate = moment(max, "DD/MM/YYYY");
                var diffDate = moment(fecha, "DD/MM/YYYY");

                if ((min == "" || max == "") || (diffDate.isBetween(startDate, endDate, null, '[]'))) {
                    return true;
                }
                return false;
            }
        );
    });

</script>


@endsection
