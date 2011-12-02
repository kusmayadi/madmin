<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Admin extends Admin {

	public function before()
	{
		parent::before();
		
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

	private function generate_menu()
	{
		return array(
			'users'		=> array(
				array('icon' => 'icn_add_user', 'url' => 'user/create', 'text' => __('Add New User')), 
				array('icon' => 'icn_view_users', 'url' => 'user', 'text' => __('View Users')), 
				array('icon' => 'icn_roles', 'url' => 'role', 'text' => __('Roles')), 
			), 
			
			'profile'	=> array(
				array('icon' => 'icn_profile', 'url' => 'profile', 'text' => __('Your Profile')), 
				array('icon' => 'icn_security', 'url' => 'profile', 'text' => __('Change Password')), 
				array('icon' => 'icn_jump_back', 'url' => 'logout', 'text' => __('Logout'))
			),
			
			'admin'		=> array(
				array('icon' => 'icn_settings', 'url' => 'settings', 'text' => __('Options')), 
				array('icon' => 'icn_settings', 'url' => 'modules', 'text' => __('Modules'))
			)
		);
	}
	
	public function after()
	{
		$this->template->menus = $this->generate_menu();
		
		parent::after();
	}

}