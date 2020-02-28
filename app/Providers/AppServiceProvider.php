<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		if ($this->app->environment() == 'local') {
			$this->app->register('Wn\Generators\CommandsServiceProvider');
		}
	}

	/**
	 *
	 */
	public function boot()
	{
//		app('api.exception')->register(function (\Exception $exception) {
//			$request = Request::capture();
//			return app('App\Exceptions\Handler')->render($request, $exception);
//		});
	}
}
