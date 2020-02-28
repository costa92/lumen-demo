<?php
/**
 * Date: 2020-01-14
 * Time: 09:46
 * author: costalong
 * email: longqiuhong@163.com
 */


use Laravel\Lumen\Application as LumenApplication;

class Application extends LumenApplication
{
	public function __construct($basePath = null)
	{
		parent::__construct($basePath);
	}

	/**
	 *  重构版本
	 * @return string
	 */
	public function version()
	{
		$arr = ['coed' => 200, 'version' => 'v1'];
		return response()->json($arr, 200);
	}
}