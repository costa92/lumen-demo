<?php
/**
 * Date: 2020-02-26
 * Time: 13:05
 * author: costalong
 * email: longqiuhong@163.com
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class BaseController extends Controller
{

	use Helpers;

	/**
	 *  重新定义的返回验证错误类型
	 * @param Request $request
	 * @param \Illuminate\Contracts\Validation\Validator $validator
	 * author: costalong
	 * email: longqiuhong@163.com
	 */
	protected function throwValidationException(Request $request, $validator)
	{
		$message = $validator->errors()->first();
		Log::error($message);
		$this->response->error($message, 422);
	}

	/**
	 * 获取当前用户号信息
	 * @return \Tymon\JWTAuth\Contracts\JWTSubject
	 * author: costalong
	 * email: longqiuhong@163.com
	 */
	public function myInfo()
	{
		$user = Auth::user();
		if ($user == null) {
			$this->response->error("Unauthorized", 401);//抛出系统异常
		}
		return $user;
	}
}