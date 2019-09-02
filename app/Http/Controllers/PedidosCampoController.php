<?php

namespace App\Http\Controllers;

use App\Finca;
use Illuminate\Http\Request;

class PedidosCampoController extends Controller
{
    public function index()
    {
        $fincas = Finca::all();

        $data = array(
            "fincas" => $fincas
        );
        return view('prevision.campo', $data);
    }
}
