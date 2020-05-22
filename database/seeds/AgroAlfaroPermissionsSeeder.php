<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AgroAlfaroPermissionsSeeder extends Seeder
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
        Permission::create(['name' => 'AgroAlfaro - Entradas | Acceso']);
        Permission::create(['name' => 'AgroAlfaro - Entradas | Crear']);
        Permission::create(['name' => 'AgroAlfaro - Entradas | Modificar']);
        Permission::create(['name' => 'AgroAlfaro - Entradas | Borrar']);

        Permission::create(['name' => 'AgroAlfaro - Salidas | Acceso']);
        Permission::create(['name' => 'AgroAlfaro - Salidas | Crear']);
        Permission::create(['name' => 'AgroAlfaro - Salidas | Modificar']);
        Permission::create(['name' => 'AgroAlfaro - Salidas | Borrar']);

        Permission::create(['name' => 'AgroAlfaro - Liquidaciones | Acceso']);
        Permission::create(['name' => 'AgroAlfaro - Liquidaciones | Crear']);
        Permission::create(['name' => 'AgroAlfaro - Liquidaciones | Modificar']);
        Permission::create(['name' => 'AgroAlfaro - Liquidaciones | Borrar']);

        Permission::create(['name' => 'AgroAlfaro - Proveedores | Acceso']);
        Permission::create(['name' => 'AgroAlfaro - Proveedores | Crear']);
        Permission::create(['name' => 'AgroAlfaro - Proveedores | Modificar']);
        Permission::create(['name' => 'AgroAlfaro - Proveedores | Borrar']);
        #endregion
    }
}
