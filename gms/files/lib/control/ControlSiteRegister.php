<?php
namespace lib\control;

use lib\model\User;
use Rain\Tpl\Exception;
use manguto\lib\ProcessResult;
use lib\view\ViewSiteRegister;

class ControlSiteRegister extends ControlSite
{

    static function get_register()
    {        
        
        if (isset($_SESSION[SIS_ABREV]['registerFormValues'])) {
            $registerFormValues = $_SESSION[SIS_ABREV]['registerFormValues'];
            unset($_SESSION[SIS_ABREV]['registerFormValues']);
        } else {
            $registerFormValues = [
                'name' => '',
                'email' => '',
                'phone' => ''
            ];
        }        
        ViewSiteRegister::get_register($registerFormValues);
    }
    static function post_register()
    {
        throw new Exception("A criação de novos usuários está desabilitada até segunda ordem. Obrigado!");
        
        //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
        //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
        //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<        
        // -------------montagem do usuario 
        $user = new User();

        $user->setData([
            'adminzoneaccess' => 0,
            'name' => $_POST['name'],
            'login' => $_POST['email'],
            'email' => $_POST['email'],
            'password' => User::password_crypt($_POST['password']),
            'phone' => $_POST['phone']
        ]);
        // deb($user,0);
        // ------------- verificacao de parametros enviados
        try {
            $user->verifyFieldsToCreateUpdate();
            $user->save();
            ProcessResult::setSuccess("Cadastro realizado com sucesso!<br/>Seja bem vindo(a) à nossa plataforma!!");
            User::login($_POST['email'], $_POST['password']);
            headerLocation('/');            
            exit();
        } catch (\Exception $e) {
            ProcessResult::setError($e);
            headerLocation('/login');
            exit();
        }
    }
}

?>