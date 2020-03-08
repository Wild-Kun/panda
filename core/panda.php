<?php

namespace core;

class panda
{
    public static $classMap = array();
    public $assign;

    static public function run()
    {
        $route = new \core\lib\route();
        $model = new \core\lib\model();
        $controllerClass = $route->controller;
        $action = $route->action;
        $controllerfile = APP . '/controller/' . $controllerClass . 'Controller.php';
        $class = '\\' . MODULE . '\controller\\' . $controllerClass . 'Controller';
        if (is_file($controllerfile)) {
            include $controllerfile;
            $controller = new $class;
            $controller->$action();
        } else {
            throw  new \Exception('找不到控制器' . $controllerClass);
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
        $file=APP.'/view/'.$file;
        if(is_file($file)){
            extract($this->assign);
            include $file;
        }
    }
}