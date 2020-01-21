<?php

namespace App\Http\Controllers;

use App\Transporte;
use App\TransporteAdjunto;
use App\TransporteContacto;
use Illuminate\Http\Request;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TransporteController extends Controller
{
    //

    public function index()
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Comercial | Acceso') || !Auth::user()->can('Comercial - Transportes | Acceso')) {
            return redirect()->route('home');
        }

        $transportes = Transporte::all();
        return view('comercial.transportes.index', ['transportes' => $transportes]);
    }

    public function store(Request $request)
    {
        $transporte = new Transporte();

        $transporte->cif          = $request->cif;
        $transporte->razon_social = $request->razon_social;
        $transporte->save();

        return redirect()->route('transportes.show', $transporte->id);
    }

    public function show(Request $request, $id)
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Comercial | Acceso') || !Auth::user()->can('Comercial - Transportes | Modificar')) {
            return redirect()->route('home');
        }

        $transporte = Transporte::with([
            'pedidos' => function($p){
                $p->where("estado_id", "=", 3);
            }
        ])->find($id);

        $data = array(
            'transporte' => $transporte,
            "tab"        => ($request->session()->get('tab')) ? $request->session()->get('tab') : "datos-fiscales",
        );

        return view('comercial.transportes.show', $data);
    }

    public function update(Request $request, $id)
    {
        //

        $transporte = Transporte::find($request->id);

        //Datos Fiscales
        if ($request->_tab == "datos-fiscales") {
            $transporte->cif              = $request->cif;
            $transporte->razon_social     = $request->razon_social;
            $transporte->nombre_comercial = $request->nombre_comercial;
            $transporte->pais             = $request->pais;
            $transporte->localidad        = $request->localidad;
            $transporte->provincia        = $request->provincia;
            $transporte->direccion        = $request->direccion;
            $transporte->telefono         = $request->telefono;
            $transporte->email            = $request->email;

            $transporte->save();
        }

        $data = array(
            'id' => $transporte->id,
        );

        $request->session()->flash('tab', $request->_tab);
        $request->session()->keep(['tab']);

        return redirect()->route('transportes.show', $data);
    }

    public function delete($id)
    {
        $transporte = Transporte::find($id);
        $transporte->delete();

        return redirect()->route('transportes.index');
    }


    public function adjuntos(Request $request, $id)
    {
        $transporte = Transporte::find($id);

        $adjunto = new TransporteAdjunto();

        $adjunto->tipo        = $request->file('file')->getClientOriginalExtension();
        $adjunto->file        = $request->file('file')->store('uploads/proveedores');
        $adjunto->descripcion = $request->descripcion;
        $adjunto->fecha       = $request->fecha;

        $request->file('file')->move('uploads/proveedores', $adjunto->file);

        $transporte->adjuntos()->save($adjunto);

        $request->session()->flash('tab', $request->_tab);
        $request->session()->keep(['tab']);

        return redirect()->route('transportes.show', $transporte->id);
    }


    public function delete_adjunto(Request $request, $id)
    {
        $dato          = TransporteAdjunto::find($id);
        $transporte_id = $dato->transporte_id;
        unlink(public_path() . "/" . $dato->file);
        $dato->delete();

        $request->session()->flash('tab', 'documentacion');
        $request->session()->keep(['tab']);

        return redirect()->route('transportes.show', $transporte_id);
    }

    public function contactos(Request $request, $id)
    {
        $transporte = Transporte::find($id);

        if (is_null($request->contacto_id)) {
            $contacto = new TransporteContacto(array(
                'descripcion' => $request->descripcion,
                'telefono'    => $request->telefono,
                'email'       => $request->email
            ));
            $transporte->contactos()->save($contacto);
        } else {
            $contacto              = TransporteContacto::find($request->contacto_id);
            $contacto->descripcion = $request->descripcion;
            $contacto->telefono    = $request->telefono;
            $contacto->email       = $request->email;
            $contacto->save();
        }

        $request->session()->flash('tab', $request->_tab);
        $request->session()->keep(['tab']);

        return redirect()->route('transportes.show', $transporte->id);
    }

    public function delete_contacto(Request $request, $id)
    {
        $dato          = TransporteContacto::find($id);
        $transporte_id = $dato->transporte_id;
        $dato->delete();

        $request->session()->flash('tab', 'contactos');
        $request->session()->keep(['tab']);

        return redirect()->route('transportes.show', $transporte_id);
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

    public function ajaxGetTransporte(Request $request)
    {
        $data = array();
        $data = Transporte::all();

        return response()->json($data);
    }
}
