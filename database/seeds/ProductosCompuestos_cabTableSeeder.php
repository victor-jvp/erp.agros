<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosCompuestos_cabTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //
        DB::table('productoscompuestos_cab')->insert([
            "fecha"     => Date('Y-m-d'),
            'compuesto' => '10x500',
        ]);
        DB::table('productoscompuestos_cab')->insert([
            "fecha"     => Date('Y-m-d'),
            'compuesto' => '10x500 FLOWPACK',
        ]);
    }
}
