<?php


namespace App\Logging;

use App\Library\Elastic\LogsElastic;
use Monolog\Formatter\JsonFormatter as BaseJsonFormatter;

class JsonFormatter extends BaseJsonFormatter
{
	public function format(array $record)
	{
		$datetime = $record['datetime']->format('Y-m-d H:i:s');
		$body = [
			'datetime' => $datetime,
			'level_name' => $record['level_name'],
		];
		if (!empty($record['context'])) {
			$body = array_merge($body, $record['context']);
		}
		// 创建数据
		LogsElastic::create($body);

		$newRecord = [
			'datetime' => $record['datetime']->format('Y-m-d H:i:s'),
			'message' => $record['message'],
		];
		if (!empty($record['context'])) {
			$newRecord = array_merge($newRecord, $record['context']);
		}
		// 格式化转json格式
		$json = $this->toJson(
				$this->normalize($newRecord), true) .
			($this->appendNewline ? "\n" : '');

		return $json;
	}
}
