<!doctype html>
<html lang="es">
<head>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <title>Pedido {{ $pedido->id }}</title>
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
                    <td><h6><b>Nro. Orden:</b> {{ $pedido->nro_orden }}</h6></td>
                </tr>
                <tr>
                    <td style="font-size: 10pt" width="50%">
                        <ul>
                            <li><b>Cliente:</b> {{ $pedido->cliente->razon_social }}</li>
                            <li><b>CIF:</b> {{ $pedido->cliente->cif }}</li>
                            <li><b>Dirección:</b> {{ $pedido->cliente->direccion }}</li>
                            <li><b>Teléfono:</b> {{ $pedido->cliente->telefono }}</li>
                            <li><b>Email:</b> {{ $pedido->cliente->email }}</li>
                        </ul>
                    </td>
                    <td style="font-size: 10pt" width="50%">
                        <ul>
                            <li><b>Destino:</b> {{ (isset($pedido->destino )) ? $pedido->destino->descripcion : "" }}
                            </li>
                            <li>
                                <b>Transporte:</b> {{ (isset($pedido->transporte)) ? $pedido->transporte->razon_social : "" }}
                            </li>
                        </ul>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-bordered table-sm">
                <tbody>
                <tr style="font-size: 10pt">
                    <td><b>Semana del Pedido:</b> {{ $pedido->semana }}</td>
                    <td><b>Fecha del Pedido:</b> {{date('d/m/Y', strtotime($pedido->FechaOrden )) }}</td>
                    <td><b>Nº de Palets:</b> {{ $pedido->pallet_cantidad }}</td>
                </tr>
                <tr style="font-size: 10pt">
                    <td><b>Cultivo:</b> {{ $pedido->variable->compuesto->cultivo->cultivo }}</td>
                    <td><b>Cantidad Kg.:</b> {{ $pedido->kilos }}</td>
                    <td><b>Cantidad Cajas:</b> {{ $pedido->cajas }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-bordered table-sm" style="font-size: 10pt;">
                <tbody>
                <thead>
                <tr class="text-center">
                    <th>Tipo</th>
                    <th>Materiales Usados</th>
                    <th>Cantidad</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pedido->tarrinas as $tarrina)
                    <tr>
                        <td>Tarrina</td>
                        <td>{{ $tarrina->tarrina->modelo }}</td>
                        <td class="text-right">{{ $tarrina->cantidad * $pedido->cajas }}</td>
                    </tr>
                @endforeach
                @foreach($pedido->auxiliares as $auxiliar)
                    <tr>
                        <td>Auxiliar</td>
                        <td>{{ $auxiliar->auxiliar->modelo }}</td>
                        <td class="text-right">{{ $auxiliar->cantidad * $pedido->cajas}}</td>
                    </tr>
                @endforeach
                @foreach($pedido->palet_auxiliares as $auxiliar)
                    <tr>
                        <td>Palet Auxiliar</td>
                        <td>{{ $auxiliar->auxiliar->modelo }}</td>
                        <td class="text-right">{{ $auxiliar->cantidad * $pedido->cajas}}</td>
                    </tr>
                @endforeach
                </tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                @if(!is_null($pedido->comentarios) && !empty($pedido->comentarios))
                    <textarea class="form-control " id="observaciones" rows="3"
                              style="font-size: 10pt;">{{ $pedido->comentarios }}</textarea>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>
</html>
