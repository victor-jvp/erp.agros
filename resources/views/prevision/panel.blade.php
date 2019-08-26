@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Previsión</h1>
        <ul>
            {{-- <li><a href="">UI Kits</a></li> --}}
            <li>Panel de Control</li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    {{-- end of breadcrumb --}}

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">Semanas y Fincas</div>

                    <!-- Modal Prevision-->
                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                         aria-hidden="true" id="modal-prevision">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="/prevision" method="POST" id="prevision_form">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" id="prevision_method" value="">
                                    <input type="hidden" name="id" id="prevision_id">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-prevision-title"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="finca">Finca</label>
                                                <input type="hidden" id="finca_id" name="finca_id">
                                                <select class="form-control" id="finca" disabled>
                                                    @foreach ($fincas as $finca)
                                                        <option value="{{ $finca->id }}">{{ $finca->finca }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="fecha">Fecha</label>
                                                <input type="date" name="fecha" id="fecha" class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="semana">Semana</label>
                                                <input type="text" readonly name="semana" id="semana"
                                                       class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="dia">Dia</label>
                                                <input type="text" readonly name="dia" id="dia" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="parcela">Parcela</label>
                                                <select class="form-control chosen" name="parcela" id="parcela" required
                                                        data-placeholder="Seleccione...">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="cantidad">Cantidad</label>
                                                <input type="number" class="form-control" name="cantidad" id="cantidad"
                                                       required step="0.01" value="0.00">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="cultivo">Familia</label>
                                                <input type="text" id="cultivo" class="form-control" disabled>
                                            </div>


                                            <div class="col-md-4 mb-3">
                                                <label for="variedad">Variedad</label>
                                                <input type="text" id="variedad" class="form-control" disabled>
                                            </div>


                                            <div class="col-md-4 mb-3">
                                                <label for="traza">Trazabilidad</label>
                                                <input type="text" id="traza" class="form-control" disabled>
                                                <input type="hidden" name="traza_id" id="traza_id">
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
                        <div class="col-md-3 form-group mb-3">
                            <form action="/prevision" method="GET" id="form_semana_act">
                                <label>Semana</label>
                                <select class="form-control" name="semana_act" id="semana_act">
                                    @for($i = $semana_ini; $i <= $semana_fin; $i++)
                                        <option
                                                {{ ($i == $semana_act) ? 'selected' : '' }} value="{{ $i }}">
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group mb-3">
                            <label>Fincas</label>

                            <ul class="nav nav-pills" id="myPillTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-icon-pill" data-toggle="pill"
                                       href="#finca_all_pill"
                                       role="tab" aria-controls="finca_all_pill" aria-selected="true">- Todas -</a>
                                </li>
                                @foreach ($fincas as $finca)
                                    <li class="nav-item">
                                        <a class="nav-link" id="home-icon-pill" data-toggle="pill"
                                           href="#finca_{{ $finca->id }}_pill" role="tab"
                                           aria-controls="finca_{{ $finca->id }}_pill"
                                           aria-selected="false">{{ $finca->finca }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content" id="myPillTabContent">
                                <div class="tab-pane fade show active" id="finca_all_pill" role="tabpanel"
                                     aria-labelledby="finca_all_pill">

                                    @foreach ($fincas as $finca)
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="card-title">{{ $finca->finca }}
                                                    <small>Semana {{ $semana_act }}</small>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3 text-right">
                                                <button data-finca="{{ $finca->id }}"
                                                        class="btnOpenModalPrevision btn btn-outline-primary"
                                                        type="button">Agregar
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Dia</th>
                                                            <th scope="col">Parcela</th>
                                                            <th scope="col">Familia</th>
                                                            <th scope="col">Kg.</th>
                                                            <th scope="col">Registro</th>
                                                            <th scope="col">Acciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($semana as $dia)
                                                            <tr>
                                                                <th scope="row">{{ $dia->letra }}</th>
                                                                <td colspan="5">
                                                                    @if (count($dia->previsiones) > 0)
                                                                        @if(isset($dia->previsiones{0}->trazabilidad->parcela->finca_id) &&
                                                                            $dia->previsiones{0}->trazabilidad->parcela->finca_id == $finca->id)
                                                                        <table class="table table-bordered">
                                                                            <tbody>
                                                                            @foreach($dia->previsiones as $prevision)
                                                                                <tr>
                                                                                    @if($prevision->trazabilidad->parcela->finca_id == $finca->id)
                                                                                        <td>{{ $prevision->trazabilidad->parcela->parcela }}</td>
                                                                                        <td>{{ $prevision->trazabilidad->variedad->cultivo->cultivo }}</td>
                                                                                        <td>{{ $prevision->cantidad }}</td>
                                                                                        <td>{{ $prevision->registro }}</td>
                                                                                        <td>
                                                                                            <a href="#"
                                                                                               class="text-success mr-2">
                                                                                                <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                                                            </a>
                                                                                            <a href="#"
                                                                                               class="text-danger mr-2">
                                                                                                <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                                                            </a>
                                                                                        </td>
                                                                                    @else
                                                                                        <td colspan="5"></td>
                                                                                    @endif
                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                    @endforeach

                                </div>

                                @foreach($fincas as $finca)
                                    <div class="tab-pane fade" id="finca_{{ $finca->id }}_pill" role="tabpanel"
                                         aria-labelledby="finca_{{ $finca->id }}_pill">

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="card-title">{{ $finca->finca }}
                                                    <small>Semana {{ $semana_act }}</small>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3 text-right">
                                                <button data-finca="{{ $finca->id }}"
                                                        class="btnOpenModalPrevision btn btn-outline-primary"
                                                        type="button">Agregar
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Familia / Producto</th>
                                                            <th scope="col">Total Días</th>
                                                            <th scope="col">Total Semanas</th>
                                                            <th scope="col">Porcentaje</th>
                                                            <th scope="col">Comentarios</th>
                                                            <th scope="col">Acciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($cultivos as $cultivo)
                                                            <tr>
                                                                <td>{{ $cultivo->cultivo }}</td>
                                                                <td>
                                                                    <table class="table table-sm table-bordered">
                                                                        <thead class="thead-dark">
                                                                        <tr class="bg-primary">
                                                                            @foreach($semana as $dia_d)
                                                                                <th scope="col">{{ $dia_d->letra }}</th>
                                                                            @endforeach
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            @foreach($semana as $dia_d)
                                                                                <td>0</td>
                                                                            @endforeach
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td>0.00</td>
                                                                <td>0 %</td>
                                                                <td>
                                                            <textarea class="form-control" name="comentarios"
                                                                      id="comentarios" cols="" rows="2"
                                                                      placeholder="Comentarios..."></textarea>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="text-success mr-2">
                                                                        <i class="nav-icon i-Disk font-weight-bold"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Dia</th>
                                                            <th scope="col">Parcela</th>
                                                            <th scope="col">Familia</th>
                                                            <th scope="col">Kg.</th>
                                                            <th scope="col">Registro</th>
                                                            <th scope="col">Acciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($semana as $dia)
                                                            <tr>
                                                                <th scope="row">{{ $dia->letra }}</th>
                                                                <td colspan="5">
                                                                    @if (count($dia->previsiones) > 0)
                                                                        @if(isset($dia->previsiones{0}->trazabilidad->parcela->finca_id) &&
                                                                            $dia->previsiones{0}->trazabilidad->parcela->finca_id == $finca->id)
                                                                            <table class="table table-bordered">
                                                                                <tbody>
                                                                                @foreach($dia->previsiones as $prevision)
                                                                                    <tr>
                                                                                        @if($prevision->trazabilidad->parcela->finca_id == $finca->id)
                                                                                            <td>{{ $prevision->trazabilidad->parcela->parcela }}</td>
                                                                                            <td>{{ $prevision->trazabilidad->variedad->cultivo->cultivo }}</td>
                                                                                            <td>{{ $prevision->cantidad }}</td>
                                                                                            <td>{{ $prevision->registro }}</td>
                                                                                            <td>
                                                                                                <a href="#"
                                                                                                   class="text-success mr-2">
                                                                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                                                                </a>
                                                                                                <a href="#"
                                                                                                   class="text-danger mr-2">
                                                                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                                                                </a>
                                                                                            </td>
                                                                                        @else
                                                                                            <td colspan="5"></td>
                                                                                        @endif
                                                                                    </tr>
                                                                                @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
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
    <script src="{{asset('assets/js/vendor/calendar/moment-with-locales.js')}}"></script>

    <script>
        $(document).ready(function () {
            $(".chosen").chosen({
                width: "100%",
                no_results_text: "No se encontraron resultados... ",
                allow_single_deselect: true
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    {{--Prevision--}}
    <script>
        $(function () {
            $(".btnOpenModalPrevision").click(function (e) {
                LimpiarCamposPrevision();
                var finca_id = $(this).attr("data-finca");
                if (finca_id != null) {
                    $("#finca").val(finca_id);
                    $("#finca_id").val(finca_id);
                    LoadParcelaByFinca(finca_id);
                }

                $("#modal-prevision-title").html("Nueva Prevision");
                $("#prevision_method").val(null);
                $("#modal-prevision").modal('show');
            });

            $("#fecha").change(function () {
                ChangeFechaField($(this).val());
            });

            $("#semana_act").change(function () {
                $("#form_semana_act").submit();
            });

            $("#parcela").change(function () {
                var parcela = $(this).val();
                LoadTrazaByParcela(parcela);
            });
        });

        function LimpiarCamposPrevision() {
            $('#finca, #finca_id, #fecha, #semana, #dia, #parcela, #cantidad, #cultivo, #variedad, #traza, #traza_id')
                .val(null);
        }

        function ChangeFechaField(varFecha) {
            moment.locale('es');
            var $fecha;
            if (varFecha != null) {
                $fecha = varFecha
            }
            var fecha = moment($fecha);
            $("#fecha").val(fecha.format("YYYY-MM-DD"));
            $("#semana").val(fecha.week());
            $("#dia").val(fecha.format("dddd"));
        }

        function clearParcelas() {
            $("#parcela").html(null).append('<option value=""></option>');
        }

        function LoadParcelaByFinca(finca_id, parcela_id) {
            $.ajax({
                type: 'POST',
                url: "{{ route('prevision.loadParcelaByFinca') }}",
                dataType: 'JSON',
                data: {
                    finca_id: finca_id
                },
                success: function (data) {
                    clearParcelas();
                    if (data == null) return;

                    for (i = 0; i < data.length; i++) {
                        var value = data[i].id;
                        var text = data[i].parcela;
                        var option = "<option value='" + value + "'>" + text + "</option>";
                        $("#parcela").append(option);
                    }

                    if (parcela_id != null) {
                        $("#parcela").val(parcela_id).trigger('chosen:updated');
                    } else {
                        $("#parcela").trigger('chosen:updated');
                    }
                },
                error: function (error) {
                    console.log(error)
                    alert('Error. Check Console Log');
                },
            });
        }

        function clearTrazabilidad() {
            $('#cultivo, #cultivo_id, #variedad, #variedad_id, #traza, #traza_id').val(null);
        }

        function LoadTrazaByParcela(parcela_id) {
            $.ajax({
                type: 'POST',
                url: "{{ route('prevision.LoadTrazaByParcela') }}",
                dataType: 'JSON',
                data: {
                    parcela_id: parcela_id
                },
                success: function (data) {
                    clearTrazabilidad();
                    if (data == null) return;

                    var traza_id = data.traza_id;
                    var traza = data.traza;
                    var cultivo = data.cultivo;
                    var variedad = data.variedad;
                    $("#cultivo").val(cultivo);
                    $("#variedad").val(variedad);
                    $("#traza").val(traza);
                    $("#traza_id").val(traza_id);
                },
                error: function (error) {
                    console.log(error)
                    alert('Error. Check Console Log');
                },
            });
        }
    </script>
@endsection