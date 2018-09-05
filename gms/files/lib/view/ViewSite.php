<?php
namespace lib\view;

class ViewSite extends View
{    
    static function index()
    {
        View::Page("index");
    }
    
    static function home()
    {           
        View::Page("home");        
    }
}