<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        //PERMISO DE ACCESO
        if (!Auth::user()->can('Configuracion | Acceso') || !Auth::user()->can('Configuracion - Usuarios | Acceso')) {
            return redirect()->route('home');
        }

        $data = array();

        $usuarios = User::all();

        $data['usuarios'] = $usuarios;

        return view('configuracion.usuarios.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['roles'] = Role::all();

        return view('configuracion.usuarios.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new User();

        $usuario->name      = $request->name;
        $usuario->email     = $request->email;
        $usuario->cargo     = $request->cargo;
        $usuario->telefono1 = $request->telefono1;
        $usuario->telefono2 = $request->telefono2;
        $usuario->password  = Hash::make($request->password);

        if (isset($request->roles))
        {
            foreach ($request->roles as $r => $rol) {
                $usuario->assignRole($rol);
            }
        }

        $usuario->save();

        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Configuracion | Acceso') || !Auth::user()->can('Configuracion - Usuarios | Modificar')) {
            return redirect()->route('home');
        }

        $data['usuario'] = User::with('roles')->find($id);
        $data['roles']   = Role::all();

        return view('configuracion.usuarios.show')->with($data);
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
        $usuario = User::find($id);

        $usuario->name      = $request->name;
        $usuario->email     = $request->email;
        $usuario->cargo     = $request->cargo;
        $usuario->telefono1 = $request->telefono1;
        $usuario->telefono2 = $request->telefono2;

        if ($request->password != "") {
            $usuario->password = Hash::make($request->password);
        }


        $usuario->syncRoles($request->roles);
        // foreach ($request->roles as $r => $rol) {
        //     $usuario->assignRole($rol);
        // }

        $usuario->save();

        return redirect()->route('usuarios.index');
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

    /**
    * Display the specified resource.
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function perfil($id)
    {
        //

        $data['usuario'] = User::with('roles')->find($id);
        $data['roles']   = Role::all();

        return view('configuracion.usuarios.perfil')->with($data);
    }

    public function update_perfil(Request $request, $id)
    {
        //
        $usuario = User::find($id);

        $usuario->name      = $request->name;
        $usuario->email     = $request->email;
        $usuario->cargo     = $request->cargo;
        $usuario->telefono1 = $request->telefono1;
        $usuario->telefono2 = $request->telefono2;

        if ($request->password != "") {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return back();
    }
}
