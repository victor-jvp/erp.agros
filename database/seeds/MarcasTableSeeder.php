<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('marcas')->insert([
            'marca' => 'PILONAR BERRIES',
            'cultivo_id' => 1
        ]);
        DB::table('marcas')->insert([
            'marca' => 'ANTONIO PILON',
            'cultivo_id' => 1
        ]);
        DB::table('marcas')->insert([
            'marca' => 'PILONAR',
            'cultivo_id' => 1
        ]);
        DB::table('marcas')->insert([
            'marca' => 'BERRIES&LOVE',
            'cultivo_id' => 1
        ]);
        DB::table('marcas')->insert([
            'marca' => 'BLUEPEARL ORGANIC',
            'cultivo_id' => 2
        ]);
        DB::table('marcas')->insert([
            'marca' => 'BLUEPEARL LUXURY BLUEBERRIES',
            'cultivo_id' => 2
        ]);
    }
}
