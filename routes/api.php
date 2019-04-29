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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('users','Api\UserController@index');

Route::post('testExcel','Api\TestController@testExcel');


/***/
Route::resource('project', 'Api\ProjectController');
Route::resource('functional-unit', 'Api\FunctionalUnitController');
Route::resource('forest-unit', 'Api\ForestUnitController');