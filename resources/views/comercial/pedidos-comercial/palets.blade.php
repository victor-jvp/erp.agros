@for($i = 1; $i <= $palets; $i++) <div class="col-md-6 mb-3">
    <div class="card text-left">
        <div class="card-body table-responsive">
            <h4 class="card-title mb-3">
                <button type="button" class="close" onclick="RemoveCard(this)" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </h4>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <table class="table table-sm table-condensed">
                        <thead>
                            <tr>
                                <th scope="col">Tipo</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($compuestos))
                            @foreach($compuestos as $compuesto)
                            <tr>
                                <td>{{ $compuesto['tipo'] }}</td>
                                <td>{{ $compuesto['descripcion'] }}</td>
                                <td><input type="number" class="form-control" value="{{ $compuesto['cantidad'] }}"></td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="3">No data...</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endfor

