<div class="container-fluid"><h1><?php echo __('Your Profile'); ?></h1></div>

<?php
		
// Default values
$name	= isset($name) ? $name : '';
$email	= isset($email) ? $email : '';


echo form::open(NULL, array('class' => 'form-horizontal'));

	// Name
	echo '<div class="control-group">';
	echo form::label('name', __('Name'), array('class' => 'control-label'));
	echo '<div class="controls">';
		echo form::input('name', $name);
	echo '</div>';
	if (isset($errors['name']))
		echo '<div class="error">'.$errors['name'].'</div>';
	echo '</div>';
			
	// Email
	echo '<div class="control-group">';
	echo form::label('email', __('Email'), array('class' => 'control-label'));
	echo '<div class="controls">';
		echo form::input('email', $email);
	echo '</div>';
	if (isset($errors['email']))
		echo '<div class="error">'.$errors['email'].'</div>';
	echo '</div>';
		
	// Password
	echo '<div class="control-group">';
	echo form::label('password', __('Enter your password to update your profile'), array('class' => 'control-label'));
	echo '<div class="controls">';
		echo form::password('password');
	echo '</div>';
	if (isset($errors['password']))
		echo '<div class="error">'.$errors['password'].'</div>';
	echo '</div>';
	
	echo '<div class="controls">';
	echo form::submit(NULL, ucfirst(strtolower($module_action_title)), array('class' => 'btn btn-primary'));
	echo '</div>';

echo form::close();