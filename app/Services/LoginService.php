<?php


namespace App\Services;


use App\User;

class LoginService extends BaseService
{
	public function login($params)
	{
		return User::all();
	}
}