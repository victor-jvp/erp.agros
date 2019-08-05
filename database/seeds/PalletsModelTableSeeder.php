<?php

use Illuminate\Database\Seeder;

class PalletsModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('pallets_table')->insert([
            'modelo' => 'Euro Pallet',
        ], [
            'modelo' => 'Grande'
        ]);
    }
}
