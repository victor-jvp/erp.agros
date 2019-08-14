<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PalletsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('pallets')->insert([
            'formato' => 'EURO PERDIDO',
            'modelo_id' => 1
        ]);

        DB::table('pallets')->insert([
            'formato' => 'EURO RETORNABLE',
            'modelo_id' => 1
        ]);

        DB::table('pallets')->insert([
            'formato' => 'LPR',
            'modelo_id' => 1
        ]);

        DB::table('pallets')->insert([
            'formato' => 'CHEP',
            'modelo_id' => 1
        ]);

        DB::table('pallets')->insert([
            'formato' => 'SANDWICH',
            'modelo_id' => 1
        ]);

        DB::table('pallets')->insert([
            'formato' => 'GRANDE',
            'modelo_id' => 2
        ]);

        DB::table('pallets')->insert([
            'formato' => 'PLASTICO',
            'modelo_id' => 2
        ]);

        DB::table('pallets')->insert([
            'formato' => 'ESPIGA',
            'modelo_id' => 2
        ]);
    }
}
