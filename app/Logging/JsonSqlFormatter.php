<?php
/**
 * Date: 2020-02-29
 * Time: 11:30
 * author: costalong
 * email: longqiuhong@163.com
 */

namespace App\Logging;


use App\Library\Elastic\LogsElastic;
use Monolog\Formatter\JsonFormatter as BaseJsonFormatter;

class JsonSqlFormatter extends BaseJsonFormatter
{
	/**
	 * JsonFormatter constructor.
	 * @param int $batchMode
	 * @param bool $appendNewline
	 */
	public function __construct($batchMode = BaseJsonFormatter::BATCH_MODE_JSON, $appendNewline = true)
	{
		BaseJsonFormatter::__construct($batchMode, $appendNewline);
	}

	/**
	 * @param array $record
	 * @return array|mixed|string
	 * @throws \Exception
	 * author: costalong
	 * email: longqiuhong@163.com
	 */
	public function format(array $record)
	{
		$requestId = !empty($_SERVER['DG-REQUEST-ID']) ? $_SERVER['DG-REQUEST-ID'] : app('requestId');

		$datetime = $record['datetime']->format('Y-m-d H:i:s');
		$body = [
			'datetime' => $datetime,
			'level_name' => $record['level_name'],
			'requestId' => $requestId
		];

		if (!empty($record['message'])) {
			$body['message'] = $record['message'];
		}

		if (!empty($record['context'])) {
			$body = array_merge($body, $record['context']);
		}

		$newRecord = [
			'datetime' => $datetime,
			'message' => $record['message'],
			'requestId' => $requestId
		];
		if (!empty($record['context'])) {
			$newRecord = array_merge($newRecord, $record['context']);
		}
		// 格式化转json格式
		$json = $this->toJson(
				$this->normalize($newRecord), true) .
			($this->appendNewline ? "\n" : '');

		// 创建数据
		LogsElastic::create($body, true);

		return $json;
	}
}
