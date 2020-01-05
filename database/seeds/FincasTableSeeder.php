<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FincasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('fincas')->insert([
            'finca' => 'PALOMERAS'
        ]);
        DB::table('fincas')->insert([
            'finca' => 'BETANZOS'
        ]);
    }
}
