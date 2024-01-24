<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\QrCodeController;
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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //configuracion
    Route::get('/profile', 'App\Http\Controllers\User\UserController@profileUser')->name('profile');

    //ingreso item
    Route::get('/ingreso', 'App\Http\Controllers\Ingreso\IngresoController@index')->name('ingreso');
    Route::get('/ingreso-create', 'App\Http\Controllers\Ingreso\IngresoController@create')->name('ingreso.create');

    Route::any('ingreso.catalogotemp', 'App\Http\Controllers\Ingreso\IngresoController@catalogotemp')->name('ingreso.catalogotemp');

    Route::get('/ingreso/llenarcatalogo', 'App\Http\Controllers\Ingreso\IngresoController@llenarCatalogo')->name('ingreso.llenarcatalogo');
    Route::post('/ingreso/guardarItem', 'App\Http\Controllers\Ingreso\IngresoController@guardarItem')->name('ingreso.guardarItem');
    Route::post('/ingreso/deleteItem', 'App\Http\Controllers\Ingreso\IngresoController@eliminarItemDetalleIngreso')->name('ingreso.deleteItem');
    Route::post('/ingreso/storesitems', 'App\Http\Controllers\Ingreso\IngresoController@storeitems')->name('ingreso.storeitems');
    Route::get('/ingreso.edit/{id}', 'App\Http\Controllers\Ingreso\IngresoController@geteditIngreso')->name('ingreso.edit');


    //update_edicion abierta
    Route::post('/ingreso/guardarItemUpdate', 'App\Http\Controllers\Ingreso\IngresoController@guardarItemEdicionAbierta')->name('ingreso.guardarItemUpdate');
    Route::post('/ingreso/itemsUpdate', 'App\Http\Controllers\Ingreso\IngresoController@storeitemsUpdate')->name('ingreso.storeItemsUpdate');
    Route::get('ingreso.catalogoUpdate', 'App\Http\Controllers\Ingreso\IngresoController@detalleIngresoUpdate')->name('ingreso.detalleIngresoUpdate');
    Route::post('/ingreso/deleteItemUpdate', 'App\Http\Controllers\Ingreso\IngresoController@eliminarItemDetalleIngresoUpdate')->name('ingreso.deleteItemUpdate');
    Route::post('/ingreso.cerrarEdicion', 'App\Http\Controllers\Ingreso\IngresoController@cerrarEdicionIngreso')->name('ingreso.cerrarEdicion');

    //salida item
    Route::get('/egreso', 'App\Http\Controllers\Egreso\EgresoController@index')->name('egreso');


    //SALIDA ITEMS
    Route::get('salida.listaSalida', 'App\Http\Controllers\Egreso\EgresoController@listaSalida')->name('salida.listaSalida');
    Route::get('egreso.create', 'App\Http\Controllers\Egreso\EgresoController@create')->name('egreso.create');
    Route::get('salida/llenarcatalogoSalida', 'App\Http\Controllers\Egreso\EgresoController@llenarCatalogoSalida')->name('salida.llenarcatalogoSalida');
    Route::post('/salida/guardarItemSalida', 'App\Http\Controllers\Egreso\EgresoController@guardarItemSalidaTemp')->name('salida.guardarItemSalidaTemporal');
    Route::post('/salida/guardarSalida', 'App\Http\Controllers\Egreso\EgresoController@guardarItemSalida')->name('salida.guardarSalida');
    Route::get('/salida/detalleItemSalida', 'App\Http\Controllers\Egreso\EgresoController@catalogotempSalida')->name('salida.detalleItemSalida');
    Route::get('/salida/detalleSalida', 'App\Http\Controllers\Egreso\EgresoController@dataTabledetalleSalida')->name('salida.detalleSalida');
    Route::post('/salida/deleteItemSalidatemp', 'App\Http\Controllers\Egreso\EgresoController@eliminarItemDetalleIngreso')->name('salida.deleteItemSalidaTemp');
    Route::post('/salida/cancelarItemSalidaTemp', 'App\Http\Controllers\Egreso\EgresoController@cancelarItemSalidaTemp')->name('salida.cancelarItemSalidaTemp');
    Route::post('/salida/limpiarSalida', 'App\Http\Controllers\Egreso\EgresoController@limpiarSalida')->name('salida.limpiarSalida');

    Route::get('/salida.updateSalida/{id}', 'App\Http\Controllers\Egreso\EgresoController@getUpdateSalida')->name('salida.updateSalida');
    Route::post('/salida/guardarDetalleItemUpdate', 'App\Http\Controllers\Egreso\EgresoController@guardarDetalleItemUpdate')->name('salida.guardarDetalleItemUpdate');
    Route::post('/salida/guardarItemSalidaUpdate', 'App\Http\Controllers\Egreso\EgresoController@guardarItemSalidaUpdate')->name('salida.guardarItemSalidaUpdate');
    Route::post('/salida/deleteItemSalida', 'App\Http\Controllers\Egreso\EgresoController@eliminarItemDetalleIngresoUpdate')->name('salida.deleteItemSalidaUpdate');

    Route::post('/salida/guardarSalidaUpdate', 'App\Http\Controllers\Egreso\EgresoController@guardarItemSalidaUpdate')->name('salida.guardarSalidaUpdate');
    Route::post('/salida.cerrarEdicionSalida', 'App\Http\Controllers\Egreso\EgresoController@cerrarEdicionSalida')->name('salida.cerrarEdicionSalida');
    //reingreso salida-
    Route::get('/salida.reingresoSalida/{id}', 'App\Http\Controllers\Egreso\EgresoController@getReingresoSalida')->name('salida.reingresoSalida');
    Route::get('/salida/detalleSalidaReingreso', 'App\Http\Controllers\Egreso\EgresoController@dataTabledetalleSalidaReingreso')->name('salida.detalleSalidaReingreso');
    Route::get('/salida/getItemSalidareingreso', 'App\Http\Controllers\Egreso\EgresoController@getItemSalidareingreso')->name('salida.getItemSalidareingreso');
    Route::post('/salida/updateReingreso', 'App\Http\Controllers\Egreso\EgresoController@updateReingreso')->name('salida.updateReingreso');
    Route::post('/salida.cerrarEdicionReingreso', 'App\Http\Controllers\Egreso\EgresoController@cerrarEdicionReingreso')->name('salida.cerrarEdicionReingreso');
    // Route::get('egreso.create', [EgresoController::class, 'create'])->name('egreso.create');
    Route::post('/salida.salidasChartjs', 'App\Http\Controllers\Egreso\EgresoController@salidasChartjs')->name('salida.salidasChartjs');

    //imprimir pdf ingreso
    Route::get('/ingreso/pdfIngreso/{id}', 'App\Http\Controllers\Ingreso\PDFingreso@printIngresoItem')->name('salida.pdfIngreso');
    Route::get('/salida/pdfSalida/{id}', 'App\Http\Controllers\Egreso\PDFsalida@printSalidaItem')->name('salida.pdfSalida');
    Route::get('/salida/pdfSalidaReingreso/{id}', 'App\Http\Controllers\Egreso\PDFsalida@pdfSalidaReingreso')->name('salida.pdfSalidaReingreso');

    // Route::get('/qrcode', [QrCodeController::class, 'index']);



    Route::get('egreso.index', [EgresoController::class, 'index'])->name('egreso.index');

    Route::post('salida/storesitems', [EgresoController::class, 'storeitems'])->name('salida.storeitems');

    Route::post('detallesalida/stores', [EgresoController::class, 'storedetallesalida'])->name('detallesalida.store');

    // Route::get('datatable/salidas', [EgresoController::class, 'salida'])->name('datatable.salida');
    // Route::get('datatable/detallesalida', [DatatableController::class, 'detallesalida'])->name('datatable.detallesalida');
    // Route::get('datatable/total', [DatatableController::class, 'total'])->name('datatable.total');
    //Route::post ('detalleingreso/stores'  ,[DetalleIngresoController   ::class,'store'             ])->name('detalleingreso.store'     );

    //CATALOGO ITEMS
    Route::get('catalogo.index', 'App\Http\Controllers\Catalogo\CatalogoController@index')->name('catalogo.index');
    Route::post('catalogo.create', 'App\Http\Controllers\Catalogo\CatalogoController@createItem')->name('catalogo.create');
    // Route::get('catalogo.edit', 'App\Http\Controllers\Catalogo\CatalogoController@editItem')->name('catalogo.edit');
    Route::get('/catalogo.edit/{id}', 'App\Http\Controllers\Catalogo\CatalogoController@getEditItem')->name('catalogo.edit');
    Route::put('/catalogo.update', 'App\Http\Controllers\Catalogo\CatalogoController@updateCatalogo')->name('catalogo.update');
    Route::get('/catalogo.disable/{id}', 'App\Http\Controllers\Catalogo\CatalogoController@disableItem')->name('catalogo.disable');
    // Route::post('catalogo/stores',    [Catalogo\CatalogoController::class, 'store'])->name('catalogo.store');

    // Route::get('Catalogo.index',    [Catalogo\CatalogoController::class, 'index'])->name('catalogo.index');
    // Route::get('datatable/catalogos',    [CatalogoController::class, 'catalogotemp'])->name('datatable.catalogo');

    Route::get('catalogo/usuario',   [CatalogoController::class, 'usuario'])->name('catalogo.usuario');

    //UNIDADMEDIDA ITEMS
    Route::get('UnidadMedida.index', [UnidadMedidaController::class, 'index'])->name('UnidadMedida.index');
    Route::post('UnidadMedida/editUnidadMedida', [UnidadMedidaController::class, 'editUnidadMedida'])->name('UnidadMedida.editUnidadMedida');
    Route::get('datatable/unidadmedidas', [DatatableController::class, 'unidadmedida'])->name('datatable.unidadmedida');
    Route::post('unidadmedida/stores', [UnidadMedidaController::class, 'store'])->name('unidadmedida.store');

    Route::get('ingreso/llenarItemSelect', [IngresoController::class, 'llenarItemSelect'])->name('ingreso.llenarItemSelect');
    Route::post('ingreso/stores', [IngresoController::class, 'storedetalleingreso'])->name('ingreso.store');
    //  Route::post('ingreso/storesitems', [IngresoController::class, 'storeitems'])->name('ingreso.storeitems');
    // Route::post('ingreso/deleteItem', [IngresoController::class, 'eliminarItemDetalleIngreso'])->name('ingreso.deleteItem');
    // Route::post('ingreso/editIngreso', [IngresoController::class, 'editIngreso'])->name('ingreso.edit');
    // Route::post('ingreso/guardarItem', [IngresoController::class, 'guardarItem'])->name('ingreso.guardarItem');
});
Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    // Route::get('/ingreso', [App\Http\Controllers\HomeController::class, 'ingreso'])->name('ingreso');
});
Route::group(['prefix' => 'responsable', 'middleware' => 'auth'], function () {
    Route::get('/index', 'App\Http\Controllers\Responsable\ResponsableController@index')->name('responsable');
    Route::post('/new-responsable', 'App\Http\Controllers\Responsable\ResponsableController@createNewResponsable')->name('new.responsable');
    Route::get('/disable-responsable/{id}', 'App\Http\Controllers\Responsable\ResponsableController@disableAndEnableResponsable')->name('responsable.disable');
    Route::get('/get-responsable/{id}', 'App\Http\Controllers\Responsable\ResponsableController@getResponsable')->name('responsable.get');
    Route::put('/update-responsable', 'App\Http\Controllers\Responsable\ResponsableController@updateResponsable')->name('responsable.update');
});

// Route::group(['middleware' => 'admin'], function () {
//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// });

//reportes 
Route::get('reporte', 'App\Http\Controllers\Reportes\ReporteController@reporte')->name('reporte');
Route::get('reporte.ingreso', 'App\Http\Controllers\Reportes\ReporteController@reporteIngreso')->name('reporte.ingreso');
Route::get('reporte.salida', 'App\Http\Controllers\Reportes\ReporteController@reporteSalida')->name('reporte.salida');
