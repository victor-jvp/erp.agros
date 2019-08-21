<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use App\ProveedorDatosComerciales;
use Illuminate\Auth\Passwords\PasswordResetServiceProvider;
use Symfony\Component\Finder\Finder;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $proveedores = Proveedor::all();
        return view('almacen.proveedores.index', ['proveedores' => $proveedores]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function adjuntos(Request $request, $id)
    {
        dd($request);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedor = new Proveedor();

        $proveedor->cif          = $request->cif;
        $proveedor->razon_social = $request->razon_social;

        $proveedor->save();

        return redirect()->route('proveedores.show', $proveedor->id);
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $proveedor = Proveedor::with('entradas')->find($id);

        $data = array(
            'proveedor' => $proveedor,
            "tab"     => ($request->session()->get('tab')) ? $request->session()->get('tab') : "datos-fiscales",
        );

        return view('almacen.proveedores.show', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $proveedor = Proveedor::find($request->id);

        //Datos Fiscales
        if ($request->_tab == "datos-fiscales") {
            $proveedor->cif              = $request->cif;
            $proveedor->razon_social     = $request->razon_social;
            $proveedor->nombre_comercial = $request->nombre_comercial;
            $proveedor->pais             = $request->pais;
            $proveedor->localidad        = $request->localidad;
            $proveedor->provincia        = $request->provincia;
            $proveedor->direccion        = $request->direccion;
            $proveedor->telefono         = $request->telefono;
            $proveedor->email            = $request->email;

            $proveedor->save();
        }

        $data = array(
            'id'  => $proveedor->id,
        );

        $request->session()->flash('tab', $request->_tab);
        $request->session()->keep(['tab']);

        return redirect()->route('proveedores.show', $data);
    }

    public function delete($id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->delete();

        return redirect()->route('proveedores.index');
    }

    public function deleteDatoComercial(Request $request, $id)
    {
        $dato = ProveedorDatosComerciales::find($id);
        $proveedor_id = $dato->proveedor_id;
        $dato->delete();

        $request->session()->flash('tab', 'datos-comerciales');
        $request->session()->keep(['tab']);

        return redirect()->route('proveedores.show', $proveedor_id);
    }
}
