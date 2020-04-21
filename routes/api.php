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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::group(['middleware' => 'auth:api'], function () {
	Route::get('user', 'AuthController@user');
	Route::post('logout', 'AuthController@logout');

	Route::get('roles', 'RoleController@all');
	Route::get('users', 'UserController@all')->middleware('access:User');
	Route::put('users/{id}', 'UserController@update')->middleware('access:User');
});
