<?php
namespace lib\control;

use lib\model\User;
use manguto\lib\ProcessResult;
use manguto\repository\Repository;
use lib\view\ViewAdminUsers;

class ControlAdminUsers extends ControlAdmin
{

    
    static function get_admin_users()
    {
        Control::LoggedAdminZone();
        $users = Repository::getRepository('user','',false);        
        ViewAdminUsers::get_admin_users($users);
    }

    static function get_admin_users_create()
    {
        Control::LoggedAdminZone();        
        ViewAdminUsers::get_admin_users_create();
    }

    static function post_admin_users_create()
    {
        //deb($_POST,0);        
        Control::LoggedAdminZone();
        // fix - form adminzoneaccess (checkbox)
        $_POST['adminzoneaccess'] = ! isset($_POST['adminzoneaccess']) ? 0 : 1;
        // password crypt
        $_POST['password'] = User::password_crypt($_POST['password']);        
        //deb($_POST);
        
        try {
            $user = new User();
            $user->setData($_POST);
            $user->verifyFieldsToCreateUpdate();
            //deb($user);
            $user->save();
            ProcessResult::setSuccess("Usuário salvo com sucesso!");
            headerLocation("/admin/users");
            exit();
        } catch (\Exception $e) {
            ProcessResult::setError($e);
            headerLocation("/admin/users/create");
            exit();
        }
    }

    static function get_admin_user($userid)
    {
        Control::LoggedAdminZone();
        $user = new User($userid);
        ViewAdminUsers::get_admin_user($user);        
    }

    static function get_admin_user_edit($userid)
    {
        Control::LoggedAdminZone();
        $user = new User($userid);        
        ViewAdminUsers::get_admin_user_edit($user);
    }

    static function post_admin_user_edit($userid)
    {
        Control::LoggedAdminZone();
        // fix - form adminzoneaccess (checkbox)
        $_POST['adminzoneaccess'] = ! isset($_POST['adminzoneaccess']) ? 0 : 1;
        try {
            $user = new User($userid);
            $user->setData($_POST);
            $user->verifyFieldsToCreateUpdate();
            $user->save();
            ProcessResult::setSuccess("Usuário atualizado com sucesso!");
            headerLocation("/admin/users");
            exit();
        } catch (\Exception $e) {
            ProcessResult::setError($e);
            headerLocation("/admin/users/create");
            exit();
        }
    }

    static function get_admin_user_delete($userid)
    {
        Control::LoggedAdminZone();
        $user = new User($userid);
        $user->delete();
        ProcessResult::setSuccess("Usuário removido com sucesso!");
        headerLocation("/admin/users");
        exit();
    }

}

?>