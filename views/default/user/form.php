<div class="container-fluid"><h1><?php echo $module_action_title; ?></h1></div>

<?php
		
// Default values
$username = isset($username) ? $username : '';
$name	= isset($name) ? $name : '';
$email	= isset($email) ? $email : '';
		
echo form::open(NULL, array('class' => 'form-horizontal'));
		
	// Username
	echo '<div class="control-group">';
		echo form::label('username', __('Username'), array('class' => 'control-label'));
		echo '<div class="controls">';
			echo form::input('username', $username);
		
			if (isset($errors['username']))
				echo ' <small class="text-error">'.ucfirst($errors['username']).'</small>';
		echo '</div>';
	echo '</div>';
		
	// Password
	echo '<div class="control-group">';
		echo form::label('password', __('Password'), array('class' => 'control-label'));
		echo '<div class="controls">';
			echo form::password('password');
		
			if (isset($errors['_external']['password']))
				echo ' <small class="text-error">'.ucfirst($errors['_external']['password']).'</small>';
		echo '</div>';
	echo '</div>';
				
	// Password Confirm
	echo '<div class="control-group">';
		echo form::label('password_confirm', __('Re-type Password'), array('class' => 'control-label'));
		echo '<div class="controls">';
			echo form::password('password_confirm');
		
			if (isset($errors['_external']['password_confirm']))
				echo ' <small class="text-error">'.ucfirst($errors['_external']['password_confirm']).'</small>';
		echo '</div>';
	echo '</div>';
		
	// Name
	echo '<div class="control-group">';
		echo form::label('name', __('Name'), array('class' => 'control-label'));
		echo '<div class="controls">';
			echo form::input('name', $name);
			
			if (isset($errors['name']))
				echo '<small class="text-error">'.ucfirst($errors['name']).'</small>';
		echo '</div>';
	echo '</div>';
			
	// Email
	echo '<div class="control-group">';
		echo form::label('email', __('Email'), array('class' => 'control-label'));
		echo '<div class="controls">';
			echo form::input('email', $email);
			
			if (isset($errors['email']))
				echo ' <small class="text-error">'.ucfirst($errors['email']).'</small>';
		echo '</div>';
	echo '</div>';
				
	// Roles
	echo '<div class="control-group">';
		echo form::label('roles', __('Roles'), array('class' => 'control-label'));
	
		echo '<div class="controls">';
			foreach($roles as $role)
			{
				echo '<label class="checkbox">';
					echo form::checkbox('role', $role->id);
					echo ' '.ucwords($role->name).' &ndash; '.$role->description;
				echo '</label>';
			}
			
			if (isset($errors['role']))
				echo '<div><small class="text-error">'.ucfirst($errors['role']).'</small></div>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="controls">';
		echo form::submit(NULL, ucfirst(strtolower($module_action_title)), array('class' => 'btn btn-primary'));
		echo __(' or ').' '.html::anchor('user', __('Cancel'));
	echo '</div>';
		
echo form::close();
		
?>