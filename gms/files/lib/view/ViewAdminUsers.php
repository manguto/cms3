<?php
namespace lib\view;

class ViewAdminUsers extends View
{

    static function get_admin_users($users)
    {   
        View::PageAdmin("users", [
            'users' => $users
        ]);
    }
    
    static function get_admin_users_create()
    {
        View::PageAdmin("users-create", [
            'temp' => 'usuario' . date("is")
        ]);
    }
    static function get_admin_user($user)
    {   
        View::PageAdmin("users-view", [
            'user' => $user->getData()
        ]);        
    }
    
    static function get_admin_user_edit($user)
    {   
        View::PageAdmin("users-update", [
            'user' => $user->getData()
        ]);
    }
}