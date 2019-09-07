<?php

namespace App\Http\Controllers;

use App\Proveedor;
use App\ProveedorContactos;
use App\Mail\SendMail;
use App\ProveedorAdjunto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


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
        $proveedor = Proveedor::find($id);

        $adjunto = new ProveedorAdjunto();

        $adjunto->tipo        = $request->file('file')->getClientOriginalExtension();
        $adjunto->file        = $request->file('file')->store('uploads/proveedores');
        $adjunto->descripcion = $request->descripcion;
        $adjunto->fecha       = $request->fecha;

        $request->file('file')->move('uploads/proveedores', $adjunto->file);

        $proveedor->adjuntos()->save($adjunto);

        $request->session()->flash('tab', $request->_tab);
        $request->session()->keep(['tab']);

        return redirect()->route('proveedores.show', $proveedor->id);
    }


    public function delete_adjunto(Request $request, $id)
    {
        $dato         = ProveedorAdjunto::find($id);
        $proveedor_id = $dato->proveedor_id;
        unlink(public_path() . "/" . $dato->file);
        $dato->delete();

        $request->session()->flash('tab', 'documentacion');
        $request->session()->keep(['tab']);

        return redirect()->route('proveedores.show', $proveedor_id);
    }

    public function contactos(Request $request, $id)
    {
        $proveedor = Proveedor::find($id);

        if (is_null($request->contacto_id)) {
            $contacto = new ProveedorContactos(array(
                'descripcion' => $request->descripcion,
                'telefono'    => $request->telefono,
                'email'       => $request->email
            ));
            $proveedor->contactos()->save($contacto);
        } else {
            $contacto              = ProveedorContactos::find($request->contacto_id);
            $contacto->descripcion = $request->descripcion;
            $contacto->telefono    = $request->telefono;
            $contacto->email       = $request->email;
            $contacto->save();
        }

        $request->session()->flash('tab', $request->_tab);
        $request->session()->keep(['tab']);

        return redirect()->route('proveedores.show', $proveedor->id);
    }

    public function delete_contacto(Request $request, $id)
    {
        $dato         = ProveedorContactos::find($id);
        $proveedor_id = $dato->proveedor_id;
        $dato->delete();

        $request->session()->flash('tab', 'contactos');
        $request->session()->keep(['tab']);

        return redirect()->route('proveedores.show', $proveedor_id);
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
            "tab"       => ($request->session()->get('tab')) ? $request->session()->get('tab') : "datos-fiscales",
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
            'id' => $proveedor->id,
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
        $dato         = ProveedorDatosComerciales::find($id);
        $proveedor_id = $dato->proveedor_id;
        $dato->delete();

        $request->session()->flash('tab', 'datos-comerciales');
        $request->session()->keep(['tab']);

        return redirect()->route('proveedores.show', $proveedor_id);
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
