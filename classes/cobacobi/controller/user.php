<?php defined('SYSPATH') or die('No direct script access.');

class Cobacobi_Controller_User extends Controller_Admin {

	public function before()
	{
		parent::before();
		
		$this->template->module_title = __('User');
	}
	
	public function action_index()
	{
	
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
	
		$this->template->module_action_title = __('Users');
		
		$total = DB::select(DB::expr('COUNT(*) AS total'))->from('users')->execute()->get('total');

		$pagination = Pagination::factory($total, Kohana::$config->load('pagination.total_per_page'));
		
		$users = ORM::factory('user')->limit($pagination->get_limit())->offset($pagination->get_offset())->find_all();
		
		$this->template->content = View::factory('user/list')
			->set('users', $users)
			->set('pagination', View::factory('template/pagination')->set('pagination', $pagination));
			
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
				
				HTTP::redirect('user');
			}
			catch(ORM_Validation_Exception $e)
			{
				$post_data = $_POST;
				$post_data['errors'] = $e->errors('validation');
			}
			
		}
		
		$this->template->content = $this->display_form('user/form', $post_data, $vars);
		
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
				
				HTTP::redirect('user');
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
			
			$user_roles = array();
			
			foreach ($user->roles->find_all() as $user_role)
			{
				$user_roles[] = $user_role->id;
			}
			
			$post_data['role'] = $user_roles;
		}
		
		$this->template->content = $this->display_form('user/form', $post_data, $vars);
	}
	
	public function action_delete()
	{
	
	
	}

}