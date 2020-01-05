<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CubresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cubres')->insert([
            'formato'  => 'GENERICO',
        ]);
        DB::table('cubres')->insert([
            'formato'  => 'PILÓN BERRIES',
        ]);
        DB::table('cubres')->insert([
            'formato'  => 'REWE',
        ]);
        DB::table('cubres')->insert([
            'formato'  => 'PENNY',
        ]);
        DB::table('cubres')->insert([
            'formato'  => 'DOÑAROSA',
        ]);
    }
}
