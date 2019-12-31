<?php

namespace App\Http\Controllers;

use App\DatosFiscales;
use Illuminate\Http\Request;

class DatosFiscalesController extends Controller
{
    //
    public function show()
    {
        $data    = array();
        $empresa = DatosFiscales::first();

        if (is_null($empresa)) {
            $empresa = new DatosFiscales();
        }

        $data['empresa'] = $empresa;
        return view('configuracion.datos-fiscales.index', $data);
    }

    public function update(Request $request)
    {
        if(DatosFiscales::count() > 0){
            DatosFiscales::truncate();
        }
        $empresa                   = new DatosFiscales();
        $empresa->cif              = $request->cif;
        $empresa->razon_social     = $request->razon_social;
        $empresa->nombre_comercial = $request->nombre_comercial;
        $empresa->direccion        = $request->direccion;
        $empresa->telefono         = $request->telefono;
        $empresa->email            = $request->email;

//        dd($request->file('file'));

        if (!is_null($request->file('file'))) {
            $request->file('file')->move('assets/images', 'logo_emp.'. strtolower($request->file('file')->getClientOriginalExtension()));
        }

        $empresa->save();

        return redirect()->route('datos-fiscales.show');
    }
}
