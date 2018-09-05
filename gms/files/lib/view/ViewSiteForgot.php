<?php
namespace lib\view;

class ViewSiteForgot extends View
{

    static function get_forgot()
    {
        View::Page("forgot", [
            'form_action' => '/forgot'
        ]);
    }

    static function get_forgot_sent($email, $emailUrl, $emailName)
    {
        View::Page("forgot-sent", [
            'email' => $email,
            'emailUrl' => 'http://' . $emailUrl,
            'emailName' => $emailName
        ]);
    }

    static function post_forgot_reset()
    {
        View::Page("forgot-reset-success", [
            'link_form_login' => '/login'
        ]);
    }
}