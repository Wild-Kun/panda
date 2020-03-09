<?php
/*
 * 入口文件
 * 1.定义常量
 * 2.加载函数库
 * 3.启动框架
 */
define('PANDA', str_replace('\\', '/', dirname(realpath(__FILE__))));
define('CORE', PANDA . '/core');
define('APP', PANDA . '/app');
define('MODULE', 'app');

include "vendor/autoload.php";

define('DEBUG', true);
if (DEBUG) {
    $whoops = new \Whoops\Run;
    $errorTitle="框架出错了";
    $option=new \Whoops\Handler\PrettyPageHandler();
    $option->setPageTitle($errorTitle);
    $whoops->pushHandler($option);
//    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
    ini_set('display_errors', 'On');
} else {
    ini_set('display_errors', 'Off');
}

include CORE . '/common/function.php';

include CORE . '/panda.php';

spl_autoload_register('\core\panda::load');


\core\panda::run();
