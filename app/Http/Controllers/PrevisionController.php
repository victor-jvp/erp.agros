<?php

namespace App\Http\Controllers;

use App\Cultivo;
use App\Finca;
use App\Parcela;
use App\Trazabilidad;
use App\Variedad;
use Illuminate\Http\Request;

class PrevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!is_null($request->semana_act)) {
            $data['semana_act'] = $request->semana_act;
        } else {
            $data['semana_act']   = intval(date("W"));
        }
        $data['semana_dia'][] = "X";
        $data['semana_dia'][] = "J";
        $data['semana_dia'][] = "V";
        $data['semana_dia'][] = "S";
        $data['semana_dia'][] = "D";
        $data['semana_dia'][] = "L";
        $data['semana_dia'][] = "M";
        $data['semana_ini']   = 1;
        $data['semana_fin']   = 50;

        $data['fincas']   = Finca::all();
        $data['cultivos'] = Cultivo::all();

        return view('prevision.panel', $data);
    }

    public function store(Request $request){
        dd($request);

        

        return redirect()->route('prevision.index');
    }

    public function loadParcelaByFinca(Request $request)
    {
        $finca_id = $request->input('finca_id');

        if (is_null($finca_id)) return response()->json(null);

        $data = array();
        $data = Parcela::where('finca_id', $finca_id)->get(['id', 'parcela']);

        return response()->json($data);
    }

    public function LoadTrazaByParcela(Request $request)
    {
        $parcela_id = $request->input('parcela_id');

        if (is_null($parcela_id)) return response()->json(null);

        $data = array();
        $traza = Trazabilidad::where('parcela_id', $parcela_id)->with('variedad')->with('variedad.cultivo')->first();
        $data['traza'] = $traza->Traza;
        $data['traza_id'] = $traza->id;
        $data['variedad'] = $traza->variedad->variedad;
        // $data['variedad_id'] = $traza->variedad_id;
        $data['cultivo'] = $traza->variedad->cultivo->cultivo;
        // $data['cultivo_id'] = $traza->variedad->cultivo_id;

        return response()->json($data);
    }
}