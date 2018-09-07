<?php
namespace lib\view;

use manguto\cms3\gms\Page;
use manguto\cms3\gms\PageAdmin;

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