<?php

namespace App\Http\Controllers;

use App\Cultivo;
use App\Finca;
use App\Parcela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FincasParcelasController extends Controller
{

    public function index()
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Maestros | Acceso') || !Auth::user()->can('Maestros - Fincas | Acceso')) {
            return redirect()->route('home');
        }

        $fincas   = Finca::all();
        $parcelas = Parcela::all();
        $cultivos = Cultivo::all();
        return view('maestros.fincas', array(
            'fincas'   => $fincas,
            'parcelas' => $parcelas,
            'cultivos' => $cultivos
        ));
    }
}
