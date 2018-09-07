<?php

namespace manguto\cms3\gms;


class PageHelp{
    
    static function Initialization(){
                
        if(defined('VIRTUAL_HOST_ACTIVE')){
            
            define('ROOT', PageHelp::ROOT());
            
            define('ROOT_ACTION', PageHelp::ROOT_ACTION());
            
            define('ROOT_LOCATION', PageHelp::ROOT_LOCATION());
            
            define('ROOT_TPL', PageHelp::ROOT_TPL());
            
        }else{
            throw new \Exception("A constante 'VIRTUAL_HOST_ACTIVE' não foi definida. Defina-a e tente novamente.");
        }
    }
    
    //------------------------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------------------------------
    
    private static function ROOT()
    {
        if (VIRTUAL_HOST_ACTIVE) {
            $uri_levels = explode('/', $_SERVER['REQUEST_URI']);
            $return = str_repeat('..' . DIRECTORY_SEPARATOR, sizeof($uri_levels) - 1);
        } else {
            $return = '/'.SIS_FOLDERNAME;
        }
        // die($return);
        return $return;
    }
    
    private static function ROOT_ACTION(){
        if (VIRTUAL_HOST_ACTIVE) {
            $return = '';
        } else {
            $return = '/'.SIS_FOLDERNAME;
        }
        // die($return);
        return $return;
    }
    
    private static function ROOT_LOCATION(){
        if (VIRTUAL_HOST_ACTIVE) {
            $return = '';
        } else {
            $return = '/'.SIS_FOLDERNAME;
        }
        // die($return);
        return $return;
    }
    
    private static function ROOT_TPL()
    {
        if (VIRTUAL_HOST_ACTIVE) {
            $return = $_SERVER['DOCUMENT_ROOT'];
        } else {
            $return = '../'.SIS_FOLDERNAME;
        }
        // die($return);
        return $return;
    }

    //------------------------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------------------------------
    
   
    
}



?>