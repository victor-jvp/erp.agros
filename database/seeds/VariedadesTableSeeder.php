<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariedadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('variedades')->insert([
            'variedad' => 'FORTUNA',
            'cultivo_id' => 1
        ]);
        DB::table('variedades')->insert([
            'variedad' => 'ROCIERA',
            'cultivo_id' => 1
        ]);
        DB::table('variedades')->insert([
            'variedad' => 'CALINDA',
            'cultivo_id' => 1
        ]);
        DB::table('variedades')->insert([
            'variedad' => 'STAR',
            'cultivo_id' => 2
        ]);
        DB::table('variedades')->insert([
            'variedad' => 'VENTURA',
            'cultivo_id' => 2
        ]);
    }
}
