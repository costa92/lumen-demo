<?php

if (!function_exists('config_path')) {
	// 加载配置文件路径函数
	function config_path()
	{
		return app()->basePath('config');
	}
};

