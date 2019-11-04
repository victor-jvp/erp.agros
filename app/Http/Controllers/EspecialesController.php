<?php

namespace App\Http\Controllers;

use App\Especiales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EspecialesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $especiales = Especiales::all()->first();
        if (is_null($especiales)) $especiales = new Especiales();
        $data['especiales'] = $especiales;
        return view('maestros.especiales')->with($data);
    }

    public function semanas(Request $request)
    {
        $especiales = DB::table('especiales')->count();
        if ($especiales == 0) {
            DB::table('especiales')->insert([
                'semana_ini' => $request->semana_ini,
                'semana_fin' => $request->semana_fin
            ]);
        } else {
            DB::table('especiales')->where('company', '=', 'default')->update([
                'semana_ini' => $request->semana_ini,
                'semana_fin' => $request->semana_fin
            ]);
        }

        return redirect()->route('especiales.index');
    }

    public function email(Request $request)
    {
        $especiales = DB::table('especiales')->count();
        if ($especiales == 0) {
            DB::table('especiales')->insert([
                'mail_driver'   => $request->mail_driver,
                'mail_host'     => $request->mail_host,
                'mail_port'     => $request->mail_port,
                'mail_username' => $request->mail_username,
                'mail_password' => Hash::make($request->mail_password)
            ]);
        } else {
            DB::table('especiales')->where('company', '=', 'default')->update([
                'mail_driver'   => $request->mail_driver,
                'mail_host'     => $request->mail_host,
                'mail_port'     => $request->mail_port,
                'mail_username' => $request->mail_username,
                'mail_password' => Hash::make($request->mail_password)
            ]);
        }

        return redirect()->route('especiales.index');
    }
}
