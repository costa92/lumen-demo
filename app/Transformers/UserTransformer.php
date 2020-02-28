<?php
/**
 * Date: 2020-02-27
 * Time: 18:28
 * author: costalong
 * email: longqiuhong@163.com
 */

namespace App\Transformers;


use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

	public function transform(User $user)
	{
		return $user->toArray();
	}
}