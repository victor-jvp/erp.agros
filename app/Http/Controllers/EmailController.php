<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmailController extends Controller
{
    //

    public function index()
    {
        return view('configuracion.email.index');
    }

    public function store(Request $request)
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
