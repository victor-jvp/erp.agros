<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class TrazabilidadPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        #region Trazabilidad AgroAlfa
        Permission::create(['name' => 'Trazabilidad - Entradas | Acceso']);
        Permission::create(['name' => 'Trazabilidad - Entradas | Crear']);
        Permission::create(['name' => 'Trazabilidad - Entradas | Modificar']);
        Permission::create(['name' => 'Trazabilidad - Entradas | Borrar']);

        Permission::create(['name' => 'Trazabilidad - Salidas | Acceso']);
        Permission::create(['name' => 'Trazabilidad - Salidas | Crear']);
        Permission::create(['name' => 'Trazabilidad - Salidas | Modificar']);
        Permission::create(['name' => 'Trazabilidad - Salidas | Borrar']);

        Permission::create(['name' => 'Trazabilidad - Liquidaciones | Acceso']);
        Permission::create(['name' => 'Trazabilidad - Liquidaciones | Crear']);
        Permission::create(['name' => 'Trazabilidad - Liquidaciones | Modificar']);
        Permission::create(['name' => 'Trazabilidad - Liquidaciones | Borrar']);

        Permission::create(['name' => 'Trazabilidad - Proveedores | Acceso']);
        Permission::create(['name' => 'Trazabilidad - Proveedores | Crear']);
        Permission::create(['name' => 'Trazabilidad - Proveedores | Modificar']);
        Permission::create(['name' => 'Trazabilidad - Proveedores | Borrar']);

        Permission::create(['name' => 'Trazabilidad - Clientes | Acceso']);
        Permission::create(['name' => 'Trazabilidad - Clientes | Crear']);
        Permission::create(['name' => 'Trazabilidad - Clientes | Modificar']);
        Permission::create(['name' => 'Trazabilidad - Clientes | Borrar']);

        Permission::create(['name' => 'Trazabilidad - Artículos | Acceso']);
        Permission::create(['name' => 'Trazabilidad - Artículos | Crear']);
        Permission::create(['name' => 'Trazabilidad - Artículos | Modificar']);
        Permission::create(['name' => 'Trazabilidad - Artículos | Borrar']);
        #endregion
    }
}
