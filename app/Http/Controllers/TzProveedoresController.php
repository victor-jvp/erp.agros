<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TzProveedor;

class TzProveedoresController extends Controller
{
    public function index(Request $request)
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('AgroAlfaro - Proveedores | Acceso')) {
            return redirect()->route('home');
        }

        $data = array(
            "proveedores" => TzProveedor::all(),
        );

        return view('agroAlfaro.proveedores.index', $data);
    }

    public function create(Request $request)
    {
        //dd($request);
        $proveedor = new TzProveedor();

        $proveedor->proveedor   = $request->proveedor;
        $proveedor->cif       = $request->cif;
        $proveedor->domicilio = $request->domicilio;
        $proveedor->poblacion = $request->poblacion;

        $proveedor->save();

        return redirect()->route('tz.proveedores.index');
    }

    public function show($id)
    {

        //PERMISO DE ACCESO
        if (!Auth::user()->can('AgroAlfaro - Proveedores | Acceso') || !Auth::user()->can('AgroAlfaro - Proveedores | Modificar')) {
            return redirect()->route('home');
        }

        $data['proveedor'] = TzProveedor::find($id);

        return view('agroAlfaro.proveedores.show', $data);
    }

    public function update(Request $request, $id)
    {
        $proveedor = TzProveedor::find($id);

        $proveedor->proveedor   = $request->proveedor;
        $proveedor->cif       = $request->cif;
        $proveedor->domicilio = $request->domicilio;
        $proveedor->poblacion = $request->poblacion;

        $proveedor->save();

        return redirect()->route('tz.proveedores.show', $proveedor->id);
    }

    public function delete($id)
    {
        $proveedor = TzProveedor::find($id);
        $proveedor->delete();

        return redirect()->route('tz.proveedores.index');
    }
}
