<?php

return array(
	'hosts' => env('ELASTIC_HOST', '192.168.11.143:9200'),
	'logs' => [
		'path' => env('ELASTIC_LOG', storage_path('logs/elastic.log')),
		'options' => [
			'index' => 'test_elastic_',
			'type' => '_doc',
		],
	],
);

