<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class RedisController
{
	public function index(Request $request)
	{
		return User::query()->get();
	}

	public function test()
	{
		Cache::store('redis')->put('site_name', 'Lumen测试', 10);
		return Cache::store('redis')->get('site_name');
	}
}