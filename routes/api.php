<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('v1/auth/login', [\App\Http\Controllers\Api\V1\AuthController::class, 'login'])->name('login');


Route::group([
    'middleware' => 'jwt.verify',
    'prefix' => 'v1/auth'
], function ($router) {
    Route::get('logout', '\App\Http\Controllers\Api\V1\AuthController@logout')->name('logout');
    Route::get('refresh', '\App\Http\Controllers\Api\V1\AuthController@refresh')->name('refresh');
    Route::get('me', '\App\Http\Controllers\Api\V1\AuthController@me')->name('me');
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'
], function ($router) {
//request update pay fur
Route::put('update-fur-pay', [App\Http\Controllers\Servicios\ServiciosController::class,'updatePay']);
});



