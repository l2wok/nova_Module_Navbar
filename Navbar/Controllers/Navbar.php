<?php

namespace App\Modules\Navbar\Controllers;

use App\Modules\Navbar\Controllers\HtmlNav;
use Config;

class Navbar extends HtmlNav
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public static function getStaticAfterBody()
    {
        $nav = new Navbar();
        return $nav->getAfterBody();
    }

    public function getAfterBody()
    {
        
        return $this->open
                . $this->middle
                . $this->right
                . $this->close;
    }

}
