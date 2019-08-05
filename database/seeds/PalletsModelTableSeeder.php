<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PalletsModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('pallets_models')->insert([
            'modelo' => 'Euro Pallet',
        ]);

        DB::table('pallets_models')->insert([
            'modelo' => 'Pallet Grande',
        ]);
    }
}
