<?php

// Default values
$email = isset($email) ? $email : '';
		
echo Form::open('login/forgotpassword', array('class' => 'form-horizontal'));
	
	echo '<div class="control-group">';
		echo Form::label('email', __('Email Address'), array('class' => 'control-label'));
		echo '<div class="controls">';
			echo Form::input('email', $email);
			
			if (isset($errors['email']))
				echo ' <small class="text-error">'.ucfirst($errors['email']).'</small>';
		echo '</div>';
	echo '</div>';

	echo '<div class="controls">';
		echo Form::submit(NULL, __('Reset password'), array('class' => 'btn btn-primary'));
		echo ' '.__('or').' '.HTML::anchor('login', __('Cancel'));
	echo '</div>';
		
echo Form::close();