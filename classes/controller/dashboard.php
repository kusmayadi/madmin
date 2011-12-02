<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Dashboard extends Controller_Admin {

	public function before()
	{
		parent::before();
		
		$this->template->module_title = 'Dashboard';
	}
	
	public function action_index()
	{
		
	}

}