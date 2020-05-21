<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TzArticulo;

class TzArticulosController extends Controller
{
    public function index(Request $request)
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Trazabilidad - Artículos | Acceso')) {
            return redirect()->route('home');
        }

        $data = array(
            "articulos" => TzArticulo::all(),
        );

        return view('trazabilidad.articulos.index', $data);
    }

    public function create(Request $request)
    {
        //dd($request);
        $articulo = new TzArticulo();

        $articulo->articulo = $request->articulo;

        $articulo->save();

        return redirect()->route('tz.articulos.index');
    }

    public function show($id)
    {

        //PERMISO DE ACCESO
        if (!Auth::user()->can('Trazabilidad - Artículos | Acceso') || !Auth::user()->can('Trazabilidad - Artículos | Modificar')) {
            return redirect()->route('home');
        }

        $data['articulo'] = TzArticulo::find($id);

        return view('trazabilidad.articulos.show', $data);
    }

    public function update(Request $request, $id)
    {
        $articulo = TzArticulo::find($id);

        $articulo->articulo = $request->articulo;

        $articulo->save();

        return redirect()->route('tz.articulos.show', $articulo->id);
    }

    public function delete($id)
    {
        $articulo = TzArticulo::find($id);
        $articulo->delete();

        return redirect()->route('tz.articulos.index');
    }
}
