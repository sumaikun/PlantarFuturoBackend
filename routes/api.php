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


/*Project Stock*/
Route::resource('project', 'Api\ProjectController');
Route::resource('functional-unit', 'Api\FunctionalUnitController');
Route::resource('forest-unit', 'Api\ForestUnitController');

/*Forest unit proccess*/
Route::post('forest-unit/first-phase','Api\ForestUnitController@firstPhase');
Route::put('forest-unit/second-phase/{id}','Api\ForestUnitController@secondPhase');
Route::put('forest-unit/third-phase/{id}','Api\ForestUnitController@thirdPhase');
Route::put('forest-unit/fourth-phase/{id}','Api\ForestUnitController@fourthPhase');