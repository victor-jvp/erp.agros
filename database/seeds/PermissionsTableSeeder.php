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

        #region Prevision
        Permission::create(['name' => 'Prevision | Acceso']);

        Permission::create(['name' => 'Prevision - Panel de Control | Acceso']);
        Permission::create(['name' => 'Prevision - Panel de Control | Crear']);
        Permission::create(['name' => 'Prevision - Panel de Control | Modificar']);
        Permission::create(['name' => 'Prevision - Panel de Control | Borrar']);

        Permission::create(['name' => 'Prevision - Pedido Campo | Acceso']);
        Permission::create(['name' => 'Prevision - Pedido Campo | Crear']);
        Permission::create(['name' => 'Prevision - Pedido Campo | Modificar']);
        Permission::create(['name' => 'Prevision - Pedido Campo | Borrar']);
        #endregion

        #region Comercial
        Permission::create(['name' => 'Comercial | Acceso']);

        Permission::create(['name' => 'Comercial - Dashboard | Acceso']);

        Permission::create(['name' => 'Comercial - Pedidos Comerciales | Acceso']);
        Permission::create(['name' => 'Comercial - Pedidos Comerciales | Crear']);
        Permission::create(['name' => 'Comercial - Pedidos Comerciales | Modificar']);
        Permission::create(['name' => 'Comercial - Pedidos Comerciales | Borrar']);

        Permission::create(['name' => 'Comercial - Clientes | Acceso']);
        Permission::create(['name' => 'Comercial - Clientes | Crear']);
        Permission::create(['name' => 'Comercial - Clientes | Modificar']);
        Permission::create(['name' => 'Comercial - Clientes | Borrar']);

        Permission::create(['name' => 'Comercial - Transportes | Acceso']);
        Permission::create(['name' => 'Comercial - Transportes | Crear']);
        Permission::create(['name' => 'Comercial - Transportes | Modificar']);
        Permission::create(['name' => 'Comercial - Transportes | Borrar']);
        #endregion

        #region Almacen
        Permission::create(['name' => 'Almacen | Acceso']);

        Permission::create(['name' => 'Almacen - Listado de Inventario | Acceso']);

        Permission::create(['name' => 'Almacen - Entrada de Productos | Acceso']);
        Permission::create(['name' => 'Almacen - Entrada de Productos | Crear']);
        Permission::create(['name' => 'Almacen - Entrada de Productos | Modificar']);
        Permission::create(['name' => 'Almacen - Entrada de Productos | Borrar']);

        Permission::create(['name' => 'Almacen - Salida de Productos | Acceso']);
        Permission::create(['name' => 'Almacen - Salida de Productos | Crear']);
        Permission::create(['name' => 'Almacen - Salida de Productos | Modificar']);
        Permission::create(['name' => 'Almacen - Salida de Productos | Borrar']);

        Permission::create(['name' => 'Almacen - Histórico | Acceso']);

        Permission::create(['name' => 'Almacen - Proveedores | Acceso']);
        Permission::create(['name' => 'Almacen - Proveedores | Crear']);
        Permission::create(['name' => 'Almacen - Proveedores | Modificar']);
        Permission::create(['name' => 'Almacen - Proveedores | Borrar']);

        Permission::create(['name' => 'Almacen - Pedidos Producción | Acceso']);
        Permission::create(['name' => 'Almacen - Pedidos Producción | Crear']);
        Permission::create(['name' => 'Almacen - Pedidos Producción | Modificar']);
        Permission::create(['name' => 'Almacen - Pedidos Producción | Borrar']);

        Permission::create(['name' => 'Almacen - Traza de Pedidos | Acceso']);
        #endregion

        #region Departamento Tecnico
        Permission::create(['name' => 'Departamento Tecnico | Acceso']);

        Permission::create(['name' => 'Departamento Tecnico - Informes | Acceso']);

        Permission::create(['name' => 'Departamento Tecnico - Panel de Control | Acceso']);
        #endregion

        #region Costes
        Permission::create(['name' => 'Costes | Acceso']);
        Permission::create(['name' => 'Costes | Crear']);
        Permission::create(['name' => 'Costes | Modificar']);
        Permission::create(['name' => 'Costes | Borrar']);
        #endregion

        #region Maestros
        Permission::create(['name' => 'Maestros | Acceso']);

        Permission::create(['name' => 'Maestros - Materiales | Acceso']);
        Permission::create(['name' => 'Maestros - Materiales | Crear']);
        Permission::create(['name' => 'Maestros - Materiales | Modificar']);
        Permission::create(['name' => 'Maestros - Materiales | Borrar']);

        Permission::create(['name' => 'Maestros - Familias y Marcas | Acceso']);
        Permission::create(['name' => 'Maestros - Familias y Marcas | Crear']);
        Permission::create(['name' => 'Maestros - Familias y Marcas | Modificar']);
        Permission::create(['name' => 'Maestros - Familias y Marcas | Borrar']);

        Permission::create(['name' => 'Maestros - Fincas | Acceso']);
        Permission::create(['name' => 'Maestros - Fincas | Crear']);
        Permission::create(['name' => 'Maestros - Fincas | Modificar']);
        Permission::create(['name' => 'Maestros - Fincas | Borrar']);

        Permission::create(['name' => 'Maestros - Productos Compuestos | Acceso']);
        Permission::create(['name' => 'Maestros - Productos Compuestos | Crear']);
        Permission::create(['name' => 'Maestros - Productos Compuestos | Modificar']);
        Permission::create(['name' => 'Maestros - Productos Compuestos | Borrar']);

        Permission::create(['name' => 'Maestros - Trazabilidad | Acceso']);
        Permission::create(['name' => 'Maestros - Trazabilidad | Crear']);
        Permission::create(['name' => 'Maestros - Trazabilidad | Modificar']);
        Permission::create(['name' => 'Maestros - Trazabilidad | Borrar']);
        #endregion

        #region Configuracion
        Permission::create(['name' => 'Configuracion | Acceso']);

        Permission::create(['name' => 'Configuracion - Datos Fiscales de la Empresa | Acceso']);

        Permission::create(['name' => 'Configuracion - Usuarios | Acceso']);
        Permission::create(['name' => 'Configuracion - Usuarios | Crear']);
        Permission::create(['name' => 'Configuracion - Usuarios | Modificar']);
        Permission::create(['name' => 'Configuracion - Usuarios | Borrar']);

        Permission::create(['name' => 'Configuracion - Roles de Usuarios | Acceso']);
        Permission::create(['name' => 'Configuracion - Roles de Usuarios | Crear']);
        Permission::create(['name' => 'Configuracion - Roles de Usuarios | Modificar']);
        Permission::create(['name' => 'Configuracion - Roles de Usuarios | Borrar']);

        Permission::create(['name' => 'Configuracion - Email | Acceso']);
        Permission::create(['name' => 'Configuracion - Email | Modificar']);

        Permission::create(['name' => 'Configuracion - Campañas | Acceso']);

        Permission::create(['name' => 'Configuracion - Especiales | Acceso']);
        #endregion
    }
}
