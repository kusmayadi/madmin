<?php
		
// Default values
$username = isset($username) ? $username : '';
$name	= isset($name) ? $name : '';
$email	= isset($email) ? $email : '';
		
echo form::open();
		
	// Username
	echo form::label('username', __('Username'));
	echo form::input('username', $username);
	if (isset($errors['username']))
		echo '<div class="error">'.$errors['username'].'</div>';
		
	// Password
	echo form::label('password', __('Password'));
	echo form::password('password');
	if (isset($errors['_external']['password']))
		echo '<div class="error">'.$errors['_external']['password'].'</div>';
				
	// Password Confirm
	echo form::label('password_confirm', __('Re-type Password'));
	echo form::password('password_confirm');
	if (isset($errors['_external']['password_confirm']))
		echo '<div class="error">'.$errors['_external']['password_confirm'].'</div>';
		
	// Name
	echo form::label('name', __('Name'));
	echo form::input('name', $name);
	if (isset($errors['name']))
		echo '<div class="error">'.$errors['name'].'</div>';
			
	// Email
	echo form::label('email', __('Email'));
	echo form::input('email', $email);
	if (isset($errors['email']))
		echo '<div class="error">'.$errors['email'].'</div>';
				
	// Roles
	echo form::label('roles', __('Roles'));
			
	foreach($roles as $role)
	{
		echo form::checkbox('role', $role->id);
		echo ' '.ucwords($role->name).' &ndash; '.$role->description;
		echo '<br/>';
	}
		
	echo '<br/>';
			
	echo form::submit(NULL, ucfirst(strtolower($module_action_title)));
	echo __('or').' '.html::anchor('user', __('Cancel'));
		
echo form::close();
		
?>