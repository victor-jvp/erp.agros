<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComercialController extends Controller
{
    //
    public function dashboard(Request $request)
    {
        return view('comercial.dashboard.index');
    }
}
