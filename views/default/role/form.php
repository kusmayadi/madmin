<div class="container-fluid"><h1><?php echo $module_action_title; ?></h1></div>

<?php
		
// Default values
$name 			= isset($name) ? $name : '';
$description	= isset($description) ? $description : '';

echo Form::open(NULL, array('class' => 'form-horizontal'));
		
	// Name
	echo '<div class="control-group">';
	echo Form::label('name', __('Role Name'), array('class' => 'control-label'));
	echo '<div class="controls">';
		echo Form::input('name', $name);
		if (isset($errors['name']))
                echo ' <small class="text-error">'.ucfirst($errors['name']).'</small>';
	echo '</div>';
	if (isset($errors['name']))
		echo '<div class="error">'.$errors['name'].'</div>';
	echo '</div>';
		
	// Description
	echo '<div class="control-group">';
	echo Form::label('description', __('Description'), array('class' => 'control-label'));
	if (isset($errors['description']))
        echo ' <small class="text-error">'.ucfirst($errors['description']).'</small>';
	echo '<div class="controls">';
		echo Form::input('description', $description, array('maxlength' => 255));
	echo '</div>';
	if (isset($errors['description']))
		echo '<div class="error">'.$errors['description'].'</div>';
	echo '</div>';
	
	echo '<div class="controls">';
		echo Form::submit(NULL, ucfirst(strtolower($module_action_title)), array('class' => 'btn btn-primary'));
		echo __(' or ').' '.html::anchor('role', __('Cancel'));
	echo '</div>';
		
echo Form::close();