<?php

namespace app\controller;

use core\lib\model;
use core\panda;

class indexController extends panda
{
    public function index()
    {
//        $model = new model();
//        $sql = 'SELECT * FROM blog_link';
//        $ret = $model->query($sql)->fetchAll();

        $data = 'hello world';
        $title = '视图文件';
        $this->assign('data', $data);
        $this->assign('title', $title);
        $this->view('index/index.php');
    }
}
