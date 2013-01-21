<?php

// Default values
$email = isset($email) ? $email : '';
		
echo form::open('login/forgotpassword', array('class' => 'form-horizontal'));
	
	echo '<div class="control-group">';
		echo form::label('email', __('Email Address'), array('class' => 'control-label'));
		echo '<div class="controls">';
			echo form::input('email', $email);
			
			if (isset($errors['email']))
				echo ' <small class="text-error">'.ucfirst($errors['email']).'</small>';
		echo '</div>';
	echo '</div>';

	echo '<div class="controls">';
		echo form::submit(NULL, __('Reset password'), array('class' => 'btn btn-primary'));
		echo ' '.__('or').' '.html::anchor('login', __('Cancel'));
	echo '</div>';
		
echo form::close();