<?php

namespace core\lib;

class route
{
    public $controller;
    public $action;

    /*
     * 隐藏index.php、获取参数、返回对应的控制器和方法
     */
    public function __construct()
    {
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
            $path = $_SERVER['REQUEST_URI'];
            $patharr = explode('/', trim($path, '/'));
            if (isset($patharr[0])) {
                $this->controller = $patharr[0];
                unset($patharr[0]);
            }
            if (isset($patharr[1])) {
                $this->action = $patharr[1];
                unset($patharr[1]);
            } else {
                $this->action = conf::get('ACTION','route');
            }
            //url多余部分转换成get
            $count = count($patharr) + 2;
            $i = 2;
            while ($i < $count) {
                if(isset($patharr[$i + 1])){
                    $_GET[$patharr[$i]] = $patharr[$i + 1];
                }
                $i += 2;
            }
        } else {
            $this->controller = conf::get('CTRL','route');
            $this->action = conf::get('ACTION','route');
        }
    }
}