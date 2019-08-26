<?php

namespace App\Http\Controllers;

use App\CatDiasSemana;
use App\Cultivo;
use App\Finca;
use App\Parcela;
use App\Prevision;
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
        $data['semana'] = CatDiasSemana::orderBy('order', 'ASC')->get();
        $data['semana_ini'] = 1;
        $data['semana_fin'] = 50;

        foreach ($data['semana'] as $k => $value) {
            $data['semana'][$k]->previsiones = Prevision::where('semana', $data['semana_act'])
                                                        ->where(DB::raw("YEAR(fecha)"), date('Y'))
                                                        ->where(DB::raw("DAYOFWEEK(fecha)"), $value->valor)->get();
        }

        $data['fincas']   = Finca::all();
        $data['cultivos'] = Cultivo::all();

//        dd($data['semana']);

        return view('prevision.panel', $data);
    }

    public function store(Request $request)
    {

        $prevision                   = new Prevision();
        $prevision->fecha            = $request->fecha;
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
}