<?php

namespace App\Http\Controllers;

use App\Cliente;
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
            "clientes" => Cliente::all()
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
    public function show($id)
    {
        $data = array(
            "cliente" => Cliente::find($id)
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
}
