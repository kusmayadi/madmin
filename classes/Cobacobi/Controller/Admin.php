<?php defined('SYSPATH') or die('No direct script access.');

class Cobacobi_Controller_Admin extends Cobacobi_Controller_Template {

	protected $auth;
	protected $user;
	protected $session;
	
	public $template = 'template/admin';

	public function before()
	{
		parent::before();
		
		$this->session = Session::instance();
		$this->auth = Auth::instance();

		$this->template->auth = $this->auth;
		
		
		// Check if user already logged in
		if ($this->request->controller() != 'Login')
		{	
			if ($this->auth->logged_in())
			{
				$this->user				= $this->auth->get_user();
				$this->template->user	= $this->user;
			}
			else
			{
				$ref = urlencode($this->request->uri().URL::query($this->request->query()));

				$redirect = 'login';
				if ( ! is_null($ref) AND $ref != '')
					$redirect .= '?ref='.$ref;
				HTTP::redirect($redirect);
			}
			
		}
		
		if($this->auto_render)
		{
			$this->add_css('bootstrap.min.css');
			$this->add_css('bootstrap-responsive.min.css');
			$this->add_css('admin.css');
		
			// Add global js to template
			$this->add_js('jquery-1.9.0.min.js');
			$this->add_js('bootstrap.min.js');
		}
		
		 
	}
	
	/**
	 * Set custom menu
	 *
	 * @return Array
	 */
	protected function set_menu()
	{
		// Set your own menu here.
		return array();
	}
	
	/**
	 * Set admin menu
	 *
	 * @return Array
	 */
	protected function set_admin_menu()
	{
		return array(
			'users'	=> array('label' => __('Users'), 'url' => 'user', 'sub' => array(
				array('label' => __('View Users'), 'url' => 'user'),
				array('label' => __('Add New User'), 'url' => 'user/create'),
				array('label' => __('View Roles'), 'url' => 'role'),
				array('label' => __('Add New Role'), 'url' => 'role/create')
			))
		);
	}
	
	/**
	 * Set profile menu
	 *
	 * @return Array
	 */
	protected function set_profile_menu()
	{
		return array(
			array('label' => __('Your Profile'), 'url' => 'profile'),
			array('label' => __('Change Password'), 'url' => 'profile/changepassword'),
			array('label' => __('Logout'), 'url' => 'logout')
		);
	}
	
	public function after()
	{
		$this->template->menus 			= $this->set_menu();
		$this->template->admin_menus	= $this->set_admin_menu();
		$this->template->profile_menus	= $this->set_profile_menu();

		parent::after();
		
	}

}