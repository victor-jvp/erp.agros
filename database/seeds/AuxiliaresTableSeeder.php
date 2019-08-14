<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuxiliaresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('auxiliares')->insert([
            'modelo'  => 'CANTONERAS',
        ]);
        DB::table('auxiliares')->insert([
            'modelo'  => 'FAJAS',
        ]);
        DB::table('auxiliares')->insert([
            'modelo'  => 'SEPARADORES',
        ]);
    }
}
