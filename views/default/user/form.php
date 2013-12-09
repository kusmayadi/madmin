<div class="container-fluid"><h1><?php echo $module_action_title; ?></h1></div>

<?php

// Default values
$username = isset($username) ? $username : '';
$name   = isset($name) ? $name : '';
$email  = isset($email) ? $email : '';
$role   = isset($role) ? $role : array();

echo Form::open(NULL, array('class' => 'form-horizontal'));

    // Username
    echo '<div class="control-group">';
        echo Form::label('username', __('Username'), array('class' => 'control-label'));
        echo '<div class="controls">';
            echo Form::input('username', $username);

            if (isset($errors['username']))
                echo ' <small class="text-error">'.ucfirst($errors['username']).'</small>';
        echo '</div>';
    echo '</div>';

    // Password
    echo '<div class="control-group">';
        echo Form::label('password', __('Password'), array('class' => 'control-label'));
        echo '<div class="controls">';
            echo Form::password('password');

            if (isset($errors['_external']['password']))
                echo ' <small class="text-error">'.ucfirst($errors['_external']['password']).'</small>';
        echo '</div>';
    echo '</div>';

    // Password Confirm
    echo '<div class="control-group">';
        echo Form::label('password_confirm', __('Re-type Password'), array('class' => 'control-label'));
        echo '<div class="controls">';
            echo Form::password('password_confirm');

            if (isset($errors['_external']['password_confirm']))
                echo ' <small class="text-error">'.ucfirst($errors['_external']['password_confirm']).'</small>';
        echo '</div>';
    echo '</div>';

    // Name
    echo '<div class="control-group">';
        echo Form::label('name', __('Name'), array('class' => 'control-label'));
        echo '<div class="controls">';
            echo Form::input('name', $name);

            if (isset($errors['name']))
                echo '<small class="text-error">'.ucfirst($errors['name']).'</small>';
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

    // Roles
    echo '<div class="control-group">';
        echo Form::label('roles', __('Roles'), array('class' => 'control-label'));

        echo '<div class="controls">';
            foreach($roles as $storedrole)
            {
                echo '<label class="checkbox">';
                    echo Form::checkbox('role[]', $storedrole->id, (in_array($storedrole->id, $role)));
                    echo ' '.ucwords($storedrole->name).' &ndash; '.$storedrole->description;
                echo '</label>';
            }

            if (isset($errors['role']))
                echo '<div><small class="text-error">'.ucfirst($errors['role']).'</small></div>';
        echo '</div>';
    echo '</div>';

    echo '<div class="controls">';
        echo Form::submit(NULL, ucfirst(strtolower($module_action_title)), array('class' => 'btn btn-primary'));
        echo __(' or ').' '.html::anchor('user', __('Cancel'));
    echo '</div>';

echo Form::close();

?>
