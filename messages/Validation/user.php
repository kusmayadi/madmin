<?php defined('SYSPATH') or die('No direct script access.');

$validation_messages = Kohana::message('validation');

$madmin_user_validation = array(
    'username' => array(
        'unique' => 'Username is already exists'
    ),

    'email' => array(
		'unique' => 'Email is already exists'
	)

];

return array_merge($validation_messages, $madmin_user_validation);