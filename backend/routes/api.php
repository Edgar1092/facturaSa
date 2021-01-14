<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'namespace' =>  'Auth',
    'prefix'    =>  'auth'
], function(){
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');
   
    Route::group(['middleware' => 'auth:api'], function()
    {

    });
});

Route::post('auth/register', 'UserController@store');
Route::post('referidos', 'UserController@obtenerReferido');
Route::post('patrocinador', 'UserController@obtenerPatrocinador');

/** File routes */

Route::group([
    'middleware'        =>  'auth:api'
], function(){
    Route::resource('users','UserController');
    Route::resource('roles','RoleController');

});

//rutas de clientes
Route::group([
    'prefix'        => 'cliente',
], function () {
    Route::get('all','ClientesController@getAll');
    Route::post('get','ClientesController@show');
    Route::post('create','ClientesController@create');
    Route::post('update','ClientesController@update');
    Route::post('delete','ClientesController@delete');
    
});




