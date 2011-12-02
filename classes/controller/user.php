<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller_Admin {

	public function before()
	{
		parent::before();
		
		$this->template->module_title = __('User');
	}
	
	public function action_index()
	{
		$this->template->module_action_title = __('Users');
		
		$total_records = DB::select()->from('users')->select('COUNT("*") AS total')->execute()->get('total');
		
		$pagination = $this->pagination($total_records);
		
		$users = ORM::factory('user')->limit(Common::get_config('pagination.items_per_page'))->offset($pagination['pagination']->get_offset())->find_all();
		
		$this->template->content = View::factory('general/user/list')
			->bind('users', $users)
			->bind('pagination', $pagination['view']);
			
		$this->add_js('list.js');
	}
	
	public function action_create()
	{
	
		$this->template->module_action_title = __('Add New User');
	
		$this->template->breadcrumbs = array(
			'user'	=> __('Users'),
			'current' => $this->template->module_action_title
		);
		
		$roles = ORM::factory('role')->find_all();
		
		$post_data = array();
		$vars = array('module_action_title' => $this->template->module_action_title, 'roles' => $roles);
		
		if ($this->request->method() == 'POST')
		{
			
			$user = ORM::factory('user');

			try 
			{
				$user->create_user($_POST, array('username', 'password', 'name', 'email'));
				
				$this->request->redirect('user');
			}
			catch(ORM_Validation_Exception $e)
			{
				$post_data = $_POST;
				$post_data['errors'] = $e->errors('validation');
			}
			
		}
		
		$this->template->content = $this->display_form('general/user/form', $post_data, $vars);
		
	}
	
	public function action_update()
	{
		$this->template->module_action_title = __('Update User');
	
		$this->template->breadcrumbs = array(
			'user'	=> __('Users'),
			'current' => $this->template->module_action_title
		);
		
		$roles = ORM::factory('role')->find_all();
		
		$user_id = $this->request->param('id');
		
		$user = ORM::factory('user', $user_id);
		
		$vars = array('module_action_title' => $this->template->module_action_title, 'roles' => $roles);
		
		if ($this->request->method() == 'POST')
		{
			try
			{
				$user->update_user($_POST, array('username', 'password', 'name', 'email'));
				
				$this->request->redirect('user');
			}
			catch(ORM_Validation_Exception $e)
			{
				$post_data = $_POST;
				$post_data['errors'] = $e->errors('validation');
			}
		}
		else
		{
			$post_data = $user->as_array();
		}
		
		$this->template->content = $this->display_form('general/user/form', $post_data, $vars);
	}
	
	public function action_delete()
	{
	
	
	}

}