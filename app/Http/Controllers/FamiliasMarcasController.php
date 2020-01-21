<?php

namespace App\Http\Controllers;

use App\Cultivo;
use App\Marca;
use App\Variedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamiliasMarcasController extends Controller
{
    public function index()
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Maestros | Acceso') || !Auth::user()->can('Maestros - Familias y Marcas | Acceso')) {
            return redirect()->route('home');
        }

        $cultivos   = Cultivo::all();
        $variedades = Variedad::all();
        $marcas     = Marca::all();
        return view('maestros.familias_marcas', array(
            'cultivos'   => $cultivos,
            'variedades' => $variedades,
            'marcas'     => $marcas
        ));
    }
}
