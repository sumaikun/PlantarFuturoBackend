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

Route::group(['middleware' => 'cors'], function()
{
	/*Project Stock*/
	Route::resource ('customer',							'Api\CustomerController');
	Route::resource ('project',								'Api\ProjectController');
	Route::get      ('project/functional-units/{id}',		'Api\ProjectController@functionalUnits');
	Route::get      ('project/forest-units/{id}',			'Api\ProjectController@forestUnits');
	Route::get      ('project/users/{id}',					'Api\ProjectController@users');
	Route::get 		('project/export/{id}',		  			'Api\ProjectController@export');
	Route::post 	('project/massive',						'Api\ProjectController@massive');
	Route::post 	('project/xy',							'Api\ProjectController@massiveXY');
	Route::resource ('functional-unit',						'Api\FunctionalUnitController');
	Route::get 	    ('functional-unit/forest-units/{id}',	'Api\FunctionalUnitController@forestUnits');
	Route::resource ('forest-unit',							'Api\ForestUnitController');
	Route::get 		('forest-unit/pdf/{id}',				'Api\ForestUnitController@getPdf');

	/*Forest unit proccess*/
	Route::post('forest-unit/first-phase',				  'Api\ForestUnitController@firstPhase');
	Route::put ('forest-unit/first-phase/{forest_unit}',  'Api\ForestUnitController@firstPhaseUpdate');
	Route::post('forest-unit/third-phase',				  'Api\ForestUnitController@thirdPhase');
	Route::put ('forest-unit/third-phase/{forest_unit}',  'Api\ForestUnitController@thirdPhaseUpdate');

	/*users*/
	Route::get('users',		 		  'Api\AuthController@index');
	Route::post('users',		 	  'Api\AuthController@store');
	Route::get('users/projects/{id}', 'Api\AuthController@getProjects');
	Route::post('users/assignation',  'Api\AuthController@assignation');
	Route::post('users/risk-assignation',  'Api\AuthController@riskAssignation');
	Route::post('users/unassign',     'Api\AuthController@unassign');
	Route::post('login',	 		  'Api\AuthController@login');
	Route::any('crudService',		  'Api\CrudController@dispatcher');

	/*Risks*/
	Route::resource ('risks/tunnel-deformation', 'Api\TunnelDeformationController');
	Route::get 		('risks/tunnel-deformation/export/{id}', 'Api\TunnelDeformationController@export');

	Route::resource ('risks/hillside-displacement', 'Api\HillsideDisplacementController');
	Route::get 		('risks/hillside-displacement/export/{id}', 'Api\HillsideDisplacementController@export');

	Route::resource ('risks/hillside-round', 'Api\HillsideRoundController');
	Route::get 		('risks/hillside-round/export/{id}', 'Api\HillsideRoundController@export');

	Route::resource ('risks/dryravine-round', 'Api\DryRavineRoundController');
	Route::get 		('risks/dryravine-round/export/{id}', 'Api\DryRavineRoundController@export');

	Route::resource ('risks/precipitation', 'Api\PrecipitationController');
	Route::get 		('risks/precipitation/export/{id}', 'Api\PrecipitationController@export');

	Route::get 		('project/risks/{id}', 'Api\ProjectController@risks');	

	/*SST Report*/
	Route::resource ('sst', 'Api\SSTReportController');
	Route::get 		('sst/assistants/{id}', 'Api\SSTReportController@listAssistants');
	Route::get 		('sst/visitors/{id}', 'Api\SSTReportController@listVisitors');
	Route::resource ('visitor', 'Api\VisitorController');


	/*Plantacion*/
	Route::resource ('default-activity', 'Api\DefaultActivityController');
	Route::resource ('daily-report', 'Api\DailyReportController');
	Route::get 		('daily-report/project/{id}', 'Api\DailyReportController@showByProject');


	Route::get('timezone', function()
	{
		dd(date("Y m d H:i:s"));
	});
});


Route::options('{any}', ['middleware' => ['cors'], function () { return response(['status' => 'success']); }])->where('any', '.*');
