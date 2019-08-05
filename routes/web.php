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

Route::resource('/maestros/cajas', 'CajasController');
Route::resource('/maestros/pallets', 'PalletsController');
Route::resource('/maestros/cubres', 'CubresController');
Route::resource('/maestros/auxiliares', 'AuxiliaresController');
Route::resource('/maestros/tarrinas', 'TarrinasController');

Route::get('/maestros/cajas/delete/{caja}', 'CajasController@delete')->name('cajas.delete');
Route::get('/maestros/pallets/delete/{pallet}', 'PalletsController@delete')->name('pallets.delete');
Route::get('/maestros/cubres/delete/{cubre}', 'CubresController@delete')->name('cubres.delete');
Route::get('/maestros/auxiliares/delete/{auxiliar}', 'AuxiliaresController@delete')->name('auxiliares.delete');
Route::get('/maestros/tarrinas/delete/{tarrina}', 'TarrinasController@delete')->name('auxiliares.delete');

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
    $fincas   = App\Finca::all();
    $parcelas = App\Parcela::all();
    $cultivos = App\Cultivo::all();
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
    $productos = App\ProductoCompuesto_cab::all();

    foreach ($productos as $i => $producto)
    {
        $productos[$i]->detalles = App\ProductoCompuesto_det::where('compuesto_id', $producto->id)->get();
    }
    return view('maestros.productos_compuestos', [
        "productos" => $productos
    ]);
})->name('productos-compuestos');

Route::post('maestros/productos-compuestos/create', 'ProductosCompuestosController@create');

Route::get('/maestros/productos-compuestos/show/{id}', function ($id) {
    $producto      = App\ProductoCompuesto_cab::find($id);
    $detalles      = App\ProductoCompuesto_det::where('compuesto_id', $id)->get();

    foreach ($detalles as $i => $detalle)
    {
        $detalles[$i]->tarrinas = App\ProductoCompuesto_tarrinas::where('det_id', $detalle->id)->get();
    }

    $cajas         = App\Caja::all();
    $euro_pallets  = App\Pallet::where('modelo_id', '=', '1')->get();
    $grand_pallets = App\Pallet::where('modelo_id', '=', '2')->get();
    $tarrinas      = App\Tarrina::all();
    return view('maestros.productos_compuestos_show', [
        'producto'      => $producto,
        'detalles'      => $detalles,
        'cajas'         => $cajas,
        'tarrinas'      => $tarrinas,
        'euro_pallets'  => $euro_pallets,
        'grand_pallets' => $grand_pallets
    ]);
})->name('productos-compuestos-show');

Route::put('/maestros/productos-compuestos/store/{producto}', 'ProductosCompuestosController@store')->name('productos-compuestos.store');

#endregion

#region Trazabilidad

Route::get('/maestros/trazabilidad', function () {
    $fincas = App\Finca::all();
    return view('maestros.trazabilidad', array(
        'fincas' => $fincas
    ));
})->name('trazabilidad');

#endregion