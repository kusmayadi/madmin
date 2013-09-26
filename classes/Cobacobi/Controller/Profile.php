<?php defined('SYSPATH') or die('No direct script access.');

class Cobacobi_Controller_Profile extends Controller_Admin {

	public function before()
	{
		parent::before();
		
		$this->template->module_title = 'Profile';
	}
	
	public function action_index()
	{
		$this->template->module_action_title = 'Update Profile';
		
		if ($this->request->method() == 'POST')
		{
			$post = Validation::factory($_POST);
			
			$post->rule('name', 'max_length', array(':value', 75));
			$post->rule('email', 'not_empty');
			$post->rule('email', 'email');
			$post->rule('email', 'max_length', array(':value', 254));
			$post->rule('password', 'not_empty');
			$post->rule('password', 'Controller_Profile::checkpass', array(':value'));
			
			
			$post_vars = $post->as_array();
			
			if ($post->check())
			{
				
				$postdata = $post->data();
				
				$user = ORM::factory('User', $this->user->id);
				$user->name		= $postdata['name'];
				$user->email	= $postdata['email'];
				$user->save();
				
				$this->add_message(__('Your profile has been saved.'));
				HTTP::redirect('profile');
			}
			else
			{
				
				$post_vars['errors']	= $post->errors('validation');
			}
		}
		else
		{
			$post_vars = array(
				'name'	=> $this->user->name,
				'email'	=> $this->user->email
			);
		}
		
		$additional_vars = array(
			'module_action_title'	=> 'Update Profile'
		);
		
		$this->template->content = $this->display_form('profile/profile', $post_vars, $additional_vars);
		
	}
	
	public function action_changepassword()
	{
		$this->template->module_action_title = 'Change Password';
		
		$post_vars = array();
		
		if ($this->request->method() == 'POST')
		{
			$post = Validation::factory($_POST);
			
			$post->rule('old_password', 'not_empty');
			$post->rule('old_password', 'Controller_Profile::checkpass', array(':value'));
			$post->rule('password', 'not_empty');
			$post->rule('password_confirm', 'not_empty');
			$post->rule('password_confirm', 'matches', array(':validation', 'password', 'password_confirm'));
			
			$post->label('password', 'new password');
			$post->label('password_confirm', 'password confirmation');
			
			if ($post->check())
			{
				$postdata = $post->data();
			
				$user = ORM::factory('User', $this->user->id);
				$user->password = $postdata['password'];
				$user->save();
				
				$this->add_message(__('Your password has been changed.'));
				HTTP::redirect('profile');
			}
			else
			{
				$post_vars['errors'] = $post->errors('validation');
			}
			
		}
		
		$additional_vars = array(
			'module_action_title'	=> 'Change Password'
		);
		
		$this->template->content = $this->display_form('profile/changepassword', $post_vars, $additional_vars);
	}
	
	public static function checkpass($pass)
	{
	
		if (Auth::instance()->get_user()->password === Auth::instance()->hash($pass))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}