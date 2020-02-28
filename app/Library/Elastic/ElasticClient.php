<?php


namespace App\Library\Elastic;


use Elasticsearch\ClientBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ElasticClient
{
	/**
	 * ElasticClient constructor.
	 */
	public function __construct()
	{

	}


	/**
	 * @return \Elasticsearch\Client
	 * @throws \Exception
	 */
	public static function client()
	{
		$logger = self::getLogger();
		$hosts = ElasticConfig::getHosts();
		return ClientBuilder::create()->setLogger($logger)->setHosts($hosts)->build();
	}

	/**
	 * @return Logger
	 * @throws \Exception
	 */
	protected static function getLogger()
	{
		$logger = new Logger('name');
		$logPath = ElasticConfig::getLogsPath();
		$logPath = $logPath ?? storage_path('logs/elastic.log');
		$logger->pushHandler(new StreamHandler($logPath, Logger::WARNING));
		return $logger;
	}
}