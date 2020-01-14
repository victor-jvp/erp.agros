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
        Permission::create(['name' => 'Prevision Acceso']);
        Permission::create(['name' => 'Prevision Crear']);
        Permission::create(['name' => 'Prevision Modificar']);
        Permission::create(['name' => 'Prevision Borrar']);

        Permission::create(['name' => 'Comercial Acceso']);
        Permission::create(['name' => 'Comercial Crear']);
        Permission::create(['name' => 'Comercial Modificar']);
        Permission::create(['name' => 'Comercial Borrar']);

        Permission::create(['name' => 'Almacen Acceso']);
        Permission::create(['name' => 'Almacen Crear']);
        Permission::create(['name' => 'Almacen Modificar']);
        Permission::create(['name' => 'Almacen Borrar']);

        Permission::create(['name' => 'Departamento Tecnico Acceso']);
        Permission::create(['name' => 'Departamento Tecnico Crear']);
        Permission::create(['name' => 'Departamento Tecnico Modificar']);
        Permission::create(['name' => 'Departamento Tecnico Borrar']);

        Permission::create(['name' => 'Costes Acceso']);
        Permission::create(['name' => 'Costes Crear']);
        Permission::create(['name' => 'Costes Modificar']);
        Permission::create(['name' => 'Costes Borrar']);

        Permission::create(['name' => 'Maestros Acceso']);
        Permission::create(['name' => 'Maestros Crear']);
        Permission::create(['name' => 'Maestros Modificar']);
        Permission::create(['name' => 'Maestros Borrar']);

        Permission::create(['name' => 'Configuracion Acceso']);
    }
}
