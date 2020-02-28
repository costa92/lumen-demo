<?php


namespace App\Library\Elastic;


class LogsElastic
{

	public function __construct()
	{

	}

	/**
	 *
	 */
	protected static function getOptions()
	{
		return ElasticConfig::getLogsOptions();
	}

	/**
	 * 写入日志信息
	 * @param array $data
	 * @return array
	 * @throws \Exception
	 */
	public static function create(array $data, $isSql = false)
	{
		$options = self::getOptions();

		if ($isSql) {
			$options['index'] = !empty($options['index']) ?
				$options['index'] . 'sql_' . date('Y-m-d') : "elastic_logs_sql";
		} else {
			$options['index'] = !empty($options['index']) ?
				$options['index'] . date('Y-m-d') : "elastic_logs";
		}

		$options['body'] = $data;

		$response = ElasticClient::client()->index($options);

		return $response;
	}
}