<?php defined('SYSPATH') or die('No direct script access.');

class Cobacobi_Controller_User extends Controller_Admin {

    public function before()
    {
        parent::before();
        
        $this->template->module_title = __('User');
        
    }
    
    public function action_index()
    {
    
        $this->template->module_action_title = __('Users');
        
        $page = $this->request->param('p') ? $this->request->param('p') : 1;
        $perpage = $this->request->param('per_page') ? $this->request->param('per_page') : 20;
        
        $users = ORM::factory('User');
        
        $pagination = Pagination::factory(
            $users, 
            $page, 
            'default', 
            array(
                'controller' => strtolower($this->request->controller())
            ), 
            $perpage
        );
        
        $pagination->route_page_param = 'p';
        
        $this->template->content = View::factory('user/list')
            ->set('users', $users)
            ->set('pagination', $pagination);
            
        $this->add_js('list.js');
    }
    
    public function action_create()
    {
    
        $this->template->module_action_title = __('Add New User');
    
        $this->template->breadcrumbs = array(
            'user'  => __('Users'),
            'current' => $this->template->module_action_title
        );
        
        $roles = ORM::factory('Role')->find_all();
        
        $post_data = array();
        $vars = array('module_action_title' => $this->template->module_action_title, 'roles' => $roles);
        
        if ($this->request->method() == 'POST')
        {
            $user = ORM::factory('User');

            try 
            {
                $user->create_user($this->request->post(), array('username', 'password', 'name', 'email'));

                if ($this->request->post('role'))
                {
                    foreach ($this->request->post('role') as $submittedrole)
                    {
                        $role = ORM::factory('Role', $submittedrole);
                        $user->add('roles', $role->id);
                    }
                }
                
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
            'user'  => __('Users'),
            'current' => $this->template->module_action_title
        );
        
        $roles = ORM::factory('Role')->find_all();
        
        $user_id = $this->request->param('id');
        
        $user = ORM::factory('User', $user_id);
        
        $vars = array('module_action_title' => $this->template->module_action_title, 'roles' => $roles);
        
        if ($this->request->method() == 'POST')
        {
            try
            {
                $user->update_user($_POST, array('username', 'password', 'name', 'email'));

                // Add role to user

                // Remove existing role first
                $roles = ORM::factory('Role')->find_all();

                foreach ($roles as $role)
                {
                    if ($user->has('roles', $role))
                        $user->remove('roles', $role);
                }

                if ($this->request->post('role'))
                {
                    foreach ($this->request->post('role') as $submittedrole)
                    {
                        $role = ORM::factory('Role', $submittedrole);
                        
                        // Add role
                        $user->add('roles', $role);
                    }
                }
                
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
        $ids = $this->request->query('ids');

        if (! is_null($ids))
        {
            $users = ORM::factory('User')->where('id', 'in', DB::expr('('.$ids.')'))->find_all();
            $roles = ORM::factory('Role')->find_all();

            foreach ($users as $user) {
                // Remove relationship to model
                foreach ($roles as $role) {
                    if ($user->has('roles', $role))
                        $user->remove('roles', $role);
                }

               $user->delete();
            }
        }

        HTTP::redirect('user');
    }

}
