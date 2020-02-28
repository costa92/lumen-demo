<?php

$data = [

	/*
	|--------------------------------------------------------------------------
	| PDO Fetch Style
	|--------------------------------------------------------------------------
	|
	| By default, database results will be returned as instances of the PHP
	| stdClass object; however, you may desire to retrieve records in an
	| array format for simplicity. Here you can tweak the fetch style.
	|
	*/

	'fetch' => PDO::FETCH_CLASS,

	/*
	|--------------------------------------------------------------------------
	| Default Database Connection Name
	|--------------------------------------------------------------------------
	|
	| Here you may specify which of the database connections below you wish
	| to use as your default connection for all database work. Of course
	| you may use many connections at once using the Database library.
	|
	*/

	'default' => env('DB_CONNECTION', 'mysql'),

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Here are each of the database connections setup for your application.
	| Of course, examples of configuring each database platform that is
	| supported by Laravel is shown below to make development simple.
	|
	|
	| All database work in Laravel is done through the PHP PDO facilities
	| so make sure you have the driver for your particular database of
	| choice installed on your machine before you begin development.
	|
	*/

	'connections' => [

		'testing' => [
			'driver' => 'sqlite',
			'database' => ':memory:',
		],

		'sqlite' => [
			'driver' => 'sqlite',
			'database' => env('DB_DATABASE', base_path('database/database.sqlite')),
			'prefix' => env('DB_PREFIX', ''),
		],

		'mysql' => [
			'driver' => 'mysql',
			'read' => [
				'host' => env('DB_HOST', 'localhost'),
			],
			'write' => [
				'host' => env('DB_HOST', 'localhost'),
			],
			'port' => env('DB_PORT', 3306),
			'database' => env('DB_DATABASE', 'forge'),
			'username' => env('DB_USERNAME', 'forge'),
			'password' => env('DB_PASSWORD', ''),
			'charset' => env('DB_CHARSET', 'utf8mb4'),
			'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
			'prefix' => env('DB_PREFIX', ''),
			'timezone' => env('DB_TIMEZONE', '+00:00'),
			'strict' => env('DB_STRICT_MODE', false),
		],

		'pgsql' => [
			'driver' => 'pgsql',
			'host' => env('DB_HOST', 'localhost'),
			'port' => env('DB_PORT', 5432),
			'database' => env('DB_DATABASE', 'forge'),
			'username' => env('DB_USERNAME', 'forge'),
			'password' => env('DB_PASSWORD', ''),
			'charset' => env('DB_CHARSET', 'utf8'),
			'prefix' => env('DB_PREFIX', ''),
			'schema' => env('DB_SCHEMA', 'public'),
		],

		'sqlsrv' => [
			'driver' => 'sqlsrv',
			'host' => env('DB_HOST', 'localhost'),
			'database' => env('DB_DATABASE', 'forge'),
			'username' => env('DB_USERNAME', 'forge'),
			'password' => env('DB_PASSWORD', ''),
			'charset' => env('DB_CHARSET', 'utf8'),
			'prefix' => env('DB_PREFIX', ''),
		],

	],

	/*
	|--------------------------------------------------------------------------
	| Migration Repository Table
	|--------------------------------------------------------------------------
	|
	| This table keeps track of all the migrations that have already run for
	| your application. Using this information, we can determine which of
	| the migrations on disk haven't actually been run in the database.
	|
	*/
	'migrations' => 'migrations',

	'redis' => [
		'client' => 'predis',
		'default' => [
			'host' => env('REDIS_HOST', '127.0.0.1'),
			'password' => env('REDIS_PASSWORD', null),
			'port' => env('REDIS_PORT', 6379),
			'database' => 0,
		],


		'options' => [
			'cluster' => 'redis',
			'parameters' => [
				'password' => env('REDIS_PASSWORD', null),
			],
		],

		'cluster' => env('REDIS_CLUSTER', false),

		'clusters' => [
			'default' => [
				[
					'host' => env('REDIS_HOST_ONE', 'redis-cluster-1.diangoumall.com'),
					'password' => env('REDIS_PASSWORD', null),
					'port' => env('REDIS_PORT_ONE', 7001),
					'database' => 0,
				],
				[
					'host' => env('REDIS_HOST_TWO', 'redis-cluster-1.diangoumall.com'),
					'password' => env('REDIS_PASSWORD', null),
					'port' => env('REDIS_PORT_TWO', 7002),
					'database' => 0,
				],
				[
					'host' => env('REDIS_HOST_THREE', 'redis-cluster-1.diangoumall.com'),
					'password' => env('REDIS_PASSWORD', null),
					'port' => env('REDIS_PORT_THREE', 7003),
					'database' => 0,
				],
				[
					'host' => env('REDIS_HOST_FOUR', 'redis-cluster-2.diangoumall.com'),
					'password' => env('REDIS_PASSWORD', null),
					'port' => env('REDIS_PORT_FOUR', 7004),
					'database' => 0,
				],
				[
					'host' => env('REDIS_HOST_FIVE', 'redis-cluster-2.diangoumall.com'),
					'password' => env('REDIS_PASSWORD', null),
					'port' => env('REDIS_PORT_FIVE', 7005),
					'database' => 0,
				],
				[
					'host' => env('REDIS_HOST_SIX', 'redis-cluster-2.diangoumall.com'),
					'password' => env('REDIS_PASSWORD', null),
					'port' => env('REDIS_PORT_SIX', 7006),
					'database' => 0,
				]

			],
		],
		'session' => [
			'host' => env('REDIS_HOST', '127.0.0.1'),
			'password' => env('REDIS_PASSWORD', null),
			'port' => env('REDIS_PORT', 6379),
			'database' => 1,
		],
	],

];

// 是否设置开启redis集群
if (env('REDIS_CLUSTER', false) == true) {
	unset($data['redis']['default']);
} else {
	unset($data['redis']['clusters']);
}

return $data;
