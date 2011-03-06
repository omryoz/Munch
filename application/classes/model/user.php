<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_User extends Model_Auth_User
{
	protected $_rules = array(
		'username' => array('not_empty' => NULL),
		'email' => array('not_empty' => NULL),
		'password' => array('not_empty' => NULL)
	);

	public function get_col()
	{
		return
				array(
						'username'   => array('col_name' => 'username','title' => 'Uset Name', 'type' => 'text'),
						'email'      => array('col_name' => 'email','title' => 'User Email', 'type' => 'text'),
						'password'   => array('col_name' => 'password','title' => 'User Password', 'type' => 'text')
				 )
		;
	}
	public function get_all_users()
	{
		return DB::select()->from('users')->as_object()->execute();
	}
	public function add_new($post)
	{
		$user = ORM::factory('user');
		$user->email = $post['email'];
		$user->username = $post['username'];
		if( ! empty($post['password']))
			$user->password = $post['password'];
		$user->save();
		$user->add('roles', ORM::factory('role', array('name' => 'login')));
		if (isset($post['user_role_admin']))
			$user->add('roles', ORM::factory('role', array('name' => 'admin')));
		if (isset($post['user_role_supadmin']))
			$user->add('roles', ORM::factory('role', array('name' => 'supadmin')));

	}
	public function edit($post)
	{
		$flag_admin = FALSE;
		$flag_supadmin = FALSE;

		$this->email = $post['email'];
		$this->username = $post['username'];
		if( ! empty($post['password']))
			$this->password = $post['password'];
		$this->save();
		$user_roles = DB::select()->from('roles_users')->where('user_id','=',$this->id)->execute()->as_array();
		// set the flags to the right value
		foreach($user_roles as $role)
		{
			if ($role['role_id'] == 2)
				$flag_admin = TRUE;
			if ($role['role_id'] == 3)
				$flag_supadmin = TRUE;
		}
		// add role if not exist
		if (isset($post['user_role_admin']) AND ! $flag_admin)
			$this->add('roles', ORM::factory('role', array('name' => 'admin')));
		if (isset($post['user_role_supadmin']) AND ! $flag_supadmin)
			$this->add('roles', ORM::factory('role', array('name' => 'supadmin')));
		// delete role if needed
		if ( ! isset($post['user_role_admin']) AND $flag_admin)
			DB::delete('roles_users')
				->where('user_id', '=', $this->id)
				->where('role_id', '=', 2)
				->execute();
		if ( ! isset($post['user_role_supadmin']) AND $flag_supadmin)
			DB::delete('roles_users')
				->where('user_id', '=', $this->id)
				->where('role_id', '=', 3)
				->execute();

	}
} // End User Model