<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\ClienteContactos;
use App\ClienteAdjunto;
use App\ClienteDatosComerciales;
use App\ClienteDestinos;
use App\Mail\SendMail;
use App\Pallet;
use App\PedidoComercialCatCancelado;
use App\PedidoComercialEstado;
use App\ProductoCompuesto_det;
use App\Transporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ClientesController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Comercial | Acceso') || !Auth::user()->can('Comercial - Clientes | Acceso')) {
            return redirect()->route('home');
        }

        $data = array(
            "clientes" => Cliente::with('contactos')->with('destinos')->get()
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
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Comercial | Acceso') || !Auth::user()->can('Comercial - Clientes | Modificar')) {
            return redirect()->route('home');
        }

        $cliente = Cliente::with([
            'contactos',
            'adjuntos',
            'destinos',
            'pedidos.variable.compuesto.cultivo',
            'pedidos.palet.modelo',
            'pedidos.destino',
            'pedidos.transporte',
        ])->find($id);

        //dd($cliente);

        $data = array(
            "cliente"            => $cliente,
            "tab"                => ($request->session()->get('tab')) ? $request->session()->get('tab') : "datos-fiscales",
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

    public function destinos(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if (is_null($request->destino_id)) {
            $destino = new ClienteDestinos(array(
                'descripcion' => $request->descripcion,
                'direccion'   => $request->direccion,
                'poblacion'   => $request->poblacion,
                'ciudad'      => $request->ciudad,
                'pais'        => $request->pais,
            ));
            $cliente->destinos()->save($destino);
        } else {
            $destino              = ClienteDestinos::find($request->destino_id);
            $destino->descripcion = $request->descripcion;
            $destino->direccion   = $request->direccion;
            $destino->poblacion   = $request->poblacion;
            $destino->ciudad      = $request->ciudad;
            $destino->pais        = $request->pais;
            $destino->save();
        }

        $request->session()->flash('tab', $request->_tab);
        $request->session()->keep(['tab']);

        return redirect()->route('clientes.show', $cliente->id);
    }

    public function adjuntos(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        $adjunto = new ClienteAdjunto();

        $adjunto->tipo        = $request->file('file')->getClientOriginalExtension();
        $adjunto->file        = $request->file('file')->store('uploads/clientes');
        $adjunto->descripcion = $request->descripcion;
        $adjunto->fecha       = $request->fecha;

        $request->file('file')->move('uploads/clientes', $adjunto->file);

        $cliente->adjuntos()->save($adjunto);

        $request->session()->flash('tab', $request->_tab);
        $request->session()->keep(['tab']);

        return redirect()->route('clientes.show', $cliente->id);
    }


    public function delete_adjunto(Request $request, $id)
    {
        $dato       = ClienteAdjunto::find($id);
        $cliente_id = $dato->cliente_id;
        unlink(public_path() . "/" . $dato->file);
        $dato->delete();

        $request->session()->flash('tab', 'documentacion');
        $request->session()->keep(['tab']);

        return redirect()->route('proveedores.show', $cliente_id);
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

    public function delete_destino(Request $request, $id)
    {
        $dato       = ClienteDestinos::find($id);
        $cliente_id = $dato->cliente_id;
        $dato->delete();

        $request->session()->flash('tab', 'destinos');
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

    public function ajaxSendEmail(Request $request)
    {
        $email   = $request->input('email');
        $message = $request->input('message');

        if (is_null($email)) return response()->json(null);

        $data     = array(
            "email"   => $email,
            "message" => $message
        );
        $sendMail = new SendMail($data);
        Mail::to($email)->send($sendMail);

        $response = array();

        // check for failures
        if (Mail::failures()) {
            $response = array(
                "title"   => "Aviso",
                "message" => "Error al enviar email. Intente nuevamente",
                "type"    => "error"
            );
        } else {
            $response = array(
                "title"   => "Éxito",
                "message" => "Email enviado con éxito",
                "type"    => "success"
            );
        }

        return response()->json($response);
    }
}
