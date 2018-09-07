<?php
namespace lib\control;

use lib\model\User;
use manguto\cms3\lib\ProcessResult;
use lib\view\ViewSiteLogin;

class ControlSiteLogin extends ControlSite
{

    static function get_login()
    {   
        ViewSiteLogin::get_login();
    }

    static function post_login()
    {   
        //deb($_POST);
        try {            
            User::login($_POST['login'], $_POST['password']);
            
            if (checkUserLoggedAdmin()) {
                headerLocation('/');
                exit();
            } else {
                headerLocation('/');                
                exit();
            }
        } catch (\Exception $e) {     
            ProcessResult::setError($e);
            headerLocation('/login');
            exit();
        }
    }

    static function get_logout()
    {
        User::logout();
        headerLocation("/login");
        exit();
    }
   
}

?>