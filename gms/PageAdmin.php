<?php

namespace manguto\cms3\gms;

class PageAdmin extends Page
{

    public function __construct($opts = array(), $tpl_dir = '/tpl/admin/')
    {   
        parent::__construct($opts,$tpl_dir);
    }
}

?>