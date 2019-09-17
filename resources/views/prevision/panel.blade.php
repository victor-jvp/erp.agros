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
                                            <div class="col-md-3 mb-3">
                                                <label for="anio">Año</label>
                                                <input type="text" readonly name="anio" id="anio" class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="semana">Semana</label>
                                                <input type="text" readonly name="semana" id="semana"
                                                       class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="dia[]" value="1" class="dias">
                                                    <span>Miércoles</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="dia[]" value="2" class="dias">
                                                    <span>Jueves</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="dia[]" value="3" class="dias">
                                                    <span>Viernes</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="dia[]" value="4" class="dias">
                                                    <span>Sábado</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="dia[]" value="5" class="dias">
                                                    <span>Domingo</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="dia[]" value="6" class="dias">
                                                    <span>Lunes</span>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="checkbox checkbox-success">
                                                    <input type="checkbox" name="dia[]" value="7" class="dias">
                                                    <span>Martes</span>
                                                    <span class="checkmark"></span>
                                                </label>
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
                    {{-- Fin modal Prevision --}}

                    <form action="/prevision" method="GET" id="form_semana_act">
                        <div class="row">

                            <div class="col-md-3 form-group mb-3">
                                <label>Año</label>
                                <select class="form-control" name="anio_act" id="anio_act">
                                    @for($i = $anio_ini; $i <= $anio_fin; $i++)
                                        <option
                                                {{ ($i == $anio_act) ? 'selected' : '' }} value="{{ $i }}">
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Semana</label>
                                <select class="form-control" name="semana_act" id="semana_act">
                                    @for($i = $semana_ini; $i <= $semana_fin; $i++)
                                        <option
                                                {{ ($i == $semana_act) ? 'selected' : '' }} value="{{ $i }}">
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            
                        </div>
                    </form>

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
                                                            <th scope="col" width="50">Dia</th>
                                                            <th scope="col" width="100">Parcela</th>
                                                            <th scope="col" width="300">Familia</th>
                                                            <th scope="col" width="200">Kg.</th>
                                                            <th scope="col" width="200">Registro</th>
                                                            <th scope="col">Acciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($semana as $dia)
                                                            <tr>
                                                                <th scope="row">{{ $dia->letra }}</th>
                                                                <td colspan="5">
                                                                    @if (count($dia->previsiones) > 0)
                                                                        <table class="table table-bordered">
                                                                            <tbody>
                                                                            @foreach($dia->previsiones as $prevision)
                                                                                @if($prevision->finca_id == $finca->id)
                                                                                    <tr>
                                                                                        <td width="99">{{ $prevision->trazabilidad->parcela->parcela }}
                                                                                        </td>
                                                                                        <td width="299">{{ $prevision->trazabilidad->variedad->cultivo->cultivo }}
                                                                                        </td>
                                                                                        <td width="199">{{ $prevision->cantidad }}</td>
                                                                                        <td width="199">{{ $prevision->registro }}</td>
                                                                                        <td>
                                                                                            <a href="javascript:void(0);"
                                                                                               onclick="EditPrevision({{ $prevision->id }})"
                                                                                               class="text-success mr-2 edit">
                                                                                                <i
                                                                                                        class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                                                            </a>
                                                                                            <a href="javascript:void(0);"
                                                                                               onclick="DeletePrevision({{ $prevision->id }})"
                                                                                               class="text-danger mr-2 delete">
                                                                                                <i
                                                                                                        class="nav-icon i-Close-Window font-weight-bold"></i>
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
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
                                                            <th scope="col">Total Semana Actual</th>
                                                            <th scope="col">Total Semana Previa</th>
                                                            <th scope="col">Porcentaje Actual Vs Previa</th>
                                                            <th scope="col">Comentarios</th>
                                                            <th scope="col">Acciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($cultivos as $cultivo)
                                                            @php
                                                                $totalSemana = 0;
                                                                $totalSemanaAnt = 0;
                                                                $porcSemana = 0;
                                                            @endphp
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
                                                                        @foreach ($resumen as $finca_)
                                                                            @if($finca_['finca'] == $finca->id)
                                                                                @foreach ($finca_['cultivos'] as $cultivo_)
                                                                                    @if ($cultivo_['id'] == $cultivo->id)
                                                                                        @php($totalSemana = $cultivo_['totalSemana'])
                                                                                        @php($totalSemanaAnt = $cultivo_['totalSemanaAnt'])
                                                                                        <tr>
                                                                                            @foreach ($cultivo_['total'] as $item)
                                                                                                <td>{{ $item }}</td>
                                                                                            @endforeach
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                                @php
                                                                                    if($totalSemanaAnt == 0 && $totalSemana == 0) {
                                                                                        $porcSemana = 0;
                                                                                    }else if($totalSemana > 0){
                                                                                        $porcSemana = 100-(($totalSemanaAnt/$totalSemana) * 100 );
                                                                                    }else{
                                                                                        $porcSemana = 100;
                                                                                    }
                                                                                    $signo = "";
                                                                                    if($totalSemana > $totalSemanaAnt){
                                                                                        $signo = '<span class="badge badge-success"><i class="i-Triangle-Arrow-Up"></i></span>';
                                                                                    }else if($totalSemana < $totalSemanaAnt){
                                                                                        $signo = '<span class="badge badge-danger"><i class="i-Triangle-Arrow-Down"></i></span>';
                                                                                    }
                                                                                @endphp
                                                                            @endif
                                                                        @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td class="text-center">{{ round($totalSemana, 2) }}</td>
                                                                <td class="text-center">{{ round($totalSemanaAnt, 2) }}</td>
                                                                <td class="text-center">
                                                                    {!! $signo." ".round($porcSemana, 2) !!}%
                                                                </td>
                                                                <form action="/prevision/comentario" method="POST">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="_method"
                                                                           id="prevision_method"
                                                                           value="POST">
                                                                    <input type="hidden" name="anio"
                                                                           value="{{ $anio_act }}">
                                                                    <input type="hidden" name="semana"
                                                                           value="{{ $semana_act  }}">
                                                                    <input type="hidden" name="finca_id"
                                                                           value="{{ $finca->id  }}">
                                                                    <input type="hidden" name="cultivo_id"
                                                                           value="{{ $cultivo->id  }}">
                                                                    <td>
                                                                        @php
                                                                            $seccionComentario = "";
                                                                            foreach ($comentarios as $comentario) {
                                                                            if ($comentario->finca_id == $finca->id &&
                                                                            $comentario->cultivo_id == $cultivo->id) {
                                                                            $seccionComentario = '<input type="hidden"
                                                                                name="comentario_id" id="comentario_id"
                                                                                value="'. $comentario->id .'">
                                                                            <textarea class="form-control" name="comentario"
                                                                                id="comentario" cols="" rows="2"
                                                                                placeholder="Comentarios...">'. $comentario->comentario .'</textarea>';
                                                                            }
                                                                            }
                                                                            if($seccionComentario == ""){
                                                                            echo '<input type="hidden" name="comentario_id"
                                                                                id="comentario_id" value="">
                                                                            <textarea class="form-control" name="comentario"
                                                                                id="comentario" cols="" rows="2"
                                                                                placeholder="Comentarios..."></textarea>';
                                                                            }else{
                                                                            echo $seccionComentario;
                                                                            }
                                                                        @endphp
                                                                    </td>
                                                                    <td>
                                                                        <button type="submit"
                                                                                class="btn btn-outline-success btn-icon m-1">
                                                                    <span class="ul-btn__icon"><i
                                                                                class="i-Disk"></i></span>
                                                                        </button>
                                                                    </td>
                                                                </form>
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
                                                            <th scope="col" width="50">Dia</th>
                                                            <th scope="col" width="100">Parcela</th>
                                                            <th scope="col" width="300">Familia</th>
                                                            <th scope="col" width="200">Kg.</th>
                                                            <th scope="col" width="200">Registro</th>
                                                            <th scope="col">Acciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($semana as $dia)
                                                            <tr>
                                                                <th scope="row">{{ $dia->letra }}</th>
                                                                <td colspan="5">
                                                                    @if (count($dia->previsiones) > 0)
                                                                        <table class="table table-bordered">
                                                                            <tbody>
                                                                            @foreach($dia->previsiones as $prevision)
                                                                                @if($prevision->finca_id == $finca->id)
                                                                                    <tr>
                                                                                        @if($prevision->trazabilidad->parcela->finca_id == $finca->id)
                                                                                            <td width="99">{{ $prevision->trazabilidad->parcela->parcela }}</td>
                                                                                            <td width="299">{{ $prevision->trazabilidad->variedad->cultivo->cultivo }}</td>
                                                                                            <td width="199">{{ $prevision->cantidad }}</td>
                                                                                            <td width="199">{{ $prevision->registro }}</td>
                                                                                            <td>
                                                                                                <a href="javascript:void(0);"
                                                                                                   onclick="EditPrevision({{ $prevision->id }})"
                                                                                                   class="text-success mr-2 edit">
                                                                                                    <i
                                                                                                            class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                                                                </a>
                                                                                                <a href="javascript:void(0);"
                                                                                                   onclick="DeletePrevision({{ $prevision->id }})"
                                                                                                   class="text-danger mr-2 delete">
                                                                                                    <i
                                                                                                            class="nav-icon i-Close-Window font-weight-bold"></i>
                                                                                                </a>
                                                                                            </td>
                                                                                        @else
                                                                                            <td colspan="5"></td>
                                                                                        @endif
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
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
    <script src="{{asset('assets/js/vendor/calendar/moment-with-locales.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $(".chosen").chosen({
                width: "100%",
                no_results_text: "No se encontraron resultados... ",
                placeholder_text_single: "Seleccione una opción...",
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
                    $("#anio").val($("#anio_act").val())
                    $("#semana").val($("#semana_act").val())
                    LoadParcelaByFinca(finca_id);
                }

                $("#modal-prevision-title").html("Nueva Prevision");
                $("#prevision_id").val(null);
                $("#modal-prevision").modal('show');
            });

            $("#semana_act").change(function () {
                $("#form_semana_act").submit();
            });

            $("#parcela").change(function () {
                var parcela = $(this).val();
                LoadTrazaByParcela(parcela);
            });
        });

        function DeletePrevision(id) {
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
                    type: 'POST',
                    url: "{{ route('prevision.DeletePrevision') }}",
                    dataType: 'JSON',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        if (data != null) {
                            swal({
                                title: "Procesado",
                                text: "Registro eliminado",
                                type: "info",
                            }).then(function () {
                                window.location.reload();
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error)
                        alert('Error. Check Console Log');
                    },
                });
            })
        }

        function EditPrevision(id) {
            $.ajax({
                type: 'POST',
                url: "{{ route('prevision.GetPrevision') }}",
                dataType: 'JSON',
                data: {
                    id: id
                },
                success: function (data) {
                    LimpiarCamposPrevision();
                    if (data == null) return;

                    $("#finca_id, #finca").val(data.finca_id);
                    $("#anio").val(data.anio);
                    $("#semana").val(data.semana);
                    $(".dias").prop("checked", false);
                    $(".dias[value=" + data.dia + "]").prop("checked", true);
                    $(".dias").prop('disabled', true);
                    LoadParcelaByFinca(data.finca_id, data.trazabilidad.parcela_id)
                    $("#cantidad").val(data.cantidad);
                    $("#cultivo").val(data.trazabilidad.variedad.cultivo.cultivo);
                    $("#variedad").val(data.trazabilidad.variedad.variedad);
                    $("#traza").val(data.trazabilidad.traza);
                    $("#traza_id").val(data.trazabilidad_id);

                    $("#modal-prevision-title").html('Modificar Prevision');
                    $("#prevision_id").val(data.id);
                    $("#modal-prevision").modal('show');
                },
                error: function (error) {
                    console.log(error)
                    alert('Error. Check Console Log');
                },
            });
        }

        function LimpiarCamposPrevision() {
            $('#finca, #finca_id, #anio, #semana, #parcela, #cantidad, #cultivo, #variedad, #traza, #traza_id').val(null);
            $(".dias").prop("checked", false).prop('disabled', false);
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