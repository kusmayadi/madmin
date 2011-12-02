<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Login extends Controller_Admin {

	protected function get_default_redirect()
	{
		return Common::get_config('admin.default_logged_in_redirect');
	}

}