<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //
        DB::table('modulos')->insert([
            ['name' => 'Prevision'],
            ['name' => 'Comercial'],
            ['name' => 'Almacen'],
            ['name' => 'Costes']
        ]);

        DB::table('modulos_secciones')->insert([
            [
                'name'      => 'Panel de Control',
                'modulo_id' => 1,
                'url'       => 'prevision'
            ],
            [
                'name'      => 'Pedido Campo',
                'modulo_id' => 1,
                'url'       => 'pedidos-campo'
            ],
            [
                'name'      => 'Dashboard',
                'modulo_id' => 2,
                'url'       => 'comercial/dashboard'
            ],
            [
                'name'      => 'Pedidos Comerciales',
                'modulo_id' => 2,
                'url'       => 'comercial/pedidos-comercial'
            ],
            [
                'name'      => 'Clientes',
                'modulo_id' => 2,
                'url'       => 'comercial/clientes'
            ],
            [
                'name'      => 'Transportes',
                'modulo_id' => 2,
                'url'       => 'comercial/transportes'
            ],
            [
                'name'      => 'Listado de Inventario',
                'modulo_id' => 3,
                'url'       => 'almacen/listado-inventario'
            ],
            [
                'name'      => 'Entrada de Productos',
                'modulo_id' => 3,
                'url'       => 'almacen/entrada-productos'
            ],
            [
                'name'      => 'Salida de Productos',
                'modulo_id' => 3,
                'url'       => 'almacen/salida-productos'
            ],
            [
                'name'      => 'Historico',
                'modulo_id' => 3,
                'url'       => 'almacen/historico-entradas'
            ],
            [
                'name'      => 'Proveedores',
                'modulo_id' => 3,
                'url'       => 'almacen/proveedores'
            ],
            [
                'name'      => 'Pedidos Produccion',
                'modulo_id' => 3,
                'url'       => 'almacen/pedidos-produccion'
            ],
            [
                'name'      => 'Traza de Pedidos',
                'modulo_id' => 3,
                'url'       => 'almacen/traza-pedidos'
            ],
            [
                'name'      => 'Costes',
                'modulo_id' => 4,
                'url'       => 'costes'
            ]
        ]);
    }
}
