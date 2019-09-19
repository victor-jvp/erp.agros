<?php

namespace App\Http\Controllers;

use App\CatDiasSemana;
use App\Cultivo;
use App\Finca;
use App\Parcela;
use App\Prevision;
use App\PrevisionComentarios;
use App\Trazabilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!is_null($request->semana_act)) {
            $data['semana_act'] = intval($request->semana_act);
        } else {
            $data['semana_act'] = intval(date("W"));
        }

        if (!is_null($request->anio_act)) {
            $data['anio_act'] = intval($request->anio_act);
        } else {
            $data['anio_act'] = intval(date("Y"));
        }

        $data['semana']     = CatDiasSemana::orderBy('order', 'ASC')->get();
        $data['semana_ini'] = 1;
        $data['semana_fin'] = 50;
        $data['anio_ini']   = 2019;
        $data['anio_fin']   = Date('Y');

        foreach ($data['semana'] as $k => $value) {
            $result = Prevision::where('anio', $data['anio_act'])
                               ->where('semana', $data['semana_act'])
                               ->where('dia', $value->id)
                               ->with('finca')
                               ->with('trazabilidad')
                               ->get();

            $data['semana'][$k]->previsiones = $result;
        }

        $data['resumen']     = array();
        $data['fincas']      = Finca::all();
        $data['cultivos']    = Cultivo::all();
        $data['comentarios'] = PrevisionComentarios::where("semana", $data['semana_act'])->where('anio', $data['anio_act'])->get();
        foreach ($data['fincas'] as $f => $finca) {
            $data['resumen'][$f]['finca'] = $finca->id;
            $totalFinca = 0;
            foreach ($data['cultivos'] as $c => $cultivo) {
                $data['resumen'][$f]['cultivos'][$c]['id'] = $cultivo->id;
                $totalSemana = 0;
                $totalSemanaAnt = 0;
                foreach ($data['semana'] as $k => $value) {
                    //Calcular total de la semana actual
                    $result = DB::table('previsiones')
                                ->join('trazabilidad', 'trazabilidad.id', '=', 'previsiones.trazabilidad_id')
                                ->join('variedades', 'variedades.id', '=', 'trazabilidad.variedad_id')
                                ->where('finca_id', '=', $finca->id)
                                ->where('cultivo_id', '=', $cultivo->id)
                                ->where('anio', $data['anio_act'])
                                ->where('semana', $data['semana_act'])
                                ->where('dia', $value->id)
                                ->where('previsiones.deleted_at', null)
                                ->sum('cantidad');

                    $data['resumen'][$f]['cultivos'][$c]['total'][$k] = $result;
                    $totalSemana += $result;

                    //Calcular total de la semana anterior
                    $result2 = DB::table('previsiones')
                                ->join('trazabilidad', 'trazabilidad.id', '=', 'previsiones.trazabilidad_id')
                                ->join('variedades', 'variedades.id', '=', 'trazabilidad.variedad_id')
                                ->where('finca_id', '=', $finca->id)
                                ->where('cultivo_id', '=', $cultivo->id)
                                ->where('anio', $data['anio_act'])
                                ->where('semana', ($data['semana_act']-1))
                                ->where('previsiones.deleted_at', null)
                                ->sum('cantidad');
                    $totalSemanaAnt += $result2;
                }
                $totalFinca += $totalSemana;
                $data['resumen'][$f]['cultivos'][$c]['totalSemana'] = round($totalSemana, 2);
                $data['resumen'][$f]['cultivos'][$c]['totalSemanaAnt'] = round($totalSemanaAnt, 2);
            }
            $data['resumen'][$f]['totalFinca'] = $totalFinca;
        }

        return view('prevision.panel', $data);
    }

    public function store(Request $request)
    {
        if (is_null($request->id)) {

            if (isset($request->dia)) {
                foreach ($request->dia as $d => $dia) {

                    $prevision = new Prevision();
                    $prevision->anio             = $request->anio;
                    $prevision->semana           = $request->semana;
                    $prevision->dia              = $dia;
                    $prevision->registro         = "A";
                    $prevision->finca_id         = $request->finca;
                    $prevision->trazabilidad_id  = $request->traza[$d];
                    $prevision->cantidad_inicial = $request->cantidad[$d];
                    $prevision->cantidad         = $request->cantidad[$d];

                    $prevision->save();
                }
            }
        } else {
            $prevision = Prevision::find($request->id);
            $prevision->finca_id         = $request->finca_id;
            $prevision->trazabilidad_id  = $request->traza_id;
            $prevision->cantidad         = $request->cantidad;

            $prevision->save();
        }

        return redirect()->route('prevision.index');
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

    public function LoadTrazaByParcela(Request $request)
    {
        $parcela_id = $request->input('parcela_id');

        if (is_null($parcela_id)) return response()->json(null);

        $data             = array();
        $traza            = Trazabilidad::where('parcela_id', $parcela_id)->with('variedad')->with('variedad.cultivo')->first();
        $data['traza']    = $traza->Traza;
        $data['traza_id'] = $traza->id;
        $data['variedad'] = $traza->variedad->variedad;
        // $data['variedad_id'] = $traza->variedad_id;
        $data['cultivo'] = $traza->variedad->cultivo->cultivo;
        // $data['cultivo_id'] = $traza->variedad->cultivo_id;

        return response()->json($data);
    }

    public function GetPrevision(Request $request)
    {
        $id = $request->input('id');

        if (is_null($id)) return response()->json(null);

        $data = array();
        $data = Prevision::where('id', $id)->with('finca')->with('trazabilidad.variedad.cultivo')->first();

        $data->trazabilidad->traza = $data->trazabilidad->Traza;

        return response()->json($data);
    }

    public function DeletePrevision(Request $request)
    {
        $id = $request->input('id');

        if (is_null($id)) return response()->json(null);

        $data      = array();
        $prevision = Prevision::find($id);
        $prevision->delete();

        return response()->json($data);
    }

    public function SaveComentario(Request $request)
    {
        if (is_null($request->comentario_id)) {
            $comentario = new PrevisionComentarios();
        } else {
            $comentario = PrevisionComentarios::find($request->comentario_id);
        }

        $comentario->anio       = $request->anio;
        $comentario->semana     = $request->semana;
        $comentario->finca_id   = $request->finca_id;
        $comentario->cultivo_id = $request->cultivo_id;
        $comentario->comentario = $request->comentario;

        $comentario->save();

        return redirect('prevision?anio_act='.$request->anio.'&semana_act=' . $request->semana);
    }
}
