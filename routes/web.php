<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'HomeController@index')->name('home');

#region Prevision

    Route::resource('prevision', 'PrevisionController');
    Route::post('prevision/loadParcelaByFinca', 'PrevisionController@loadParcelaByFinca')->name('prevision.loadParcelaByFinca');
    Route::post('prevision/LoadTrazaByParcela', 'PrevisionController@LoadTrazaByParcela')->name('prevision.LoadTrazaByParcela');
    Route::post('prevision/GetPrevision', 'PrevisionController@GetPrevision')->name('prevision.GetPrevision');
    Route::post('prevision/DeletePrevision', 'PrevisionController@DeletePrevision')->name('prevision.DeletePrevision');
    Route::post('prevision/comentario', 'PrevisionController@SaveComentario')->name('prevision.SaveComentario');

    Route::resource('pedidos-campo', 'PedidosCampoController');
    Route::post('pedidos-campo/loadParcelaByFinca', 'PedidosCampoController@loadParcelaByFinca')->name('pedidos-campo.loadParcelaByFinca');
    Route::post('pedidos-campo/GetPedido', 'PedidosCampoController@GetPedido')->name('pedidos-campo.GetPedido');
    Route::get('pedidos-campo/delete/{pedido}', 'PedidosCampoController@delete')->name('pedidos-campo.delete');
    Route::get('pedidos-campo/{pedido}/up', 'PedidosCampoController@up')->name('pedidos-campo.up');
    Route::get('pedidos-campo/{pedido}/down', 'PedidosCampoController@down')->name('pedidos-campo.down');
#endregion

#region Comercial
    Route::get('comercial/dashboard', 'ComercialController@dashboard')->name('comercial.dashboard');
    Route::get('comercial/ajaxClienteResumenKilos', 'ComercialController@ajaxClienteResumenKilos')->name('comercial.ajaxClienteResumenKilos');
    Route::get('comercial/ajaxClienteResumenVentas', 'ComercialController@ajaxClienteResumenVentas')->name('comercial.ajaxClienteResumenVentas');
    Route::get('comercial/ajaxClienteResumenPorSemana', 'ComercialController@ajaxClienteResumenPorSemana')->name('comercial.ajaxClienteResumenPorSemana');
    Route::get('comercial/ajaxEstadoPedidosProduccion', 'ComercialController@ajaxEstadoPedidosProduccion')->name('comercial.ajaxEstadoPedidosProduccion');

    Route::resource('comercial/pedidos-comercial', 'PedidosComercialController');
    Route::post('comercial/pedidos-comercial/details', 'PedidosComercialController@details')->name('pedidos-comercial.details');
    Route::post('comercial/pedidos-comercial/ajaxGetDestinosComerciales', 'PedidosComercialController@ajaxGetDestinosComerciales')->name('pedidos-comercial.ajaxGetDestinosComerciales');
    Route::post('comercial/pedidos-comercial/ajaxGetDestinosComercialesForCliente', 'PedidosComercialController@ajaxGetDestinosComercialesForCliente')->name('pedidos-comercial.ajaxGetDestinosComercialesForCliente');
    Route::post('comercial/pedidos-comercial/ajaxLoadPaletsForCaja', 'PedidosComercialController@ajaxLoadPaletsForCaja')->name('pedidos-comercial.ajaxLoadPaletsForCaja');
    Route::post('comercial/pedidos-comercial/ajaxCheckStock', 'PedidosComercialController@ajaxCheckStock')->name('pedidos-comercial.ajaxCheckStock');
    Route::get('comercial/pedidos-comercial/delete/{pedido}', 'PedidosComercialController@delete')->name('pedidos-comercial.delete');
    Route::post('comercial/pedidos-comercial/update/{pedido}', 'PedidosComercialController@update')->name('pedidos-comercial.update');

    Route::get('almacen/pedidos-produccion', 'PedidosProduccionController@index')->name('pedidos-produccion.index');
    Route::post('almacen/pedidos-produccion', 'PedidosProduccionController@store')->name('pedidos-produccion.store');
    Route::post('almacen/pedidos-produccion/details', 'PedidosProduccionController@details')->name('pedidos-produccion.details');
    Route::post('almacen/pedidos-produccion/ajaxGetDestinosComerciales', 'PedidosProduccionController@ajaxGetDestinosComerciales')->name('pedidos-produccion.ajaxGetDestinosComerciales');
    Route::post('almacen/pedidos-produccion/ajaxGetDestinosComercialesForCliente', 'PedidosProduccionController@ajaxGetDestinosComercialesForCliente')->name('pedidos-produccion.ajaxGetDestinosComercialesForCliente');
    Route::post('almacen/pedidos-produccion/ajaxLoadPaletsForCaja', 'PedidosProduccionController@ajaxLoadPaletsForCaja')->name('pedidos-produccion.ajaxLoadPaletsForCaja');
    Route::post('almacen/pedidos-produccion/ajaxCheckStock', 'PedidosProduccionController@ajaxCheckStock')->name('pedidos-produccion.ajaxCheckStock');
    Route::post('almacen/pedidos-produccion/ajaxSaveStock', 'PedidosProduccionController@ajaxSaveStock')->name('pedidos-produccion.ajaxSaveStock');
    Route::post('almacen/pedidos-produccion/ajaxGetInventarioForPart', 'PedidosProduccionController@ajaxGetInventarioForPart')->name('pedidos-produccion.ajaxGetInventarioForPart');
    Route::get('almacen/pedidos-produccion/MaterialesDia', 'PedidosProduccionController@MaterialesDia')->name('pedidos-produccion.MaterialesDia');
    Route::get('almacen/pedidos-produccion/delete/{pedido}', 'PedidosProduccionController@delete')->name('pedidos-produccion.delete');
    Route::post('almacen/pedidos-produccion/update/{pedido}', 'PedidosProduccionController@update')->name('pedidos-produccion.update');
    Route::get('almacen/pedidos-produccion/pdf/{pedido}', 'PedidosProduccionController@pdf')->name('pedidos-produccion.pdf');

    Route::resource('comercial/clientes', 'ClientesController');
    Route::get('comercial/clientes/delete/{cliente}', 'ClientesController@delete')->name('clientes.delete');
    Route::post('comercial/clientes/{id}/adjuntos', 'ClientesController@adjuntos')->name('clientes.adjuntos');
    Route::get('comercial/clientes/delete-adjunto/{adjunto}', 'ClientesController@delete_adjunto');
    Route::post('comercial/clientes/{cliente}/contactos', 'ClientesController@contactos')->name('clientes.contactos');
    Route::get('comercial/clientes/delete-contacto/{contacto}', 'ClientesController@delete_contacto');
    Route::post('comercial/clientes/{cliente}/destinos', 'ClientesController@destinos')->name('clientes.destinos');
    Route::get('comercial/clientes/delete-destino/{destino}', 'ClientesController@delete_destino');
    Route::post('comercial/clientes/ajaxSendEmail', 'ClientesController@ajaxSendEmail')->name('clientes.ajaxSendEmail');

    Route::resource('comercial/transportes', 'TransporteController');
    Route::get('comercial/transportes/delete/{transporte}', 'TransporteController@delete')->name('transportes.delete');
    Route::post('comercial/transportes/{id}/adjuntos', 'TransporteController@adjuntos')->name('transportes.adjuntos');
    Route::get('comercial/transportes/delete-adjunto/{adjunto}', 'TransporteController@delete_adjunto');
    Route::post('comercial/transportes/{transporte}/contactos', 'TransporteController@contactos')->name('transportes.contactos');
    Route::get('comercial/transportes/delete-contacto/{contacto}', 'TransporteController@delete_contacto');
    Route::post('comercial/transportes/{transporte}/destinos', 'TransporteController@destinos')->name('transportes.destinos');
    Route::get('comercial/transportes/delete-destino/{destino}', 'TransporteController@delete_destino');
    Route::post('comercial/transportes/ajaxSendEmail', 'TransporteController@ajaxSendEmail')->name('transportes.ajaxSendEmail');
    Route::post('comercial/transportes/ajaxGetTransporte', 'TransporteController@ajaxGetTransporte')->name('transportes.ajaxGetTransporte');

#endregion

#region Almacen

#region Listado de Inventario
    Route::resource('almacen/listado-inventario', 'ListadoInventarioController');
#endregion

#region Entrada de Productos
    Route::resource('almacen/entrada-productos', 'EntradaProductosController');
    Route::get('almacen/entrada-productos/delete/{entrada}', 'EntradaProductosController@delete')->name('entrada-productos.delete');
    Route::post('almacen/entrada-productos/selectMaterial', 'EntradaProductosController@selectMaterial')->name('entrada-productos.selectMaterial');
    Route::post('almacen/entrada-productos/GetEntrada', 'EntradaProductosController@GetEntrada')->name('entrada-productos.GetEntrada');
#endregion

#region Salida de Productos
    Route::resource('almacen/salida-productos', 'SalidaProductosController');
    Route::get('almacen/salida-productos/delete/{salida}', 'SalidaProductosController@delete')->name('salida-productos.delete');
    Route::post('almacen/salida-productos/selectMaterial', 'SalidaProductosController@selectMaterial')->name('salida-productos.selectMaterial');
#endregion

#region Proveedores
    Route::resource('almacen/proveedores', 'ProveedoresController');
    Route::get('almacen/proveedores/delete/{proveedor}', 'ProveedoresController@delete')->name('proveedores.delete');
    Route::get('almacen/proveedores/delete-contacto/{contacto}', 'ProveedoresController@delete_contacto');
    Route::get('almacen/proveedores/delete-adjunto/{adjunto}', 'ProveedoresController@delete_adjunto');
    Route::post('almacen/proveedores/{id}/contactos', 'ProveedoresController@contactos')->name('proveedores.contactos');
    Route::post('almacen/proveedores/{id}/adjuntos', 'ProveedoresController@adjuntos')->name('proveedores.adjuntos');
    Route::post('almacen/proveedores/ajaxSendEmail', 'ProveedoresController@ajaxSendEmail')->name('proveedores.ajaxSendEmail');
#endregion

#region Trazabilidad de Pedidos
    Route::get('almacen/traza-pedidos', 'TrazaPedidosController@index')->name('traza-pedidos.index');
    Route::post('almacen/traza-pedidos/details', 'TrazaPedidosController@details')->name('traza-pedidos.details');

#endregion

#endregion

#region Materiales

    Route::get('maestros/materiales', function () {
        $cajas         = App\Caja::all();
        $pallets       = App\Pallet::all();
        $cubres        = App\Cubre::all();
        $auxiliares    = App\Auxiliar::all();
        $tarrinas      = App\Tarrina::all();
        $palletsModels = App\PalletModel::all();
        return view('maestros.materiales', [
            'cajas'         => $cajas,
            'pallets'       => $pallets,
            'cubres'        => $cubres,
            'auxiliares'    => $auxiliares,
            'tarrinas'      => $tarrinas,
            'palletsModels' => $palletsModels
        ]);
    })->name('materiales');

    Route::resource('maestros/cajas', 'CajasController');
    Route::resource('maestros/pallets', 'PalletsController');
    Route::resource('maestros/cubres', 'CubresController');
    Route::resource('maestros/auxiliares', 'AuxiliaresController');
    Route::resource('maestros/tarrinas', 'TarrinasController');

    Route::post('maestros/tarrinas/ajaxGetAll', 'TarrinasController@ajaxGetAll')->name('tarrinas.ajaxGetAll');
    Route::post('maestros/auxiliares/ajaxGetAll', 'AuxiliaresController@ajaxGetAll')->name('auxiliares.ajaxGetAll');

    Route::get('maestros/cajas/delete/{caja}', 'CajasController@delete')->name('cajas.delete');
    Route::get('maestros/pallets/delete/{pallet}', 'PalletsController@delete')->name('pallets.delete');
    Route::get('maestros/cubres/delete/{cubre}', 'CubresController@delete')->name('cubres.delete');
    Route::get('maestros/auxiliares/delete/{auxiliar}', 'AuxiliaresController@delete')->name('auxiliares.delete');
    Route::get('maestros/tarrinas/delete/{tarrina}', 'TarrinasController@delete')->name('tarrinas.delete');

    Route::post('maestros/pallets/ajaxGetPallets', 'PalletsController@ajaxGetPallets')->name('pallets.ajaxGetPallets');
#endregion

#region Familias y Marcas

    Route::get('maestros/familias-marcas', function () {
        $cultivos   = App\Cultivo::all();
        $variedades = App\Variedad::all();
        $marcas     = App\Marca::all();
        return view('maestros.familias_marcas', array(
            'cultivos'   => $cultivos,
            'variedades' => $variedades,
            'marcas'     => $marcas
        ));
    })->name('familias-marcas');

    Route::resource('maestros/cultivos', 'CultivosController');
    Route::get('maestros/cultivos/delete/{cultivo}', 'CultivosController@delete')->name('cultivos.delete');

    Route::resource('maestros/variedades', 'VariedadesController');
    Route::get('maestros/variedades/delete/{variedad}', 'VariedadesController@delete')->name('variedades.delete');

    Route::resource('maestros/marcas', 'MarcasController');
    Route::get('maestros/marcas/delete/{marca}', 'MarcasController@delete')->name('marcas.delete');

#endregion

#region Fincas

    Route::get('maestros/fincas', function () {
        $fincas   = App\Finca::all();
        $parcelas = App\Parcela::all();
        $cultivos = App\Cultivo::all();
        return view('maestros.fincas', array(
            'fincas'   => $fincas,
            'parcelas' => $parcelas,
            'cultivos' => $cultivos
        ));
    })->name('fincas');

    Route::post('maestros/fincas', 'FincasController@store')->name('fincas.create');
    Route::put('maestros/fincas/{finca}', 'FincasController@update')->name('fincas.update');
    Route::get('maestros/fincas/delete/{finca}', 'FincasController@delete')->name('fincas.delete');

    Route::post('maestros/parcelas', 'ParcelasController@store')->name('parcelas.create');
    Route::put('maestros/parcelas/{parcela}', 'ParcelasController@update')->name('parcelas.update');
    Route::get('maestros/parcelas/delete/{parcela}', 'ParcelasController@delete')->name('parcelas.delete');

#endregion

#region Productos Compuestos

    Route::get('maestros/productos-compuestos', 'ProductosCompuestosController@index')->name('productos-compuestos.index');
    Route::post('maestros/productos-compuestos/create', 'ProductosCompuestosController@create')->name('productos-compuestos.create');
    Route::post('maestros/productos-compuestos/update/{producto}', 'ProductosCompuestosController@update')->name('productos-compuestos.update');
    Route::get('maestros/productos-compuestos/show/{producto}', 'ProductosCompuestosController@show')->name('productos-compuestos.show');

    Route::put('maestros/productos-compuestos/store', 'ProductosCompuestosController@store')->name('productos-compuestos.store');
    Route::get('maestros/productos-compuestos/details/{producto}', 'ProductosCompuestosController@details')->name('productos-compuestos.details');
    Route::get('maestros/productos-compuestos/delete/{producto}', 'ProductosCompuestosController@delete')->name('productos-compuestos.delete');
    Route::post('maestros/productos-compuestos/ajaxGetCompuesto', 'ProductosCompuestosController@ajaxGetCompuesto')->name('productos-compuestos.ajaxGetCompuesto');
    Route::post('maestros/productos-compuestos/ajaxGetVariedad', 'ProductosCompuestosController@ajaxGetVariedad')->name('productos-compuestos.ajaxGetVariedad');
    Route::post('maestros/productos-compuestos/ajaxGetById', 'ProductosCompuestosController@ajaxGetById')->name('productos-compuestos.ajaxGetById');

#endregion

#region Trazabilidad

    Route::resource('maestros/trazabilidad', 'TrazabilidadController');
    Route::post('maestros/trazabilidad/ajaxSelectParcela', 'TrazabilidadController@ajaxSelectParcela')->name('trazabilidad.ajaxSelectParcela');
    Route::post('maestros/trazabilidad/ajaxSelectByCultivo', 'TrazabilidadController@ajaxSelectByCultivo')->name('trazabilidad.ajaxSelectByCultivo');
    Route::post('maestros/trazabilidad/ajaxTrazabilidadExist', 'TrazabilidadController@ajaxTrazabilidadExist')->name('trazabilidad.ajaxTrazabilidadExist');
    Route::get('maestros/trazabilidad/delete/{trazabilidad}', 'TrazabilidadController@delete')->name('trazabilidad.delete');

#endregion

#region Configuración
    Route::get('configuracion/datos-fiscales', 'DatosFiscalesController@show')->name('datos-fiscales.show');
    Route::post('configuracion/datos-fiscales', 'DatosFiscalesController@update')->name('datos-fiscales.update');

    Route::get('configuracion/especiales', 'EspecialesController@index')->name('especiales.index');
    Route::post('configuracion/especiales/semanas', 'EspecialesController@semanas')->name('especiales.semanas');

    Route::get('configuracion/email', 'EmailController@index')->name('email.index');
    Route::post('configuracion/email', 'EmailController@store')->name('email.store');

    //Usuarios
    Route::get('configuracion/usuarios', 'UsuariosController@index')->name('usuarios.index');
    Route::get('configuracion/usuarios/create', 'UsuariosController@create')->name('usuarios.create');
    Route::get('configuracion/usuarios/show/{usuario}', 'UsuariosController@show')->name('usuarios.show');
    Route::post('configuracion/usuarios', 'UsuariosController@store')->name('usuarios.store');
    Route::post('configuracion/usuarios/update/{usuario}', 'UsuariosController@update')->name('usuarios.update');

    //Roles de Usuarios
    Route::get('configuracion/roles', 'RolesController@index')->name('roles.index');
    Route::get('configuracion/roles/create', 'RolesController@create')->name('roles.create');
    Route::get('configuracion/roles/show/{rol}', 'RolesController@show')->name('roles.show');
    Route::post('configuracion/roles', 'RolesController@store')->name('roles.store');
    Route::post('configuracion/roles/update/{rol}', 'RolesController@update')->name('roles.update');

#endregion
});



