<?php

namespace core;

use core\lib\log;

class panda
{
    public static $classMap = array();
    public $assign;

    static public function run()
    {
        log::init();//启动日志类
        $route = new \core\lib\route();
        $model = new \core\lib\model();
        $ctrlClass = $route->controller;
        $action = $route->action;
        $ctrlFile = APP . '/controller/' . $ctrlClass . 'Controller.php';
        $class = '\\' . MODULE . '\controller\\' . $ctrlClass . 'Controller';
        if (is_file($ctrlFile)) {
            include $ctrlFile;
            $controller = new $class;
            $controller->$action();
            log::log('ctrl:' . $ctrlClass . ' action:' . $action);
        } else {
            throw  new \Exception('找不到控制器' . $ctrlClass);
        }
    }

    static function load($class)
    {
        //自动加载类库
        if (isset($classMap[$class])) {
            return true;
        } else {
            $class = str_replace('\\', '/', $class);
            $file = PANDA . '/' . $class . '.php';
            if (is_file($file)) {
                include $file;
                self::$classMap[$class] = $class;
            } else {
                return false;
            }
        }
    }

    public function assign($name, $value)
    {
        $this->assign[$name] = $value;

    }

    public function view($file)
    {
        $file = APP . '/view/' . $file;
        if (is_file($file)) {
//            \Twig_Autoloader::register();

            $loader = new \Twig_Loader_Filesystem(APP . '/view/');
            $twig = new \Twig_Environment($loader, array(
                'cache' => PANDA . '/log/twig',
                'debug' => DEBUG
            ));
            $template = $twig->load($file);
            $template->display($this->assign ? $this->assign : '');
        }
    }
}