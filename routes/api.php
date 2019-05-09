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

Route::group(['middleware' => 'cors'], function() {
	Route::get('users','Api\UserController@index');

	Route::post('testExcel','Api\TestController@testExcel');

	/*Project Stock*/
	Route::resource ('customer',							'Api\CustomerController');
	Route::resource ('project',								'Api\ProjectController');
	Route::get      ('project/functional-units/{id}',		'Api\ProjectController@functionalUnits');
	Route::get      ('project/forest-units/{id}',			'Api\ProjectController@forestUnits');
	Route::resource ('functional-unit',						'Api\FunctionalUnitController');
	Route::get 	    ('functional-unit/forest-units/{id}',	'Api\FunctionalUnitController@forestUnits');
	Route::resource ('forest-unit',							'Api\ForestUnitController');
	Route::get 		('forest-unit/pdf/{id}',				'Api\ForestUnitController@getPdf');

	/*Forest unit proccess*/
	Route::post('forest-unit/first-phase',				  'Api\ForestUnitController@firstPhase');
	Route::put ('forest-unit/second-phase/{forest_unit}', 'Api\ForestUnitController@secondPhase');
	Route::put ('forest-unit/third-phase/{forest_unit}',  'Api\ForestUnitController@thirdPhase');
	Route::put ('forest-unit/fourth-phase/{forest_unit}', 'Api\ForestUnitController@fourthPhase');

	/*users*/
	Route::any('crudService','Api\CrudController@dispatcher');
	Route::post('login','Api\AuthController@login');

});
