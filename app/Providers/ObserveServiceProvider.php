<?php
/**
 * Date: 2020-02-26
 * Time: 17:12
 * author: costalong
 * email: longqiuhong@163.com
 */

namespace App\Providers;


use App\Models\User;
use App\Observers\UserObservers;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class ObserveServiceProvider extends ServiceProvider
{

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * author: costalong
	 * email: longqiuhong@163.com
	 */
	public function boot()
	{
		User::observe(UserObservers::class);
	}
}