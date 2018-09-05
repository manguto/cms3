<?php
namespace lib\view;

class ViewSiteProfile extends View
{

    static function get_profile($user)
    {
        View::Page("profile", [
            'user' => $user->getData(),
            'form_action' => '/profile',
            'link_change_password' => '/profile/change-password'
        ]);
    }

    static function get_profile_change_password()
    {   
        View::Page("profile-change-password", [
            'form_action' => '/profile/change-password'
        ]);
    }
}