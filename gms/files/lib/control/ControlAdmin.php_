<?php
namespace lib\control;

use lib\view\ViewAdmin;

class ControlAdmin extends Control
{

    static function Run($app)
    {
        $app->get('/admin', function () {
            ControlAdmin::index();
        });

        // ================================================ login
        $app->get('/admin/login', function () {
            ControlAdminLogin::get_admin_login();
        });
        $app->post('/admin/login', function () {
            ControlAdminLogin::post_admin_login();
        });
        $app->get('/admin/logout', function () {
            ControlAdminLogin::get_admin_logout();
        });

        // ================================================ profile
        $app->get('/admin/profile', function () {
            ControlAdminProfile::get_admin_profile();
        });
        $app->post('/admin/profile', function () {
            ControlAdminProfile::post_admin_profile();
        });
        $app->get('/admin/profile/change-password', function () {
            ControlAdminProfile::get_admin_profile_change_password();
        });
        $app->post('/admin/profile/change-password', function () {
            ControlAdminProfile::post_admin_profile_change_password();
        });

        // ================================================ users
        $app->get('/admin/users', function () {
            ControlAdminUsers::get_admin_users();
        });

        $app->get('/admin/users/create', function () {
            ControlAdminUsers::get_admin_users_create();
        });

        $app->post('/admin/users/create', function () {
            ControlAdminUsers::post_admin_users_create();
        });

        $app->get('/admin/users/:userid', function ($userid) {
            ControlAdminUsers::get_admin_user($userid);
        });

        $app->get('/admin/users/:userid/delete', function ($userid) {
            ControlAdminUsers::get_admin_user_delete($userid);
        });

        $app->get('/admin/users/:userid/edit', function ($userid) {
            ControlAdminUsers::get_admin_user_edit($userid);
        });

        $app->post('/admin/users/:userid/edit', function ($userid) {
            ControlAdminUsers::post_admin_user_edit($userid);
        });
    }

    // ================================================================================= MAIN ROUTES
    // ================================================================================= MAIN ROUTES
    // ================================================================================= MAIN ROUTES
    static private function index()
    {
        Control::LoggedAdminZone();        
        ViewAdmin::index();
    }
}

?>