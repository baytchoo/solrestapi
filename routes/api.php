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

	/*
	*	jwt auth
	*/
    Route::post('login', 'ApiAuth\AuthController@login');
    Route::post('logout', 'ApiAuth\AuthController@logout');
    Route::post('refresh', 'ApiAuth\AuthController@refresh');
    Route::post('me', 'ApiAuth\AuthController@me');
	/*
	*	telephones
	*/
	Route::resource('telephones' , 'telephone\TelephoneController' , [ 'only' => ['index' , 'show']]);
	/*
	*	addresses
	*/
	Route::resource('addresses' , 'address\AddressController' , [ 'only' => ['index' , 'show']]);
	/*
	*	peaple
	*/
	Route::resource('people' , 'person\PersonController' , [ 'except' => ['create' , 'edit']]);
    /*
	*	companies
	*/
	Route::resource('companies' , 'company\CompanyController' , [ 'except' => ['create' , 'edit']]);
	/*
	*	customers
	*/
	Route::resource('customers' , 'customer\CustomerController' , [ 'except' => ['create' , 'edit']]);
	/*
	*	Users
	*/
	Route::resource('users' , 'User\UserController', ['except' => ['create' , 'edit']]);
	Route::resource('users.roles' , 'User\UserRoleController', [ 'only' => ['index', 'update', 'destroy']]);
	Route::resource('users.permissions' , 'User\UserPermissionController', [ 'only' => ['index', 'update', 'destroy']]);
	/*
	*	Trust
	*/
	Route::resource('permissions' , 'Trust\PermissionController', ['except' => ['create' , 'edit']]);
	Route::resource('roles' , 'Trust\RoleController', ['except' => ['create' , 'edit']]);
	Route::resource('roles.permissions' , 'Trust\RolePermissionController', [ 'only' => ['index', 'update', 'destroy']]);
});


