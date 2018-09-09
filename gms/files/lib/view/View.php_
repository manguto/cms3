<?php
namespace lib\view;

use manguto\cms3\gms\GMSPage;
use manguto\cms3\gms\GMSPageAdmin;

class View
{    
    static protected function Page(string $templateFilename,array $parameters=[]){
        $page = new GMSPage();
        $page->setTpl($templateFilename,$parameters);
    }    
    
    static protected function PageAdmin(string $templateFilename,array $parameters=[]){
        $page = new GMSPageAdmin();
        $page->setTpl($templateFilename,$parameters);
    }
}