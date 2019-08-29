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
        $data['semana']     = CatDiasSemana::orderBy('order', 'ASC')->get();
        $data['semana_ini'] = 1;
        $data['semana_fin'] = 50;

        foreach ($data['semana'] as $k => $value) {
            $data['semana'][$k]->previsiones = Prevision::where('semana', $data['semana_act'])->where(DB::raw("YEAR(fecha)"), date('Y'))->where(DB::raw("DAYOFWEEK(fecha)"), $value->valor)->with('finca')->with('trazabilidad')->get();
        }

        // dd($data['semana']);
        $data['resumen']     = array();
        $data['fincas']      = Finca::all();
        $data['cultivos']    = Cultivo::all();
        $data['comentarios'] = PrevisionComentarios::where("semana", $data['semana_act'])
                                                   ->where('anio', date('Y'))
                                                   ->get();
        foreach ($data['fincas'] as $f => $finca) {
            $data['resumen'][$f]['finca'] = $finca->id;
            foreach ($data['cultivos'] as $c => $cultivo) {
                $data['resumen'][$f]['cultivos'][$c]['id'] = $cultivo->id;
                foreach ($data['semana'] as $k => $value) {
                    $data['resumen'][$f]['cultivos'][$c]['total'][$k] = DB::table('previsiones')
                                                                          ->join('trazabilidad', 'trazabilidad.id', '=', 'previsiones.trazabilidad_id')
                                                                          ->join('variedades', 'variedades.id', '=', 'trazabilidad.variedad_id')
                                                                          ->where('finca_id', '=', $finca->id)
                                                                          ->where('cultivo_id', '=', $cultivo->id)
                                                                          ->where('semana', $data['semana_act'])
                                                                          ->where(DB::raw("YEAR(fecha)"), date('Y'))
                                                                          ->where(DB::raw("DAYOFWEEK(fecha)"), $value->valor)
                                                                          ->where('previsiones.deleted_at', null)
                                                                          ->sum('cantidad');
                }
            }
        }
        
        // dd($data['resumen']);    

        return view('prevision.panel', $data);
    }

    public function store(Request $request)
    {
        if (is_null($request->id)) {
            $prevision = new Prevision();
        } else {
            $prevision = Prevision::find($request->id);
        }

        $prevision->fecha            = $request->fecha;
        $prevision->finca_id         = $request->finca_id;
        $prevision->semana           = $request->semana;
        $prevision->trazabilidad_id  = $request->traza_id;
        $prevision->cantidad_inicial = $request->cantidad;
        $prevision->cantidad         = $request->cantidad;
        $prevision->registro         = "A";

        $prevision->save();

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
        if(is_null($request->comentario_id)){
            $comentario = new PrevisionComentarios();
        }else{
            $comentario = PrevisionComentarios::find($request->comentario_id);
        }

        $comentario->anio       = $request->anio;
        $comentario->semana     = $request->semana;
        $comentario->finca_id   = $request->finca_id;
        $comentario->cultivo_id = $request->cultivo_id;
        $comentario->comentario = $request->comentario;

        $comentario->save();

        return redirect('prevision?semana_act='.$request->semana);
    }
}
