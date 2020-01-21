<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Configuracion | Acceso') || !Auth::user()->can('Configuracion - Roles de Usuarios | Acceso')) {
            return redirect()->route('home');
        }

        $data = array(
            'roles' => Role::all()
        );

        return view('configuracion.roles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'permisos' => Permission::all()
        );

        return view('configuracion.roles.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rol = new Role();

        $rol->name = $request->rol;
        $rol->save();

        $rol->permissions()->detach();

        if (isset($request->permisos) && count($request->permisos) > 0) {
            foreach ($request->permisos as $permiso => $p) {
                $rol->givePermissionTo($permiso);
            }
        }

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //PERMISO DE ACCESO
        if (!Auth::user()->can('Configuracion | Acceso') || !Auth::user()->can('Configuracion - Roles de Usuarios | Modificar')) {
            return redirect()->route('home');
        }

        $role     = Role::findById($id);
        $permisos = Permission::all();

        $data = array(
            'rol'      => $role,
            'permisos' => $permisos,
        );

        return view('configuracion.roles.show', $data);
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

        $rol = Role::findById($id);

        $rol->name = $request->rol;
        $rol->save();

        $rol->permissions()->detach();

        if (isset($request->permisos) && count($request->permisos) > 0) {
            foreach ($request->permisos as $permiso => $p) {
                $rol->givePermissionTo($permiso);
            }
        }

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $role = Role::findById($id);
        $role->delete();

        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function details(Request $request)
    {
        //
        $id = $request->get('id');

        $role = Role::with('permissions')->find($id);

        return response()->json($role);
    }
}
