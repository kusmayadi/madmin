<?php
		
// Default values
$name 			= isset($name) ? $name : '';
$description	= isset($description) ? $description : '';
		
echo form::open();
		
	// Name
	echo form::label('name', __('Role Name'));
	echo form::input('name', $name);
	if (isset($errors['name']))
		echo '<div class="error">'.$errors['name'].'</div>';
		
	// Description
	echo form::label('description', __('Description'));
	echo form::input('description', $description, array('maxlength' => 255));
	if (isset($errors['description']))
		echo '<div class="error">'.$errors['description'].'</div>';
		
	echo '<br/>';
			
	echo form::submit(NULL, ucfirst(strtolower($module_action_title)));
	echo __('or').' '.html::anchor('role', __('Cancel'));
		
echo form::close();
		
?>