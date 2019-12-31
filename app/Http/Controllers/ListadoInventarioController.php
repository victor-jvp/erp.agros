<?php

namespace App\Http\Controllers;

use App\Auxiliar;
use App\Caja;
use App\Cubre;
use App\Inventario;
use App\Pallet;
use App\Tarrina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;

class ListadoInventarioController extends Controller
{
    public function index()
    {
        $data['inventario'] = Inventario::Stock();

        return view('almacen.inventario', $data);
    }
}
