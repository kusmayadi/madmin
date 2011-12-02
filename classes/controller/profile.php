<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Profile extends Controller_Admin {

	public function before()
	{
		parent::before();
		
		$this->template->module_title = 'Profile';
	}
	
	public function action_index()
	{
		
	}

}