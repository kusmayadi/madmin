<?php defined('SYSPATH') or die('No direct script access.');

$validation_messages = Kohana::message('validation');

$madmin_validation = [
	'old_password'	=> [
		'Controller_Profile::checkpass'	=> 'invalid password'
	],

];

return array_merge($validation_messages, $madmin_validation);