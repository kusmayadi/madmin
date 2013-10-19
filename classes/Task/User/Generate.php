<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Task for generating user
 *
 * It can accept the following options:
 * - username: Username. Default: admin
 * - password: Password. Default: 4dm1n
 * - name: User's name. Default: Administrator
 * - email: User's email. Default: admin@localhost
 * - role: User's role. Default: user
 *
 * @author    Kusmayadi (kusmayadi@cobacobi.com)
 * @copyright (c) 2013 Kusmayadi
 */
class Task_User_Generate extends Minion_Task
{
    protected $_options = array(
        'username' => NULL,
        'password' => NULL,
        'name' => NULL,
        'email' => NULL,
        'role' => NULL
    );

    protected function _execute(array $params)
    {
      if ( ! isset($params['username']))
        $params['username'] = 'admin';

      if ( ! isset($params['password']))
        $params['password'] = '4dm1n';

      if (! isset($params['name']))
        $params['name'] = 'Administrator';

      if ( ! isset($params['email']))
        $params['email'] = 'admin@localhost.com';

      if ( !isset($params['role']))
        $params['role'] = 'user';

      $user = ORM::factory('user');
      $user->username = $params['username'];
      $user->password = $params['password'];
      $user->name     = $params['name'];
      $user->email    = $params['email'];

      $user->save();

      // Add login role
      $role = ORM::factory('role')->where('name', '=', 'login')->find();
      $user->add('roles', $role);

      // Add aditional role
      if ($params['role'] != 'user' AND $params['role'] != 'login')
      {
        $role = ORM::factory('role')->where('name', '=', $params['role'])->find();
        $user->add('roles', $role);
      }

      Minion_CLI::write($params['username'] . ' is sucessfully created');
    }
}
