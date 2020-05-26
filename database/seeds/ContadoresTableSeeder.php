<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContadoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('contadores')->insert([
            ['contador' => 'nro_lote', 'valor'             => 0 ],
            ['contador' => 'nro_salida', 'valor'           => 0 ],
            ['contador' => 'nro_lote_pedido', 'valor'      => 0 ],
            ['contador' => 'nro_pedido_comercial', 'valor' => 0 ],
            ['contador' => 'tz_nro_entrada', 'valor'       => 0 ],
            ['contador' => 'tz_nro_salida', 'valor'        => 0 ]
        ]);
    }
}
