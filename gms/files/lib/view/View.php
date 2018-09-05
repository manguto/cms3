<?php
namespace lib\view;

use manguto\gms\Page;
use manguto\gms\PageAdmin;

class View
{    
    static protected function Page(string $templateFilename,array $parameters=[]){
        $page = new Page();
        $page->setTpl($templateFilename,$parameters);
    }    
    
    static protected function PageAdmin(string $templateFilename,array $parameters=[]){
        $page = new PageAdmin();
        $page->setTpl($templateFilename,$parameters);
    }
}