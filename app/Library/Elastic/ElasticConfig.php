<?php


namespace App\Library\Elastic;


class ElasticConfig
{
	/**
	 * 获取配置
	 * @return array
	 */
	protected static function getConfig($key)
	{
		$configKey = 'elasticsearch.' . $key;
		return config($configKey);
	}

	/**
	 * 获取主机
	 * @return array
	 */
	public static function getHosts()
	{
		$host = self::getConfig('hosts');
		return explode(',', $host);
	}


	/**
	 * 获取日志配置的路径
	 * @return array
	 */
	public static function getLogsPath()
	{
		$logsPath = self::getConfig('logs.path');
		return $logsPath;
	}

	/**
	 * 日志索引配置
	 * @return array
	 */
	public static function getLogsOptions()
	{
		$logsOptions = self::getConfig('logs.options');
		return $logsOptions;
	}

}