<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\ClienteDatosComerciales;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            "clientes" => Cliente::with('datosComerciales')->get()
        );
        return view('comercial.clientes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $cliente = new Cliente();

        $cliente->razon_social = $request->razon_social;
        $cliente->cif          = $request->cif;

        $cliente->save();

        return redirect()->route('clientes.show', $cliente->id);
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data = array(
            "cliente" => Cliente::find($id),
            "tab"     => ($request->session()->get('tab')) ? $request->session()->get('tab') : "datos-fiscales",
        );

        return view('comercial.clientes.show', $data);
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
        $cliente = Cliente::find($id);

        //Tab Datos Fiscales
        if ($request->_tab == "datos-fiscales") {
            $cliente->razon_social     = $request->razon_social;
            $cliente->cif              = $request->cif;
            $cliente->nombre_comercial = $request->nombre_comercial;
            $cliente->pais             = $request->pais;
            $cliente->localidad        = $request->localidad;
            $cliente->provincia        = $request->provincia;
            $cliente->direccion        = $request->direccion;
            $cliente->telefono         = $request->telefono;
            $cliente->email            = $request->email;
            $cliente->save();
        }
        //Tab Datos Comerciales
        if ($request->_tab == "datos-comerciales") {

            if (!isset($request->datos_comerciales_id)) {
                $datosComerciales = new ClienteDatosComerciales();
            } else {
                $datosComerciales = ClienteDatosComerciales::find($request->datos_comerciales_id);
            }

            $datosComerciales->nombre    = $request->nombre;
            $datosComerciales->direccion = $request->direccion;
            $datosComerciales->telefono  = $request->telefono;
            $datosComerciales->email     = $request->email;
            $cliente->datosComerciales()->save($datosComerciales);
        }

        $request->session()->flash('tab', $request->_tab);
        $request->session()->keep(['tab']);

        return redirect()->route('clientes.show', $cliente->id);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();

        return redirect()->route('clientes.index');
    }

    public function deleteDatoComercial(Request $request, $id)
    {
        $dato = ClienteDatosComerciales::find($id);
        $cliente_id = $dato->cliente_id;
        $dato->delete();

        $request->session()->flash('tab', 'datos-comerciales');
        $request->session()->keep(['tab']);

        return redirect()->route('clientes.show', $cliente_id);
    }
}
