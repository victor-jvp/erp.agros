<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
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
    public function create()
    {
        //
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
    public function show($id)
    {
        $proveedor = Proveedor::find($id);

        $data = array(
            'proveedor' => $proveedor
        );

        return view('almacen.proveedores.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $data = array(
            'proveedor' => $proveedor
        );

        return view('almacen.proveedores.edit', $data);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
