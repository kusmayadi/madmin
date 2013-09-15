<div class="container-fluid"><h1><?php echo __('Your Profile'); ?></h1></div>

<?php
		
// Default values
$name	= isset($name) ? $name : '';
$email	= isset($email) ? $email : '';


echo Form::open(NULL, array('class' => 'form-horizontal'));

	// Name
	echo '<div class="control-group">';
		echo Form::label('name', __('Name'), array('class' => 'control-label'));
		echo '<div class="controls">';
			echo Form::input('name', $name);
			if (isset($errors['name']))
				echo ' <small class="text-error">'.ucfirst($errors['name']).'</small>';
		echo '</div>';
	echo '</div>';
			
	// Email
	echo '<div class="control-group">';
		echo Form::label('email', __('Email'), array('class' => 'control-label'));
		echo '<div class="controls">';
			echo Form::input('email', $email);
			if (isset($errors['email']))
				echo ' <small class="text-error">'.ucfirst($errors['email']).'</small>';
		echo '</div>';
	echo '</div>';
		
	// Password
	echo '<div class="control-group">';
		echo Form::label('password', __('Enter your password to update your profile'), array('class' => 'control-label'));
		echo '<div class="controls">';
			echo Form::password('password');
				if (isset($errors['password']))
					echo ' <small class="text-error">'.ucfirst($errors['password']).'</small>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="controls">';
	echo Form::submit(NULL, ucfirst(strtolower($module_action_title)), array('class' => 'btn btn-primary'));
	echo '</div>';

echo Form::close();