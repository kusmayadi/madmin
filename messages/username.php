<?php defined('SYSPATH') or die('No direct script access.');

$validation_messages = Kohana::message('validation');

$madmin_username_validation = array(
    'username' => array(
        'invalid' => 'invalid username'
    ),

);

return array_merge($validation_messages, $madmin_username_validation);
