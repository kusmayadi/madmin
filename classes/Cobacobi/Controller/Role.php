<?php defined('SYSPATH') or die('No direct script access.');

class Cobacobi_Controller_Role extends Controller_Admin {

  public function before()
  {
    parent::before();

    $this->template->module_title = 'Role';
  }

  public function action_index()
  {
    $this->template->module_action_title = 'Roles';

    $page = $this->request->param('p') ? $this->request->param('p') : 1;
    $perpage = $this->request->param('per_page') ? $this->request->param('per_page') : 20;

    $roles = ORM::factory('Role');

    $pagination = new Pagination(
      $roles,
      $page,
      'defaultlist',
      array(
        'controller' => strtolower($this->request->controller())
      ),
      $perpage
    );

    $pagination->route_page_param = 'p';

    $this->template->content = View::factory('role/list')
      ->set('roles', $roles)
      ->set('pagination', $pagination);

    $this->add_js('list.js');
  }

  public function action_create()
  {

    $this->template->module_action_title = __('Add New Role');

    $this->template->breadcrumbs = array(
      'user'  => __('Roles'),
      'current' => $this->template->module_action_title
    );

    $post_data = array();
    $vars = array('module_action_title' => $this->template->module_action_title);

    if ($this->request->method() == 'POST')
    {

      $role = ORM::factory('Role');

      try
      {
        $role->values($_POST, array('name', 'description'))->create();

        HTTP::redirect('role');
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
      'user'  => __('Roles'),
      'current' => $this->template->module_action_title
    );

    $role_id = $this->request->param('id');
    $role = ORM::factory('Role', $role_id);

    $vars = array('module_action_title' => $this->template->module_action_title);

    if ($this->request->method() == 'POST')
    {
      try
      {
        $role->values($_POST, array('name', 'description'))->update();

        HTTP::redirect('role');
      }
      catch(ORM_Validation_Exception $e)
      {
        $post_data = $_POST;
        $post_data['errors'] = $e->errors('validation');
      }

    }
    else
    {
      $post_data = ORM::factory('Role', $role_id)->as_array();
    }

    $this->template->content = $this->display_form('role/form', $post_data, $vars);
  }

  public function action_delete()
  {
    $ids = $this->request->query('ids');

    if (! is_null($ids))
    {
      $roles = ORM::factory('Role')->where('id', 'in', DB::expr('('.$ids.')'))->find_all();
      $users = ORM::factory('User')->find_all();

      foreach ($roles as $role) {
        // Remove relationship to user
        if ($role->removable)
        {
          foreach ($users as $user) {
            if ($user->has('roles', $role))
              $user->remove('roles', $role);
          }

          $role->delete();
        }
      }
    }

    HTTP::redirect('role');

  }

}
