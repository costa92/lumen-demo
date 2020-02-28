<?php


namespace App\Listeners;


use App\Library\Elastic\LogsElastic;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class QueryListener
{
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	public function handle(QueryExecuted $event)
	{
		$sql = str_replace("?", "'%s'", $event->sql);
		$data['datetime'] = date("Y-m-d H:i:s");
		$data['sql'] = $log['sql'] = vsprintf($sql, $event->bindings);
		$log['time'] = $data['time'] = $event->time;
		// 判断是否为自定义的
		if ('myapplog' == env("LOG_CHANNEL")) {
			LogsElastic::create($data, true);
		}

		$file = env('LOG_FILE_SQL_PATH') ? env('LOG_FILE_SQL_PATH') : storage_path('logs/sql.log');
		$output = "[%datetime%][%channel%][Level:%level_name%][Message:%message% %context% %extra%]\n";
		(new Logger('sql'))->pushHandler((new RotatingFileHandler($file, env('LOG_MAXFILE', 5)))
			->setFormatter(new LineFormatter($output, null, true, true)))
			->info("query", $log);
	}
}