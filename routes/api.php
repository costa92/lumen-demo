<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$api = app('Dingo\Api\Routing\Router');
//
//$api->version('v2', ['namespace' => 'App\Http\Controllers\Api',], function ($api) {
//	$api->get('login', 'AuthController@login');
//});

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api'], function ($api) {
	$api->group(['middleware' => 'api'], function ($api) {
		$api->get('login', 'AuthController@login');
	});

	$api->get("test/index", 'TestController@index');

	$api->group(['prefix' => 'auth'], function ($api) {
		//获取token
		$api->post('token', 'AuthController@authenticate');
		$api->post('register', 'AuthController@register');
		$api->group(['middleware' => 'api'], function ($api) {
			$api->post('logout', 'AuthController@logout');
		});
	});

});