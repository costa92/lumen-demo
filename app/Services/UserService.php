<?php
/**
 * Date: 2020-02-28
 * Time: 12:46
 * author: costalong
 * email: longqiuhong@163.com
 */

namespace App\Services;


use App\Models\User;

class UserService extends BaseService
{
	/**
	 * @param $email
	 * @return bool
	 * author: costalong
	 * email: longqiuhong@163.com
	 */
	public function userFirstByEmail($email)
	{
		$user = User::where('email',$email)->first();
		if ($user) {
			return $user;
		}
		return false;
	}
}