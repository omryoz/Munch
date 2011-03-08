<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Ingredients extends Controller_Template_Admin
{
	
	public function action_add($id = NULL)
	{
		if ($this->_checkSupadmin())
            $admin_level=3;
        else
            $admin_level=2;
		//POST
		if ( ! empty($_POST))
		{
			// set ingredient to be new or old
			if ( ! empty($id))
			{
				$ingredient = ORM::factory('ingredient',$id);
				// check if the current user have access to change user details
				if(!$this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$ingredient->edit($_POST,$admin_level);
			}
			else
			{
				$ingredient = ORM::factory('ingredient');
				$ingredient->add_new($_POST,$admin_level);
			}
			// if user is new then add to table if old then update

			$this->request->redirect(Route::get('admin')->uri());

		}
		// NOT POST
		else
		{
			// flag for the role check boxes
			$flag_admin = FALSE;
			$flag_supadmin = FALSE;
			// IF user exist AND current user is trying to edit his profile THEN read all filed
			if ( ! empty($id))
				{
				$ingredient = ORM::factory('ingredient', $id);
                //$user = ORM::factory('user',$_SESSION['auth_user_munch']->id);
				$type = 'edit';
				// check if the current user have access to change user details
				if(  ! $this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}
              //  $ingredient_category = DB::select()->from('ingredient_Categorys')->where('id','=',$ingredient_cat_id)->execute()->as_array();
				// $_roles = DB::select()->from('roles_users')->where('user_id','=',$id)->execute()->as_array();
				// set the flags to the right value
				//foreach($user_roles as $role)
				{
				//	if ($role['role_id'] == 2)
				//		$flag_admin = TRUE;
				//	if ($role['role_id'] == 3)
				//		$flag_supadmin = TRUE;
				}
				$this->template->content = View::factory('admin/ingredients/add&edit')
										   ->set('ingredient',$ingredient)
                                           ->set('type',$type)
                                           ->set('id',$id)
                                           ->set('ingredient_cat_id',$ingredient->ingredient_cat_id)
                                           //->set('approval_level',$ingredient->approval_level)
										   ->set('arr_input',$ingredient->get_col());
			}
			// if rest not exist
			else
			{
                	if(  ! $this->_checkAdmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$ingredient = ORM::factory('ingredient');
				$this->template->content = View::factory('admin/ingredients/add&edit')
				->set('type','add')
                 ->set('ingredient',$ingredient)
                //->set('approval_level',$ingredient->approval_level)
                ->set('arr_input',$ingredient->get_col());
			}
		}
	}
}
