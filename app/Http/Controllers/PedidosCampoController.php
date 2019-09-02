<?php

namespace App\Http\Controllers;

use App\Contador;
use App\Finca;
use App\Parcela;
use App\PedidosCampo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function foo\func;

class PedidosCampoController extends Controller
{
    public function index(Request $request)
    {
        $fecha_act  = (is_null($request->fecha_act)) ? date('Y-m-d') : date("Y-m-d", strtotime($request->fecha_act));
        $fincas     = Finca::with('pedidos')->get();
        $nro_pedido = Contador::next_nro_lote_pedido();

        foreach ($fincas as $f => $finca) {
            $query = "SELECT
                    IFNULL(COUNT( * ),0) AS total,
                    IFNULL(SUM( kilos ), 0) AS kilos 
                FROM
                    pedidos_campo
                INNER JOIN parcelas ON parcelas.id = pedidos_campo.parcela_id
                INNER JOIN fincas ON fincas.id = parcelas.finca_id
                WHERE
                    fincas.id = ".$finca->id." AND pedidos_campo.fecha = '".$fecha_act."'";
            $pedidos = DB::select($query);
            $fincas[$f]->totalPedido = $pedidos[0];
        }

        $data = array(
            "fincas"     => $fincas,
            "fecha_act"  => $fecha_act,
            "nro_pedido" => $nro_pedido,
        );
        return view('prevision.campo', $data);
    }


    public function loadParcelaByFinca(Request $request)
    {
        $finca_id = $request->input('finca_id');

        if (is_null($finca_id)) return response()->json(null);

        $data = array();
        $data = Parcela::where('finca_id', $finca_id)->get([
            'id',
            'parcela'
        ]);

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $pedido = new PedidosCampo();
        if (!is_null($request->id)) {
            $pedido = PedidosCampo::find($request->id);
        }
        $pedido->fecha           = $request->fecha;
        $pedido->nro_lote_pedido = Contador::save_nro_lote_pedido();
        $pedido->encargado       = $request->encargado;
        $pedido->parcela_id      = $request->parcela;
        $pedido->formato         = $request->formato;
        $pedido->caja            = $request->caja;
        $pedido->kilos           = $request->kilos;
        $pedido->cliente         = $request->cliente;
        $pedido->comentario      = $request->comentario;

        $pedido->save();

        $data = array(
            'fecha_act' => $request->fecha,
        );
        return redirect()->route('pedidos-campo.index', $data);
    }
}
