<?php


namespace App\Http\Controllers;


use App\Library\Rpc\Server;
use Thrift\Factory\TBinaryProtocolFactory;
use App\Library\Thrift\ThriftCommonCallServiceProcessor;
use Thrift\Factory\TTransportFactory;
use Thrift\Server\TServerSocket;
use Thrift\Server\TSimpleServer;
use Thrift\TMultiplexedProcessor;

class SocketController extends Controller
{
	/**
	 * 启动 socket 连接
	 */
	public function server()
	{
		try {
			$thriftProcessor = new ThriftCommonCallServiceProcessor(new Server());
			$tFactory = new TTransportFactory();
			$pFactory = new TBinaryProtocolFactory(true, true);
			$processor = new TMultiplexedProcessor();
			// 注册服务
			$processor->registerProcessor('thriftCommonCallService', $thriftProcessor);

			// 监听开始
			$transport = new TServerSocket('127.0.0.1', 9999);
			$server = new TSimpleServer($processor, $transport, $tFactory, $tFactory, $pFactory, $pFactory);
			$server->serve();
		} catch (\TException $te) {
			app('log')->error('socket 服务启动失败', ['content' => $te->getMessage()]);
		}
	}
}