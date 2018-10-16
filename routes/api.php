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
Route::group([

    'middleware' => 'api',

], function () {

    Route::post('login', 'ApiAuth\AuthController@login');
    Route::post('logout', 'ApiAuth\AuthController@logout');
    Route::post('refresh', 'ApiAuth\AuthController@refresh');
    Route::post('me', 'ApiAuth\AuthController@me');

	Route::resource('companies' , 'company\CompanyController' , [ 'except' => ['create' , 'edit']]);

	Route::resource('customers' , 'customer\CustomerController' , [ 'except' => ['create' , 'edit']]);

	Route::resource('people' , 'person\PersonController' , [ 'except' => ['create' , 'edit']]);

	Route::resource('telephones' , 'telephone\TelephoneController' , [ 'only' => ['index' , 'show']]);

	Route::resource('addresses' , 'address\AddressController' , [ 'only' => ['index' , 'show']]);
});


