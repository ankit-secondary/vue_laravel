<?php

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

Route::prefix('auth')->group(

	function () {
		Route::post('register', 'AuthController@register');
		Route::post('login', 'AuthController@login');
		Route::get('refresh', 'AuthController@refresh');
		 // Send reset password mail
		 Route::post('reset-password', 'AuthController@sendPasswordResetLink');
        
		 // handle reset password form process
		 Route::post('reset/password', 'AuthController@callResetPassword');

		 // # [ADMIN SECTION]


		Route::group(['middleware' => 'auth:api'], function () {
				Route::get('user', 'AuthController@user');
				Route::post('logout', 'AuthController@logout');

			});
	});

Route::group(['middleware' => 'auth:api'], function () {
		// Users detail
		Route::get('users', 'UserController@index')->middleware('isAdmin');
		Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');

		Route::put('users/update/{id}', 'UserController@update')->middleware('isAdmin');
		Route::post('users/create', 'UserController@store')->middleware('isAdmin');
		Route::delete('users/destroy/{id}', 'UserController@destroy')->middleware('isAdmin');

//Products  

Route::get('products', 'Admin\ProductController@index')->middleware('isAdmin');
Route::put('products/update/{id}', 'Admin\ProductController@update')->middleware('isAdmin');
Route::post('products/create', 'Admin\ProductController@store')->middleware('isAdmin');
Route::delete('products/destroy/{id}', 'Admin\ProductController@destroy')->middleware('isAdmin');


	});