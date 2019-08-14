<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosCompuestos_detTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //
        DB::table('productoscompuestos_det')->insert([
            'compuesto_id'  => 1,
            'variable'      => "Probando guardado",
            "caja_id"       => 1,
            "euro_cantidad" => "321",
            "euro_kg"       => "312123",
            "euro_pallet_id" => 2,
            "grand_cantidad" => 123,
            "grand_kg" => 123321,
            "grand_pallet_id" => 1,
            "cantoneras" => "Cantoneras",
            "cubre_id" => 1,
            "cubre_cantidad" => 200
        ]);
    }
}
