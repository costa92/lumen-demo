<?php


namespace App\Logging;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class CreateCustomLogger
{
	/**
	 * Create a custom Monolog instance.
	 *
	 * @param array $config
	 * @return \Monolog\Logger
	 */
	public function __invoke(array $config)
	{
		$processUser = posix_getpwuid(posix_geteuid());
		$processName = $processUser['name'];
		$storagePath = storage_path('logs/lumen-' . php_sapi_name() . '-'
			. $processName . '.log');

		$filename = !empty($config['path']) ? $config['path'] : $storagePath;

		$handler = new RotatingFileHandler($filename);
		$monolog = new Logger($config['driver']);
		$monolog->pushHandler($handler,(new RotatingFileHandler($filename,env('LOG_MAXFILE', 5))));
		return $monolog;
	}
}