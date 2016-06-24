<?php

namespace App\Modules\Navbar\Controllers;

use Auth;
use Config;
use Session;

class HtmlNav
{

    public $open;
    public $brand;
    public $close;
    public $middle;
    public $right;
    protected $isLogin = null;

    public function __construct()
    {
        if(Auth::user())
        {
            $this->isLogin = true;
        }
        $this->fullSet();
    }

    private function fullSet()
    {
        $this->setBrand(Config::get('navbar.brand'));
        $this->setOpen(Config::get('navbar.class'));
        $this->setMiddle(Config::get('navbar.first'));
        $this->setRight(Config::get('navbar.last'));
        $this->setClose();
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    public function setOpen($class)
    {
        $brand      = $this->getBrand();
        $name       = $brand['name'];
        $strnk      = $brand['href'];
        $openNav    = "<nav class='navbar $class ' role='navigation'>
    <div class='container'>
        <div class='navbar-header'>
            <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
                <span class='sr-only'>Toggle navigation</span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
            </button>
            <a class='navbar-brand' href='$strnk'> $name</a>
        </div>
        <div class='collapse navbar-collapse'>";
        $this->open = (string) $openNav;
    }

    public function setClose()
    {
        $this->close = "</div><!-- /.collapse navbar-collapse -->
    </div><!-- /.container -->
</nav>";
    }

    public function setMiddle($middle)
    {
        $this->middle = $this->htmlUl($middle);
    }

    public function setRight($right)
    {
        $lang = "";
        if(isset($right['language']) && $right['language'])
        {
            $lang = $this->htmlLi($this->getLang());
            unset($right['language']);
        }
        $this->right = $this->htmlUl($lang . $this->htmlLi($right), TRUE);
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function getOpen()
    {
        return $this->open;
    }

    public function htmlLi($data, $root = '/')
    {
        $str = "";
        if(is_array($data))
        {
            foreach ($data as $li)
            {
                if(isset($li['onlogin']) && $li['onlogin'] && is_null($this->isLogin))
                {
                    continue;
                }
                elseif(isset($li['onlogin']) && !$li['onlogin'] && !is_null($this->isLogin))
                {
                    continue;
                }
                else
                {
                    if(!isset($li['childs']))
                    {
                        if(!isset($li['divider']))
                        {
                            if(isset($li['active'])){
                                $str .= "\n<li class='".$li['active']."'><a href='" . $root . $li['href'] . "'>" . __d('navbar', $li['name']) . "</a></li>";   
                            } else {
                                $str .= "\n<li class=''><a href='" . $root . $li['href'] . "'>" . __d('navbar', $li['name']) . "</a></li>";
                            }
                        }
                        else
                        {
                            $str .= "\n<li role='separator' class='divider'></li>";
                        }
                    }
                    else
                    {
                        $root = (string) $root . $li['href'] . '/';
                        $str .= "\n<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>"
                                . __d('navbar', $li['name']) . " <i class='fa fa-caret-down' aria-expanded='false'></i></a>"
                                . "<ul class='dropdown-menu'>"
                                . $this->htmlLi($li['childs'], $root)
                                . "</ul>"
                                . "\n</li>";
                    }
                }
            }
        }
        return $str;
    }

    public function htmlUl($data, $pullRight = null)
    {
        if(is_null($pullRight))
        {
            if(is_array($data))
            {
                return "\n<ul class='nav navbar-nav'>" . $this->htmlLi($data) . "</ul>";
            }
            elseif(is_string($data))
            {
                return "\n<ul class='nav navbar-nav'>" . $data . "</ul>";
            }
        }
        else
        {
            if(is_array($data))
            {
                return "\n<ul class='nav navbar-nav navbar-right'>" . $this->htmlLi($data) . "</ul>";
            }
            elseif(is_string($data))
            {
                return "\n<ul class='nav navbar-nav navbar-right'>" . $data . "</ul>";
            }
        }
    }

    public function getLang()
    {
        if(!$now = Session::get('language'))
        {
            $now = LANGUAGE_CODE;
        }
        $languages = Config::get('languages');
        $data[0]   = [
            "href" => 'language',
            "name" => 'Language'
        ];
        foreach ($languages as $key => $value)
        {
            $active = NULL;
            if($key === $now)
            {
                $active = "active";
            }
            $data[0]['childs'][] = ["name" => $value['name'], "href" => $key,"active"=>$active];
        }
        return $data;
    }

}
