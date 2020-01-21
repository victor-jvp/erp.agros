<?php

namespace App\Http\Controllers;

use App\Especiales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EspecialesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Configuracion | Acceso') || !Auth::user()->can('Configuracion - Especiales | Acceso')) {
            return redirect()->route('home');
        }

        $especiales = Especiales::all()->first();
        if (is_null($especiales)) $especiales = new Especiales();
        $data['especiales'] = $especiales;
        return view('configuracion.especiales')->with($data);
    }

    public function semanas(Request $request)
    {
        $especiales = DB::table('especiales')->count();
        if ($especiales == 0) {
            DB::table('especiales')->insert([
                'semana_ini' => $request->semana_ini,
                'semana_fin' => $request->semana_fin
            ]);
        } else {
            DB::table('especiales')->where('company', '=', 'default')->update([
                'semana_ini' => $request->semana_ini,
                'semana_fin' => $request->semana_fin
            ]);
        }

        return redirect()->route('especiales.index');
    }


}
