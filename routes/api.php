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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//login route
Route::post('login', 'Api\Auth\LoginController@login');

//company routes
Route::get('companies', 'Api\CompanyController@getAll');
Route::get('companies/{id}', 'Api\CompanyController@get');
Route::post('companies', 'Api\CompanyController@create');
Route::put('companies/{id}', 'Api\CompanyController@update');
Route::delete('companies/{id}','Api\CompanyController@delete');

//menu routes
Route::post('menu', 'Api\MenuController@create');
Route::put('menu/{id}', 'Api\MenuController@update');
Route::delete('menu/{id}','Api\MenuController@delete');

//facility route
Route::post('facility', 'Api\FacilityController@create');

//report routes
Route::get('reportPrice', 'Api\CompanyController@getReportByPrice');
Route::get('reportName', 'Api\CompanyController@getReportByName');