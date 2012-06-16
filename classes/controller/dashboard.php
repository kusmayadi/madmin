<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Dashboard extends Controller_Admin {

	public function before()
	{
		parent::before();
		
		$this->template->title			= 'Dashboard';
		$this->template->module_title	= 'Dashboard';
	}
	
	public function action_index()
	{
		$this->template->content = number_format(round(8.40, 2), 2);
	}

}