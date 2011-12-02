<?php defined('SYSPATH') or die('No direct script access.');

class Cobacobi_Admin extends Controller_Base {

	protected $auth;

	public function before()
	{
		parent::before();
		
		$this->auth = Auth::instance();
		
		$this->template->Auth = $this->auth;
		$this->template->user = $this->auth->get_user();
		
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

}