<?php
		
// Default values
$username = isset($username) ? $username : '';
$name	= isset($name) ? $name : '';
$email	= isset($email) ? $email : '';

echo '<div class="module_content">';
		
echo form::open();
		
	// Username
	echo '<fieldset>';
	echo form::label('username', __('Username'));
	echo form::input('username', $username);
	if (isset($errors['username']))
		echo '<div class="error">'.$errors['username'].'</div>';
	echo '</fieldset>';
		
	// Password
	echo '<fieldset>';
	echo form::label('password', __('Password'));
	echo form::password('password');
	if (isset($errors['_external']['password']))
		echo '<div class="error">'.$errors['_external']['password'].'</div>';
	echo '</fieldset>';
				
	// Password Confirm
	echo '<fieldset>';
	echo form::label('password_confirm', __('Re-type Password'));
	echo form::password('password_confirm');
	if (isset($errors['_external']['password_confirm']))
		echo '<div class="error">'.$errors['_external']['password_confirm'].'</div>';
	echo '</fieldset>';
		
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
				
	// Roles
	echo '<fieldset>';
	echo form::label('roles', __('Roles'));
	
	echo '<div class="clear" style="padding-left: 10px;">';
	foreach($roles as $role)
	{
		echo form::checkbox('role', $role->id);
		echo ' '.ucwords($role->name).' &ndash; '.$role->description;
		echo '<br/>';
	}
	echo '</div>';
	echo '</fieldset>';
		
	echo '<br/>';
			
	echo form::submit(NULL, ucfirst(strtolower($module_action_title)));
	echo __('or').' '.html::anchor('user', __('Cancel'));
		
echo form::close();

echo '</div>';
		
?>