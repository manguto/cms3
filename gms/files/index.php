<?php

session_start();
require_once ("vendor/autoload.php");
require_once 'gms-functions.php';
require_once 'gms-configurations.php';
require_once 'gms-initialization.php';

use Slim\Slim;
use lib\control\Control;

try {    
        
    {// SLIM FRAMEWORK CONTROL
        $app = new Slim();
        $app->config('debug', true);
        Control::Run($app);
        $app->run();
    }
    
} catch (\Throwable $e) { //\Exception | \Error | 
    exceptionShow($e,true);
}
//!d($GLOBALS);
?>