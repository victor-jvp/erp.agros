<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CajasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //
        DB::table('cajas')->insert([
            'formato' => '40x30x9',
            'modelo'  => 'VERDE',
            'kg'      => '1'
        ]);

        DB::table('cajas')->insert([
            'formato' => '60x40x9,5',
            'modelo'  => 'PILONAR',
            'kg'      => '1'
        ]);

        DB::table('cajas')->insert([
            'formato' => '60x40x15',
            'modelo'  => 'NEGRA',
            'kg'      => '1'
        ]);
    }
}
