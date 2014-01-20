<?php defined('SYSPATH') or die('No direct script access.');

// Default values
$username = isset($username) ? $username : '';

echo '<div class="container">';

echo Form::open('login', array('class' => 'form-signin'));

  echo isset($ref) ? Form::hidden('ref', $ref) : '';

  echo '<h2 class="form-signin-heading">'.__('Please sign in').'</h2>';

  // Username
  if (isset($errors['username']))
    echo '<span class="label label-important">'.ucfirst($errors['username']).'</span>';
  echo Form::input('username', $username, array('id' => 'username', 'class' => 'input-block-level', 'placeholder' => __('Username')));

  // Password
  if (isset($errors['password']))
    echo '<span class="label label-important">'.ucfirst($errors['password']).'</span>';
  echo Form::password('password', NULL, array('class' => 'input-block-level', 'placeholder' => __('Password')));

  echo Form::submit(NULL, 'Login', array('class' => 'btn btn-primary'));

  echo ' '.HTML::anchor('login/forgotpassword', __('Forgot Password').'?');

echo Form::close();

echo '</div>';
