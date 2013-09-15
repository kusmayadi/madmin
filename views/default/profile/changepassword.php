<?php defined('SYSPATH') or die('No direct script access.'); ?>

<div class="container-fluid"><h1><?php echo __('Change Password'); ?></h1></div>
		
<?php echo Form::open(NULL, array('class' => 'form-horizontal'));

	// Old Password
	echo '<div class="control-group">';
		echo Form::label('old_password', __('Old Password'), array('class' => 'control-label'));
		echo '<div class="controls">';
			echo Form::password('old_password');
			if (isset($errors['old_password']))
				echo ' <small class="text-error">'.ucfirst($errors['old_password']).'</small>';
		echo '</div>';
	echo '</div>';
			
	// New Password
	echo '<div class="control-group">';
		echo Form::label('password', __('New Password'), array('class' => 'control-label'));
		echo '<div class="controls">';
			echo Form::password('password');
			if (isset($errors['password']))
				echo ' <small class="text-error">'.ucfirst($errors['password']).'</small>';
		echo '</div>';
	echo '</div>';
		
	// Password Confirm
	echo '<div class="control-group">';
		echo Form::label('password_confirm', __('Re-type new password'), array('class' => 'control-label'));
		echo '<div class="controls">';
			echo Form::password('password_confirm');
				if (isset($errors['password_confirm']))
					echo ' <small class="text-error">'.ucfirst($errors['password_confirm']).'</small>';
		echo '</div>';
	echo '</div>';
		
	echo '<div class="controls">';
		echo Form::submit(NULL, ucfirst(strtolower($module_action_title)), array('class' => 'btn btn-primary'));
	echo '</div>';
	
echo Form::close();