<?php

use Illuminate\Database\Seeder;

class CatDiasSemanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cat_dias_semana')->insert([
            'dia' => 'Miércoles',
            'letra'  => 'X',
            'order'      => 0,
            'valor' => 3
        ]);
        DB::table('cat_dias_semana')->insert([
            'dia' => 'Jueves',
            'letra'  => 'J',
            'order'      => 1,
            'valor' => 4
        ]);
        DB::table('cat_dias_semana')->insert([
            'dia' => 'Viernes',
            'letra'  => 'V',
            'order'      => 2,
            'valor' => 5
        ]);
        DB::table('cat_dias_semana')->insert([
            'dia' => 'Sábado',
            'letra'  => 'S',
            'order'      => 3,
            'valor' => 6
        ]);
        DB::table('cat_dias_semana')->insert([
            'dia' => 'Domingo',
            'letra'  => 'D',
            'order'      => 4,
            'valor' => 7
        ]);
        DB::table('cat_dias_semana')->insert([
            'dia' => 'Lunes',
            'letra'  => 'L',
            'order'      => 5,
            'valor' => 1
        ]);
        DB::table('cat_dias_semana')->insert([
            'dia' => 'Martes',
            'letra'  => 'M',
            'order'      => 6,
            'valor' => 2
        ]);
    }
}
