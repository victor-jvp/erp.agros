<?php

namespace App\Http\Controllers;

use App\Auxiliar;
use App\Caja;
use App\Cubre;
use App\Pallet;
use App\PalletModel;
use App\Tarrina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialesController extends Controller
{

    public function index()
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Maestros | Acceso') || !Auth::user()->can('Maestros - Materiales | Acceso')) {
            return redirect()->route('home');
        }

        $cajas         = Caja::all();
        $pallets       = Pallet::all();
        $cubres        = Cubre::all();
        $auxiliares    = Auxiliar::all();
        $tarrinas      = Tarrina::all();
        $palletsModels = PalletModel::all();

        return view('maestros.materiales', [
            'cajas'         => $cajas,
            'pallets'       => $pallets,
            'cubres'        => $cubres,
            'auxiliares'    => $auxiliares,
            'tarrinas'      => $tarrinas,
            'palletsModels' => $palletsModels
        ]);
    }
}
