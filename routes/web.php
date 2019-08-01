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

#region Materiales

Route::get('/maestros/materiales', function () {
    $cajas      = App\Caja::all();
    $pallets    = App\Pallet::all();
    $cubres     = App\Cubre::all();
    $auxiliares = App\Auxiliar::all();
    return view('maestros.materiales', [
        'cajas'      => $cajas,
        'pallets'    => $pallets,
        'cubres'     => $cubres,
        'auxiliares' => $auxiliares
    ]);
})->name('materiales');

Route::resource('/maestros/cajas', 'CajasController');
Route::resource('/maestros/pallets', 'PalletsController');
Route::resource('/maestros/cubres', 'CubresController');
Route::resource('/maestros/auxiliares', 'AuxiliaresController');

Route::get('/maestros/cajas/delete/{caja}', 'CajasController@delete')->name('cajas.delete');
Route::get('/maestros/pallets/delete/{pallet}', 'PalletsController@delete')->name('pallets.delete');
Route::get('/maestros/cubres/delete/{cubre}', 'CubresController@delete')->name('cubres.delete');
Route::get('/maestros/auxiliares/delete/{auxiliar}', 'AuxiliaresController@delete')->name('auxiliares.delete');

#endregion

#region Familias y Marcas

Route::get('/maestros/familias-marcas', function () {
    $cultivos   = App\Cultivo::all();
    $variedades = App\Variedad::all();
    $marcas     = App\Marca::all();
    return view('maestros.familias_marcas', array(
        'cultivos'   => $cultivos,
        'variedades' => $variedades,
        'marcas'     => $marcas
    ));
})->name('familias-marcas');

Route::resource('/maestros/cultivos', 'CultivosController');
Route::get('/maestros/cultivos/delete/{cultivo}', 'CultivosController@delete')->name('cultivos.delete');

Route::resource('/maestros/variedades', 'VariedadesController');
Route::get('/maestros/variedades/delete/{variedad}', 'VariedadesController@delete')->name('variedades.delete');

Route::resource('/maestros/marcas', 'MarcasController');
Route::get('/maestros/marcas/delete/{marca}', 'MarcasController@delete')->name('marcas.delete');

#endregion

#region Fincas

Route::get('/maestros/fincas', function () {
    $fincas = App\Finca::all();
    $parcelas = App\Parcela::all();
    $cultivos   = App\Cultivo::all();
    return view('maestros.fincas', array(
        'fincas'   => $fincas,
        'parcelas' => $parcelas,
        'cultivos' => $cultivos
    ));
})->name('fincas');

Route::post('/maestros/fincas', 'FincasController@store')->name('fincas.create');
Route::put('/maestros/fincas/{finca}', 'FincasController@update')->name('fincas.update');
Route::get('/maestros/fincas/delete/{finca}', 'FincasController@delete')->name('fincas.delete');

Route::post('/maestros/parcelas', 'ParcelasController@store')->name('parcelas.create');
Route::put('/maestros/parcelas/{parcela}', 'ParcelasController@update')->name('parcelas.update');
Route::get('/maestros/parcelas/delete/{parcela}', 'ParcelasController@delete')->name('parcelas.delete');

#endregion

#region Productos Compuestos

Route::get('/maestros/productos-compuestos', function () {
    $cajas = App\Caja::all();
    return view('maestros.productos_compuestos');
})->name('productos-compuestos');

#endregion