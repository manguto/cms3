<?php
namespace lib\view;

class ViewAdminProfile extends View
{

    static function get_admin_profile($user)
    {
        View::Page("profile", [
            'user' => $user->getData(),
            'form_action' => '/admin/profile',
            'link_change_password' => '/admin/profile/change-password'
        ]);
    }

    static function get_admin_profile_change_password()
    {   
        View::Page("profile-change-password", [
            'form_action' => '/admin/profile/change-password'
        ]);        
    }
}