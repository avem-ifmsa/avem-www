<?php

$protocols = [
	'file'     => 'sqlite',
	'mysql'    => 'mysql',
	'postgres' => 'pgsql',
];

if ($databaseUrl = getenv('DATABASE_URL')) {
	$url = parse_url($databaseUrl);
	$db_connection = $protocols[$url['scheme']];
	$db_host       = $url['host'];
	$db_port       = $url['port'];
	$db_username   = $url['user'];
	$db_password   = $url['pass'];
	$db_database   = substr($url['path'], 1);
} else {
	$db_connection = env('DB_CONNECTION');
	$db_host       = env('DB_HOST');
	$db_port       = env('DB_PORT');
	$db_username   = env('DB_USERNAME');
	$db_password   = env('DB_PASSWORD');
	$db_database   = env('DB_DATABASE');
}

return [

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

	'fetch' => PDO::FETCH_OBJ,

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

	'default' => $db_connection,

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

		'sqlite' => [
			'driver' => 'sqlite',
			'database' => $db_database ?? database_path('database.sqlite'),
			'prefix' => '',
		],

		'mysql' => [
			'driver' => 'mysql',
			'host' => $db_host ?? 'localhost',
			'port' => $db_port ?? '3306',
			'database' => $db_database ?? 'forge',
			'username' => $db_database ?? 'forge',
			'password' => $db_password ?? '',
			'charset' => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix' => '',
			'strict' => true,
			'engine' => null,
		],

		'pgsql' => [
			'driver' => 'pgsql',
			'host' => $db_host ?? '127.0.0.1',
			'port' => $db_port ?? '5432',
			'database' => $db_database ?? 'forge',
			'username' => $db_username ?? 'forge',
			'password' => $db_password ?? '',
			'charset' => 'utf8',
			'prefix' => '',
			'schema' => 'public',
			'sslmode' => 'prefer',
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

	/*
	|--------------------------------------------------------------------------
	| Redis Databases
	|--------------------------------------------------------------------------
	|
	| Redis is an open source, fast, and advanced key-value store that also
	| provides a richer set of commands than a typical key-value systems
	| such as APC or Memcached. Laravel makes it easy to dig right in.
	|
	*/

	'redis' => [

		'cluster' => false,

		'default' => [
			'host' => env('REDIS_HOST', '127.0.0.1'),
			'password' => env('REDIS_PASSWORD', ''),
			'port' => env('REDIS_PORT', 6379),
			'database' => 0,
		],

	],

];
