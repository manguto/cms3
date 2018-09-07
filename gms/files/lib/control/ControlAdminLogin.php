<?php
namespace lib\control;

use lib\model\User;
use manguto\cms3\lib\ProcessResult;
use lib\view\ViewAdminLogin;

class ControlAdminLogin extends ControlAdmin
{

    static function get_admin_login()
    {
        ViewAdminLogin::get_admin_login();
    }

    static function post_admin_login()
    {
        try {            
            User::login($_POST['login'], $_POST['password']);
            if (checkUserLoggedAdmin()) {
                headerLocation('/');
            } else {
                // nao eh permitido o login de usuario nao admin através deste formulario
                ProcessResult::setError("O login de usuários padrão, deve ser realizado através do formulário abaixo.");
                User::logout();
                headerLocation('/login');
            }
        } catch (\Exception $e) {
            ProcessResult::setError($e);
            headerLocation('/admin/login');
        }

        exit();
    }

    static function get_admin_logout()
    {
        User::logout();
        headerLocation("/admin/login");
        exit();
    }
}

?>