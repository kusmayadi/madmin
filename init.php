<?php defined('SYSPATH') or die('No direct script access.');

// Route to logout
Route::set('logout', 'logout')
	->defaults(array(
		'controller' => 'login',
		'action'     => 'logout'
	));