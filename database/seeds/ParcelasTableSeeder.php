<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParcelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('parcelas')->insert([
            'parcela' => 'P1',
            'finca_id' => 1
        ]);

        DB::table('parcelas')->insert([
            'parcela' => 'P2',
            'finca_id' => 1
        ]);

        DB::table('parcelas')->insert([
            'parcela' => 'P3',
            'finca_id' => 1
        ]);

        DB::table('parcelas')->insert([
            'parcela' => 'P1',
            'finca_id' => 2
        ]);

        DB::table('parcelas')->insert([
            'parcela' => 'P2',
            'finca_id' => 2
        ]);

        DB::table('parcelas')->insert([
            'parcela' => 'P3',
            'finca_id' => 2
        ]);

    }
}
