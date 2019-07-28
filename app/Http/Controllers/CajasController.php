<?php

namespace App\Http\Controllers;

use DemeterChain\C;
use Illuminate\Http\Request;
use App\Caja;

class CajasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $caja = new Caja;

        $caja->formato = $request->formato;
        $caja->modelo  = $request->modelo;
        $caja->kg      = $request->kg;
        $caja->save();

        return redirect()->route('materiales');
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //

        $caja          = Caja::find($request->id);
        $caja->formato = $request->formato;
        $caja->modelo  = $request->modelo;
        $caja->kg      = $request->kg;
        $caja->save();

        return redirect()->route('materiales');
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

    public function delete($id)
    {
        $caja = Caja::find($id);
        $caja->delete();

        return redirect()->route('materiales');
    }
}
