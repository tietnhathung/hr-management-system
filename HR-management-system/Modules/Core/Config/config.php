<?php

return [
    'name' => 'Core',
	'adUserAdmin' => 1,
	'displayDateFormat' => 'd/m/Y',
	'displayDateTimeFormat' => 'd/m/Y H:i',
    'paginationLimit' => 20,
	'fileUploadMaxSize' => 10240,
	'uploadPath' => 'upload',
	'logLevel' => [1,2,3],
	'logType' => [
		'info' => 1,
		'error' => 2,
		'system' => 3
	],
	'userStatus' => [
		'unactive' => 0,
		'actived' => 1,
		'locked' => 2
	]
];
