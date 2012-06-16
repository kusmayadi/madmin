<?php defined('SYSPATH') or die('No direct script access.');

echo '<div class="module_content">';

	// Default values
	$username = isset($username) ? $username : '';
		
	echo form::open('login');
	
	// Username
	echo '<fieldset>';
		echo form::label('username', 'Username');
		echo form::input('username', $username, array('id' => 'username'));
		if (isset($errors['username']))
			echo '<div class="error">'.$errors['username'].'</div>';
	echo '</fieldset>';
	
	// Password
	echo '<fieldset>';
	echo form::label('Password');
	echo form::password('password');
	if (isset($errors['password']))
		echo '<div class="error">'.$errors['password'].'</div>';
	echo '</fieldset>';
	
	echo form::submit(NULL, 'Login');
		
	echo html::anchor('login/forgotpassword', __('Forgot Password').'?');
		
	echo form::close();
	
echo '</div>';
	
