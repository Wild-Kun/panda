<?php

namespace core\lib\drive\log;

use core\lib\conf;

class file
{
    public $path;//日志存储位置

    public function __construct()
    {
        $conf = conf::get('OPTION', 'log');
        $this->path = $conf['PATH'];
    }

    /*
     * 确定文件存储位置是否存在、新建目录、写入日志
     */
    public function log($message, $file)
    {
        $path=$this->path.date('YmdH');
        if (!is_dir($path)) {
            mkdir($path, '0777', true);
        }
        $log_path=$path . '/'.$file . '.txt';
        $log_content=date('Y-m-d H:i:s ').json_encode($message).PHP_EOL;
        return file_put_contents($log_path, $log_content,FILE_APPEND);
    }
}