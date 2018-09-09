<?php
namespace lib\control;

use lib\model\User;

class Control
{

    static function Run($app)
    {
        Control::FIX_REQUEST_URI();
        // ================================================================================================================ General
        // ================================================================================================================ General
        // ================================================================================================================ General
        Control::RunLog($app);

        // ==================================================================== SITE - Front End
        // ==================================================================== SITE - Front End
        // ==================================================================== SITE - Front End
        ControlSite::Run($app); 

        // ================================================================= SITE - Back End
        // ================================================================= SITE - Back End
        // ================================================================= SITE - Back End
        ControlAdmin::Run($app);
    }

    // ============================================================================================ ROUTES - LOG
    // ============================================================================================ ROUTES - LOG
    // ============================================================================================ ROUTES - LOG
    static private function RunLog($app)
    {
        $app->get('/log', function () {
            headerLocation('/log/index.php');
            exit();
        });
        $app->get('/admin/log', function () {
            headerLocation('/log/index.php');
            exit();
        });
    }

    

    // ============================================================================================ ACCESS CONTROL
    // ============================================================================================ ACCESS CONTROL
    // ============================================================================================ ACCESS CONTROL
    protected static function LoggedZone()
    {
        if (! User::checkUserLoggedAndAllowed(false)) {
            headerLocation('/login');
            exit();
        }
    }

    protected static function LoggedAdminZone()
    {
        if (! User::checkUserLoggedAndAllowed(true)) {
            headerLocation('/admin/login');
            exit();
        }
    }
    
    // ============================================================================================ AUX
    // ============================================================================================ AUX
    // ============================================================================================ AUX
    
    /**
     * caso a REQUEST_URI possuma uma "/" no seu final, remove-a
     * para evitar erros desnecessarios de roteamento
     */
    static private function FIX_REQUEST_URI()
    {
        { // Ajuste do endereco com "/" no final
            if (substr($GLOBALS['_SERVER']['REQUEST_URI'], - 1, 1) == '/') {
                $GLOBALS['_SERVER']['REQUEST_URI'] = substr($GLOBALS['_SERVER']['REQUEST_URI'], 0, - 1);
            }
        }
    }
}

?>