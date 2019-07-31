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