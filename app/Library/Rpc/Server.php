<?php


namespace App\Library\Rpc;


use App\Library\Thrift\Response;
use App\Library\Thrift\ThriftCommonCallServiceIf;
use Illuminate\Support\Facades\Log;

class Server implements ThriftCommonCallServiceIf
{
	/**
	 * 实现 socket 各个service 之间的转发
	 * @param string $params
	 * @return Response
	 * @throws \Exception
	 */
	public function invokeMethod($params)
	{
		// 转换字符串 json
		$input = json_decode($params, true);

		// 自己可以实现转发的业务逻辑

		$className = "App\\Services\\" . $input['serviceName'];
		$methodName = $input['methodName'];
		$reflectionClass = new \ReflectionClass($className);
		$service = $reflectionClass->newInstanceArgs();
		$input = $service->$methodName($input['params']);

		$response = new Response();
		$response->code = 200;
		$response->msg = '';
		$response->data = json_encode($input);
		return $response;
	}
}