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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('landing');
});

Route::get('/dashboard', function () {
    return view('starter');
})->name('starter');

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

Route::resource('comercial/pedidos-comercial', 'PedidosComercialController');
Route::post('comercial/pedidos-comercial/details', 'PedidosComercialController@details')->name('pedidos-comercial.details');
Route::post('comercial/pedidos-comercial/ajaxGetDestinosComerciales', 'PedidosComercialController@ajaxGetDestinosComerciales')->name('pedidos-comercial.ajaxGetDestinosComerciales');
Route::post('comercial/pedidos-comercial/ajaxGetDestinosComercialesForCliente', 'PedidosComercialController@ajaxGetDestinosComercialesForCliente')->name('pedidos-comercial.ajaxGetDestinosComercialesForCliente');

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

Route::get('maestros/cajas/delete/{caja}', 'CajasController@delete')->name('cajas.delete');
Route::get('maestros/pallets/delete/{pallet}', 'PalletsController@delete')->name('pallets.delete');
Route::get('maestros/cubres/delete/{cubre}', 'CubresController@delete')->name('cubres.delete');
Route::get('maestros/auxiliares/delete/{auxiliar}', 'AuxiliaresController@delete')->name('auxiliares.delete');
Route::get('maestros/tarrinas/delete/{tarrina}', 'TarrinasController@delete')->name('auxiliares.delete');

Route::post('maestros/pallets/ajaxGetPalletByModelo', 'PalletsController@ajaxGetPalletByModelo')->name('pallets.ajaxGetPalletByModelo');
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
