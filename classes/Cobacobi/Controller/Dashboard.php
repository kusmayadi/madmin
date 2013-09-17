<?php defined('SYSPATH') or die('No direct script access.');

class Cobacobi_Controller_Dashboard extends Controller_Admin {

	public function before()
	{
		parent::before();
		
		$this->template->title			= 'Dashboard';
		$this->template->module_title	= 'Dashboard';
	}
	
	public function action_index()
	{
		
	}

}