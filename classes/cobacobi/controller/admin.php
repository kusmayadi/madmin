<?php defined('SYSPATH') or die('No direct script access.');

class Cobacobi_Controller_Admin extends Cobacobi_Controller_Template {

	protected $auth;
	protected $user;
	protected $session;
	
	public $template = 'general/template/admin';

	public function before()
	{
		parent::before();
		
		$this->session = Session::instance();
		$this->auth = Auth::instance();

		$this->template->auth = $this->auth;
		
		// Check if user already logged in
		if ($this->request->controller() != 'login')
		{	
			if ($this->auth->logged_in())
			{
				$this->user				= $this->auth->get_user();
				$this->template->user	= $this->user;
			}
			else
			{
				$ref = urlencode($this->request->detect_uri().url::query($this->request->query()));
				$this->request->redirect('login?ref='.$ref);
			}
			
		}
		
		if($this->auto_render)
		{
			$this->add_css('layout.css');
		
			// Add global js to template
			$this->add_js('jquery-1.7.min.js');
			$this->add_js('hideshow.js');
			$this->add_js('jquery.tablesorter.min.js');
			$this->add_js('jquery.equalHeight.js');
			$this->add_js('template.js');
		}
		
		 
	}

	protected function generate_menu()
	{
		return array(
		
			'users'		=> array(
				array('icon' => 'icn_add_user', 'url' => 'user/create', 'text' => __('Add New User')), 
				array('icon' => 'icn_view_users', 'url' => 'user', 'text' => __('View Users')), 
				array('icon' => 'icn_roles', 'url' => 'role', 'text' => __('Roles')), 
			), 
			
			'profile'	=> array(
				array('icon' => 'icn_profile', 'url' => 'profile', 'text' => __('Your Profile')), 
				array('icon' => 'icn_security', 'url' => 'profile/changepassword', 'text' => __('Change Password')), 
				array('icon' => 'icn_jump_back', 'url' => 'logout', 'text' => __('Logout'))
			),
			
			'admin'		=> array(
				array('icon' => 'icn_settings', 'url' => 'settings', 'text' => __('Options'))
			)
		);
	}
	
	public function after()
	{
		$this->template->menus = $this->generate_menu();

		parent::after();
		
	}

}