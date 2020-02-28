<?php


namespace App\Console\Commands;


use App\Http\Controllers\SocketController;
use Illuminate\Console\Command;

class RpcServer extends Command
{
	/**
	 * 控制台命令 signature 的名称。
	 *
	 * @var string
	 */
	protected $signature = 'server:rpc';

	/**
	 * 控制台命令说明。
	 *
	 * @var string
	 */
	protected $description = 'rpc 服务';

	protected static $socketController;

	/**
	 * rpcServer constructor.
	 * @param SocketController $socketController
	 */
	public function __construct(SocketController $socketController)
	{
		parent::__construct();
		self::$socketController = $socketController;
	}

	/**
	 * 执行控制台命令。
	 *
	 * @return mixed
	 */
	public function handle()
	{
		self::$socketController->server();
	}
}