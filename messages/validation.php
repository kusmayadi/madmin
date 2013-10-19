<?php defined('SYSPATH') or die('No direct script access.');

$validation_messages = Kohana::message('validation');

$madmin_validation = array(
 'old_password'  => array(
    'Controller_Profile::checkpass' => 'invalid password'
  ),
  'password'  => array(
    'Controller_Profile::checkpass' => 'invalid password'
  ),

);

return array_merge($validation_messages, $madmin_validation);
