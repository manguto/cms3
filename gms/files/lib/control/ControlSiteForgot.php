<?php
namespace lib\control;

use lib\model\User;
use manguto\cms3\lib\ProcessResult;
use manguto\cms3\gms\Page;
use lib\model\UserPasswordRecoveries;
use lib\view\ViewSiteForgot;

class ControlSiteForgot extends ControlSite
{
   
    static function get_forgot()
    {
        ViewSiteForgot::get_forgot();
    }

    static function post_forgot()
    {
        // deb($_POST);
        try {
            User::getForgot(trim($_POST['email']), false);
            headerLocation('/forgot/sent');
            exit();
        } catch (\Exception $e) {
            ProcessResult::setError($e);
            headerLocation('/forgot');
            exit();
        }
    }

    static function get_forgot_sent()
    {   
        {
            $email = User::getForgotEmail();
            $emailInfo = explode('@', $email);
            $emailUrl = $emailInfo[1];
            $emailInfo2 = explode('.', $emailUrl);
            $emailName = ucfirst($emailInfo2[0]);
        }
        ViewSiteForgot::get_forgot_sent($email, $emailUrl, $emailName);
    }

    static function get_forgot_reset()
    {   
        //deb($_GET,0);
        $code = $_GET['code'];

        try {
            $user = User::validForgotDecrypt($code);
            $page = new Page();
            $page->setTpl("forgot-reset", [
                'form_action' => '/forgot/reset',
                'name' => $user->getname(),
                'code' => $code
            ]);
        } catch (\Exception $e) {
            //deb($e);
            ProcessResult::setError($e);
            headerLocation('/forgot');
            exit();
        }
    }

    static function post_forgot_reset()
    {
        $code = $_POST['code'];

        try {
            $user = User::validForgotDecrypt($code);            
            UserPasswordRecoveries::setForgotUsed($user->getrecoveryid());
            $user->setPassword(User::password_crypt($_POST['password']));
            $user->save();
            ViewSiteForgot::post_forgot_reset();
        } catch (\Exception $e) {
            ProcessResult::setError($e);
            headerLocation('/forgot');
            exit();
        }
    }
}

?>