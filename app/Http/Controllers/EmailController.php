<?php

namespace App\Http\Controllers;

use App\ConfigEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmailController extends Controller
{
    //

    public function index()
    {
        $email = ConfigEmail::first();

        if (is_null($email)) {
            $email = new ConfigEmail();
        }

        $data['config'] = $email;

        return view('configuracion.email.index')->with($data);
    }

    public function store(Request $request)
    {

//        dd($request);
        $email = ConfigEmail::first();
        if (is_null($email)) {
            $email = new ConfigEmail();
            $email->mail_driver   = $request->mail_driver;
            $email->mail_host     = $request->mail_host;
            $email->mail_port     = $request->mail_port;
            $email->mail_username = $request->mail_username;
            $email->mail_password = Hash::make($request->mail_password);

            $email->save();
        }
        else {
            $email->mail_driver   = $request->mail_driver;
            $email->mail_host     = $request->mail_host;
            $email->mail_port     = $request->mail_port;
            $email->mail_username = $request->mail_username;
            $email->mail_password = Hash::make($request->mail_password);

            $email->save();
        }

        return redirect()->route('email.index');
    }
}
