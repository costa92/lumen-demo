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

$router->get('/', function () use ($router) {
	return $router->app->version();
});

$router->get('/elastic', 'ElasticController@index');
$router->get('/elastic/test', 'ElasticController@test');
$router->get('/test/client', 'TestController@index');
$router->get('/redis/index', 'RedisController@index');
$router->get('/redis/test', 'RedisController@test');

$router->get('rpc/server', 'SocketController@server');
$router->get('rpc/client', 'ClientController@client');
