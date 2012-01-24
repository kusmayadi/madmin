<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Login extends Controller_Admin {

	protected function get_default_redirect()
	{
		return Common::get_config('admin.default_logged_in_redirect');
	}
	
	public function before()
	{
		parent::before();
		
		// Module title
		$this->template->module_title = 'Login';
		
		$this->auth = Auth::instance();
		$this->template->Auth = $this->auth;
	}
	
	public function action_index()
	{
		// Redirect to dashboard if user already logged in
		if ($this->auth->logged_in())
		{
			$this->request->redirect('dashboard');
		}
		
		$post_data = array();
		$additional_data = array();
		
		if ($this->request->method() == 'POST')
		{
			$post = Validation::factory($_POST)
				->rule('username', 'not_empty')
				->rule('password', 'not_empty');

			if ($post->check())
			{
				if ($this->auth->login($post['username'], $post['password']))
				{
					$this->request->redirect(Common::get_config('admin.default_logged_in_redirect'));
				}
				else
				{
					$post->error('username', 'invalid');
					
					$post_data					= $post->as_array();
					$additional_data['errors']	= $post->errors('validate');
				}
			}
			else
			{
				$post_data					= $post->as_array();
				$additional_data['errors']	= $post->errors('models');
			}
		}
		
		$this->template->title = 'Login';
		
		$this->template->breadcrumbs = array(
			'current' => 'Login'
		);
		
		$this->add_js('login.js');
		$this->template->content = $this->display_form('login/form', $post_data, $additional_data);
		
		$this->template->guide_text = '<p>'.__('Enter your login information to access the system.').'</p>';
		$this->template->guide_text .= '<p>'.__('If you don\'t have the access, please contact the administrator.').'</p>';
		
	
	}
	
	public function action_logout()
	{
		Auth::instance()->logout();
		
		$this->request->redirect('login');
	}
	
	public function action_forgotpassword()
	{
	
		if (Auth::instance()->logged_in())
		{
			$this->request->redirect('dashboard');
		}
	
		$this->template->module_title = __('Forgot Password');

		if ($this->request->method() == 'POST')
		{
			$post = Validation::factory($_POST)
				->rule('email', 'not_empty')
				->rule('email', 'email')
				->rule('email', 'email_domain');
				
			if ($post->check())
			{
				$user = ORM::factory('user')->where('email', '=', $post['email'])->find();
				
				if($user->loaded())
				{
				
					// Generate new password
					$new_password = $this->generate_password();
					
					// Save new password
					$user->password = $new_password;
					$user->save();
					
					// Email message
					$msg = __('Dear').' '.$user->username.',';
					$msg .= "\n\n";
					$msg .= __('Your new password is').': '.$new_password;
					$msg .= "\n\n";
					$msg .= __('You can login to CMS Cantiqa at').' '.url::site('login', $this->request);
					$msg .= "\n\n";
					$msg .= __('Thank you');
					$msg .= "\n";
					$msg .= 'Cantiqa Administrator';
					
					$email = Email::factory(__('Cantiqa CMS New Password'), $msg)
					    ->to($post['email'])
					    ->from('cms@cantiqa.com', 'Cantiqa CMS')
					    ->send();
					
					$this->template->content = View::factory('login/newpasswordgenerated');
					
					$this->template->guide_text = '<p>';
					$this->template->guide_text .= __('Check your email to see your new password.');
					$this->template->guide_text .= '</p>';
					
				}
				else
				{
					$post->error('email', 'not_registered');
					
					$this->display_forgotpassword_form($post->as_array(), array('errors' => $post->errors('validate')));
				}
				
			}
			else
			{
				$this->display_forgotpassword_form($post->as_array(), array('errors' => $post->errors('validate')));
			}
		}
		else
		{
			$this->display_forgotpassword_form();
		}
	}
	
	private function display_forgotpassword_form(Array $post = array(), Array $vars = array())
	{
		$this->template->content = $this->display_form('login/forgotpassword_form', $post, $vars);
			
		$this->template->guide_text = '<p>';
		$this->template->guide_text .= __('Enter your email address here. The system will reset and create a new password for you.');
		$this->template->guide_text .= '</p><p>';
		$this->template->guide_text .= __('Check your email to see your new password.');
		$this->template->guide_text .= '</p>';
	}
	
	private function generate_password()
	{
		
		$password = '';
		
		for ($i=0;$i<10;$i++)
		{
			$selector = rand(1,3);
			
			switch($selector)
			{
				case 1:
					$password .= chr(rand(48, 57));
				break;
				
				case 2:
					$password .= chr(rand(65, 90));
				break;
				
				case 3:
					$password .= chr(rand(97, 122));
				break;
			}
		}
		
		return $password;
		
	}

}