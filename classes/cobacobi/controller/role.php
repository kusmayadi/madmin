<?php defined('SYSPATH') or die('No direct script access.');

class Cobacobi_Controller_Role extends Controller_Admin {

	public function before()
	{
		parent::before();
		
		$this->template->module_title = 'Role';
	}
	
	public function action_index()
	{
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		
		$this->template->module_action_title = 'Roles';
		
		$total = DB::select()->from('roles')->select('COUNT("*") AS total')->execute()->get('total');
		
		$pagination = Pagination::factory($total, 20, $page);
		
		$roles = ORM::factory('role')->limit($pagination->get_limit())->offset($pagination->get_offset())->find_all();
		
		$pagination_view = new View_Pagination_Extended;
		$pagination_view->pagination = $pagination;
		$pagination_view->request = Request::factory()->current();
		
		$this->template->content = View::factory('role/list')
			->bind('roles', $roles)
			->bind('pagination', $pagination_view);
			
		$this->add_js('list.js');
	}
	
	public function action_create()
	{
	
		$this->template->module_action_title = __('Add New Role');
	
		$this->template->breadcrumbs = array(
			'user'	=> __('Roles'),
			'current' => $this->template->module_action_title
		);
		
		$post_data = array();
		$vars = array('module_action_title' => $this->template->module_action_title);
		
		if ($this->request->method() == 'POST')
		{
			
			$role = ORM::factory('role');

			try 
			{
				$role->create_role($_POST, array('name', 'description'));
				
				$this->request->redirect('role');
			}
			catch(ORM_Validation_Exception $e)
			{
				$post_data = $_POST;
				$post_data['errors'] = $e->errors('validation');
			}
			
		}
		
		$this->template->content = $this->display_form('role/form', $post_data, $vars);
		
	}
	
	public function action_update()
	{
		$this->template->module_action_title = __('Update Role');
	
		$this->template->breadcrumbs = array(
			'user'	=> __('Roles'),
			'current' => $this->template->module_action_title
		);
		
		$role_id = $this->request->param('id');
		
		$vars = array('module_action_title' => $this->template->module_action_title);
		
		if ($this->request->method() == 'POST')
		{
			
			$role = ORM::factory('role');

			try 
			{
				$role->update_role($_POST, array('name', 'description'));
				
				$this->request->redirect('role');
			}
			catch(ORM_Validation_Exception $e)
			{
				$post_data = $_POST;
				$post_data['errors'] = $e->errors('validation');
			}
			
		}
		else
		{
			$post_data = ORM::factory('role', $role_id)->as_array();
		}
		
		$this->template->content = $this->display_form('role/form', $post_data, $vars);
	}
	
	public function action_delete()
	{
	
	
	}

}