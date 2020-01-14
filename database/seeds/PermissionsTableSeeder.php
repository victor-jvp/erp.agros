<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //
        Permission::create(['name' => 'prevision_acceso']);
        Permission::create(['name' => 'prevision_crear']);
        Permission::create(['name' => 'prevision_editar']);
        Permission::create(['name' => 'prevision_borrar']);

        Permission::create(['name' => 'comercial_acceso']);
        Permission::create(['name' => 'comercial_crear']);
        Permission::create(['name' => 'comercial_editar']);
        Permission::create(['name' => 'comercial_borrar']);

        Permission::create(['name' => 'almacen_acceso']);
        Permission::create(['name' => 'almacen_crear']);
        Permission::create(['name' => 'almacen_editar']);
        Permission::create(['name' => 'almacen_borrar']);

        Permission::create(['name' => 'dptoTecnico_acceso']);
        Permission::create(['name' => 'dptoTecnico_crear']);
        Permission::create(['name' => 'dptoTecnico_editar']);
        Permission::create(['name' => 'dptoTecnico_borrar']);

        Permission::create(['name' => 'costes_acceso']);
        Permission::create(['name' => 'costes_crear']);
        Permission::create(['name' => 'costes_editar']);
        Permission::create(['name' => 'costes_borrar']);

        Permission::create(['name' => 'maestros_acceso']);
        Permission::create(['name' => 'maestros_crear']);
        Permission::create(['name' => 'maestros_editar']);
        Permission::create(['name' => 'maestros_borrar']);

        Permission::create(['name' => 'configuracion_acceso']);
        Permission::create(['name' => 'configuracion_crear']);
        Permission::create(['name' => 'configuracion_editar']);
        Permission::create(['name' => 'configuracion_borrar']);
    }
}
