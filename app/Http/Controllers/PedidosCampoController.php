<?php

namespace App\Http\Controllers;

use App\Contador;
use App\Finca;
use App\Parcela;
use App\PedidosCampo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function foo\func;

class PedidosCampoController extends Controller
{
    public function index(Request $request)
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Prevision | Acceso') || !Auth::user()->can('Prevision - Pedido Campo | Acceso')) {
            return redirect()->route('home');
        }

        $fecha_act = (is_null($request->fecha_act)) ? date('Y-m-d') : date("Y-m-d", strtotime($request->fecha_act));
        $fincas    = Finca::all();

        $nro_pedido = Contador::next_nro_lote_pedido();

        foreach ($fincas as $f => $finca) {
            $query = "SELECT
                    pedidos_campo.*,
                    parcelas.parcela
                FROM
                    pedidos_campo
                INNER JOIN parcelas ON parcelas.id = pedidos_campo.parcela_id
                INNER JOIN fincas ON fincas.id = parcelas.finca_id
                WHERE
                   pedidos_campo.deleted_at IS NULL AND fincas.id = " . $finca->id . " AND pedidos_campo.fecha = '" . $fecha_act . "'
                ORDER BY
                    pedidos_campo.sort ASC";

            $pedidos             = DB::select($query);
            $fincas[$f]->pedidos = $pedidos;

            $query = "SELECT
                    IFNULL(COUNT( * ),0) AS total,
                    IFNULL(SUM( kilos ), 0) AS kilos
                FROM
                    pedidos_campo
                INNER JOIN parcelas ON parcelas.id = pedidos_campo.parcela_id
                INNER JOIN fincas ON fincas.id = parcelas.finca_id
                WHERE
                   pedidos_campo.deleted_at IS NULL AND fincas.id = " . $finca->id . " AND pedidos_campo.fecha = '" . $fecha_act . "'";

            $totales                 = DB::select($query);
            $fincas[$f]->totalPedido = $totales[0];
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

        $pedido->fecha           = $request->fecha;
        $pedido->nro_lote_pedido = Contador::save_nro_lote_pedido();
        $pedido->encargado       = $request->encargado;
        $pedido->finca_id        = $request->finca_id;
        $pedido->parcela_id      = $request->parcela;
        $pedido->sort            = $pedido->SetSort;
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

    public function update(Request $request, $id)
    {

        $pedido = PedidosCampo::find($id);

        $pedido->fecha           = $request->fecha;
        $pedido->nro_lote_pedido = $request->nro_lote_pedido;
        $pedido->encargado       = $request->encargado;
        $pedido->finca_id        = $request->finca_id;
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

    public function delete($id)
    {
        $pedido = PedidosCampo::find($id);
        $pedido->delete();

        return redirect()->route('pedidos-campo.index');
    }

    public function GetPedido(Request $request)
    {
        $id = $request->input('id');

        if (is_null($id)) return response()->json(null);

        $data = PedidosCampo::with('parcela')->find($id);

        return response()->json($data); // How do I return in json? in case of an error message?
    }

    public function up(Request $request, $id)
    {
        $fecha_act = (is_null($request->fecha_act)) ? date('Y-m-d') : date("Y-m-d", strtotime($request->fecha_act));

        $pedido  = PedidosCampo::find($id);
        $pedidos = PedidosCampo::where("fecha", $pedido->fecha)->where("finca_id", $pedido->finca_id)->orderBy('sort', 'ASC')->get();

        if($pedido->sort > 1){
            foreach ($pedidos as $row) {
                $current = PedidosCampo::find($row->id);
                if ($current->sort == ($pedido->sort - 1)) {
                    $current->sort = $pedido->sort;
                    $pedido->sort = $pedido->sort - 1;
                    $current->save();
                    $pedido->save();
                }
            }
        }

        $data = array(
            'fecha_act' => $fecha_act
        );
        return redirect()->route('pedidos-campo.index', $data);
    }

    public function down(Request $request, $id)
    {
        $fecha_act = (is_null($request->fecha_act)) ? date('Y-m-d') : date("Y-m-d", strtotime($request->fecha_act));

        $pedido  = PedidosCampo::find($id);
        $pedidos = PedidosCampo::where("fecha", $pedido->fecha)->where("finca_id", $pedido->finca_id)->orderBy('sort', 'ASC')->get();

        if ($pedido->sort < count($pedidos)) {
            foreach ($pedidos as $row) {
                $current = PedidosCampo::find($row->id);
                if ($current->sort == ($pedido->sort + 1)) {
                    $current->sort = $pedido->sort;
                    $pedido->sort = $pedido->sort + 1;
                    $current->save();
                    $pedido->save();
                }
            }
        }

        $data = array(
            'fecha_act' => $request->fecha,
        );
        return redirect()->route('pedidos-campo.index', $data);
    }
}
