<?php


namespace core\lib;


class conf
{
    static public $conf = [];

    /*
     * 判断配置文件是否存在、判断配置是否存在、缓存配置
     */
    static public function get($name, $file)
    {
        if (isset(self::$conf[$file])) {
            return self::$conf[$file][$name];
        } else {
            $path = PANDA . '/config/' . $file . '.php';
            if (is_file($path)) {
                $conf = include $path;
                if (isset($conf[$name])) {
                    self::$conf[$file] = $conf;
                    return $conf[$name];
                } else {
                    throw new \Exception('没有这个配置' . $name);
                }
            } else {
                throw new \Exception('找不到配置文件' . $file);
            }
        }
    }

    static public function all($file)
    {
        if (isset(self::$conf[$file])) {
            return self::$conf[$file];
        } else {

            $path = PANDA . '/config/' . $file . '.php';
            if (is_file($path)) {
                $conf = include $path;
                self::$conf[$file] = $conf;
                return $conf;
            } else {
                throw new \Exception('找不到配置文件' . $file);
            }
        }
    }
}