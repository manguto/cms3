<?php
namespace lib\view;

class ViewAdmin extends View
{    
    static function index()
    {
        View::PageAdmin("index");
    }
    
    static function home()
    {           
        View::PageAdmin("home");        
    }
}