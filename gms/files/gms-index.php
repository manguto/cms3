<?php
session_start();
require_once ("vendor/autoload.php");
require_once 'gms-configurations.php';

use Slim\Slim;
use lib\control\Control;
use manguto\cms3\gms\GMSHelp;

try {
    
    { // PAGE STRUCTURAL DATA INITIALIZATION
        GMSHelp::Initialization();
    }
    
    { // SLIM FRAMEWORK CONTROL
        $app = new Slim();
        $app->config('debug', true);
        Control::Run($app);
        $app->run();
    }
} catch (\Throwable $e) { // \Exception | \Error |
    exceptionShow($e, true);
}
// !d($GLOBALS);
?>