<?php defined('SYSPATH') or die('No direct script access.');

// Default values
$username = isset($username) ? $username : '';

echo '<div class="container">';

echo form::open('login', array('class' => 'form-signin'));

	echo '<h2 class="form-signin-heading">'.__('Please sign in').'</h2>';
	
	// Username
	if (isset($errors['username']))
		echo '<span class="label label-important">'.ucfirst($errors['username']).'</span>';
	echo form::input('username', $username, array('id' => 'username', 'class' => 'input-block-level', 'placeholder' => __('Username')));
	
	// Password
	if (isset($errors['password']))
		echo '<span class="label label-important">'.ucfirst($errors['password']).'</span>';
	echo form::password('password', NULL, array('class' => 'input-block-level', 'placeholder' => __('Password')));
	
	echo form::submit(NULL, 'Login', array('class' => 'btn btn-primary'));
		
	echo ' '.html::anchor('login/forgotpassword', __('Forgot Password').'?');
		
echo form::close();
	
echo '</div>';