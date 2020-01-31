<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //
        $data = [
            ['name' => '1era.'],
            ['name' => '1era. B'],
            ['name' => '2da.'],
            ['name' => 'Industria'],
        ];

        DB::table('categorias')->insert($data);
    }
}
