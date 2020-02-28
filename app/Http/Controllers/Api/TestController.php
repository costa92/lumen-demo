<?php
/**
 * Date: 2020-02-26
 * Time: 17:41
 * author: costalong
 * email: longqiuhong@163.com
 */

namespace App\Http\Controllers\Api;


class TestController extends BaseController
{
	public function __construct()
	{
	}

	public function index()
	{
		$user = $this->myInfo();
		return response()->json(compact('user'));
	}
}