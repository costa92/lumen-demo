<?php


namespace App\Http\Controllers;

use App\Library\Elastic\ElasticClient;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ElasticController extends Controller
{
	/**
	 * ElasticController constructor.
	 */
	public function __construct()
	{
	}

	public function index(Request $request)
	{
		try {
			$result = User::find(9)->toArray();
			return $this->success($result);
		} catch (\Exception $e) {
			Log::error("查询用户信息错误", ['msg' => $e->getMessage(), 'file' => $e->getFile()]);
			throw new \Exception("查询用户信息错误");
		}
	}

	/**
	 * @param Request $request
	 */
	public function test(Request $request)
	{
		try {
			$params = [
				'index' => 'lumen-index',
				'body' => [
					'time' => date('Y-m-d'),
				]
			];
			$response = ElasticClient::client()->index($params);
			print_r($response);
		} catch (\Exception $e) {
			print_r($e->getMessage());
		}
	}


}