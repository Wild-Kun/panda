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
define('MODULE',  'app');

define('DEBUG', true);
if (DEBUG) {
    ini_set('display_errors', 'On');
} else {
    ini_set('display_errors', 'Off');
}

include CORE . '/common/function.php';

include CORE . '/panda.php';

spl_autoload_register('\core\panda::load');


\core\panda::run();
