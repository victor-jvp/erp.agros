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
        Permission::create(['name' => 'crear']);
        Permission::create(['name' => 'editar']);
        Permission::create(['name' => 'borrar']);
    }
}
