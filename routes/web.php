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

Route::get('/dashboard', function(){
    return view('starter');
})->name('starter');

Route::get('/maestros/materiales', function() {
    $cajas = \App\Caja::all();
    return view('maestros.materiales', ['cajas' => $cajas]);
})->name('materiales');

Route::resource('/maestros/cajas', 'CajasController');

Route::get('/maestros/cajas/delete/{caja}', 'CajasController@delete')->name('cajas.delete');
