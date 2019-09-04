<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\ClienteContactos;
use App\ClienteDatosComerciales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            "clientes" => Cliente::with('contactos')->get()
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
    public function contactos(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if (is_null($request->contacto_id)) {
            $contacto = new ClienteContactos(array(
                'descripcion' => $request->descripcion,
                'telefono'    => $request->telefono,
                'email'       => $request->email
            ));
            $cliente->contactos()->save($contacto);
        } else {
            $contacto              = ClienteContactos::find($request->contacto_id);
            $contacto->descripcion = $request->descripcion;
            $contacto->telefono    = $request->telefono;
            $contacto->email       = $request->email;
            $contacto->save();
        }

        $request->session()->flash('tab', $request->_tab);
        $request->session()->keep(['tab']);

        return redirect()->route('clientes.show', $cliente->id);
    }

    public function delete_contacto(Request $request, $id)
    {
        $dato       = ClienteContactos::find($id);
        $cliente_id = $dato->cliente_id;
        $dato->delete();

        $request->session()->flash('tab', 'contactos');
        $request->session()->keep(['tab']);

        return redirect()->route('clientes.show', $cliente_id);
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



}
