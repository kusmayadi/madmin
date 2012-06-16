<div class="module_content">
	
	<?php
		echo Auth::instance()->hash_password('rocknroll');
	// Default values
	$email = isset($email) ? $email : '';
		
	echo form::open('login/forgotpassword');
	
	echo '<fieldset>';
		echo form::label(__('Email Address'));
		echo form::input('email', $email);
		if (isset($errors['email']))
			echo '<div class="error">'.$errors['email'].'</div>';
	echo '</fieldset>';

		echo form::submit(NULL, __('Reset password'));
		echo ' '.__('or').' '.html::anchor('login', __('Cancel'));
		
		echo form::close();
		?>
	
	</div>