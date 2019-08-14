<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TarrinasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tarrinas')->insert([
            'modelo'  => 'K37',
        ]);

        DB::table('tarrinas')->insert([
            'modelo'  => 'TR80',
        ]);
    }
}
