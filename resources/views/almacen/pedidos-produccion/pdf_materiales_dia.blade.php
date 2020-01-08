<!doctype html>
<html lang="es">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/perfect-scrollbar.css')}}">

    <title>Listado de Materiales</title>
</head>
<body class="py-4">

<div class="container-fluid themed-container">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table">
                <tbody>
                <tr>
                    @php
                        if(file_exists( 'storage/logo_emp.jpg' ))
                        $file =  'storage/logo_emp.jpg';
                        elseif(file_exists( 'storage/logo_emp.png' ))
                        $file =  'storage/logo_emp.png';
                        elseif(file_exists( 'storage/logo_emp.gif' ))
                        $file =  'storage/logo_emp.gif';
                        else
                        $file = "javascript:void(0)"
                    @endphp

                    <td><img src="{{ $file }}" alt="Logo Empresa" height="75px"><h4>{{ $empresa->razon_social }}</h4>
                    </td>
                    <td>
                        <h6><b>Año:</b> {{ $pedidos[0]->anio }}</h6>
                        <h6><b>Semana:</b> {{ $pedidos[0]->semana }}</h6>
                        <h6><b>Dia:</b> {{ $pedidos[0]->dia->dia }}</h6>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-bordered table-sm table-condensed" style="font-size: 10pt;">
                <thead>
                <tr class="text-center">
                    <th>Material</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Nº Entrada</th>
                    <th>Nº Salida</th>
                    <th>Nº Albaran</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pedidos as $pedido)
                    <tr class="">
                        <th class="text-right">Nº de Orden: {{ $pedido->nro_orden }}</th>
                        <th colspan="5">Cliente: {{ $pedido->cliente->razon_social }}</th>
                    </tr>
                    @foreach($pedido->tarrinas as $tarrina)
                        <tr>
                            <td>Tarrina</td>
                            <td>{{ $tarrina->tarrina->modelo }}</td>
                            <td class="text-right">
                                @foreach ($tarrina->salidas as $salida)
                                    <p style="padding: 0px;">{{ $salida->cantidad }}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($tarrina->entradas as $entrada)
                                    <p style="padding: 0px;">{{ $entrada->nro_lote }}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($tarrina->salidas as $salida)
                                    <p style="padding: 0px;">{{ $salida->nro_lote }}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($tarrina->entradas as $entrada)
                                    <p style="padding: 0px;">{{ $entrada->nro_albaran }}</p>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    @foreach($pedido->auxiliares as $auxiliar)
                        <tr>
                            <td>Auxiliar</td>
                            <td>{{ $auxiliar->auxiliar->modelo }}</td>
                            <td class="text-right">
                                @foreach ($auxiliar->salidas as $salida)
                                    <p style="padding: 0px;">{{ $salida->cantidad }}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($auxiliar->entradas as $entrada)
                                    <p style="padding: 0px;">{{ $entrada->nro_lote }}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($auxiliar->salidas as $salida)
                                    <p style="padding: 0px;">{{ $salida->nro_lote }}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($auxiliar->entradas as $entrada)
                                    <p style="padding: 0px;">{{ $entrada->nro_albaran }}</p>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    @foreach($pedido->palet_auxiliares as $auxiliar)
                        <tr>
                            <td>Auxiliar Palet</td>
                            <td>{{ $auxiliar->auxiliar->modelo }}</td>
                            <td class="text-right">
                                @foreach ($auxiliar->salidas as $salida)
                                    <p style="padding: 0px;">{{ $salida->cantidad }}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($auxiliar->entradas as $entrada)
                                    <p style="padding: 0px;">{{ $entrada->nro_lote }}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($auxiliar->salidas as $salida)
                                    <p style="padding: 0px;">{{ $salida->nro_lote }}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($auxiliar->entradas as $entrada)
                                    <p style="padding: 0px;">{{ $entrada->nro_albaran }}</p>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

</body>
</html>
