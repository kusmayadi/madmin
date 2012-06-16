<?php
		
// Default values
$name	= isset($name) ? $name : '';
$email	= isset($email) ? $email : '';

echo '<div class="module_content">';

	echo form::open();

	// Name
	echo '<fieldset>';
	echo form::label('name', __('Name'));
	echo form::input('name', $name);
	if (isset($errors['name']))
		echo '<div class="error">'.$errors['name'].'</div>';
	echo '</fieldset>';
			
	// Email
	echo '<fieldset>';
	echo form::label('email', __('Email'));
	echo form::input('email', $email);
	if (isset($errors['email']))
		echo '<div class="error">'.$errors['email'].'</div>';
	echo '</fieldset>';
		
	// Password
	echo '<fieldset>';
	echo form::label('password', __('Enter your password to update your profile'));
	echo form::password('password');
	if (isset($errors['password']))
		echo '<div class="error">'.$errors['password'].'</div>';
	echo '</fieldset>';
			
	echo form::submit(NULL, ucfirst(strtolower($module_action_title)));

	echo form::close();

echo '</div>';