<?php defined('SYSPATH') or die('No direct script access.');
		
echo '<div class="module_content">';

	echo form::open();

	// Old Password
	echo '<fieldset>';
	echo form::label('old_password', __('Old Password'));
	echo form::password('old_password');
	if (isset($errors['old_password']))
		echo '<div class="error">'.$errors['old_password'].'</div>';
	echo '</fieldset>';
			
	// New Password
	echo '<fieldset>';
	echo form::label('password', __('New Password'));
	echo form::password('password');
	if (isset($errors['password']))
		echo '<div class="error">'.$errors['password'].'</div>';
	echo '</fieldset>';
		
	// Password Confirm
	echo '<fieldset>';
	echo form::label('password_confirm', __('Re-type new password'));
	echo form::password('password_confirm');
	if (isset($errors['password_confirm']))
		echo '<div class="error">'.$errors['password_confirm'].'</div>';
	echo '</fieldset>';
		
			
	echo form::submit(NULL, ucfirst(strtolower($module_action_title)));
	
	echo form::close();

echo '</div>';