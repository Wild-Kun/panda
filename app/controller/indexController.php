<?php

namespace app\controller;

use core\panda;
use app\model\LinkModel;

class indexController extends panda
{
    public function index()
    {

//        $model = new  LinkModel();
//        $ret = $model->lists();
//        dump($ret);

        $data = 'hello world';
        $title = '视图文件';
        $this->assign('data', $data);
        $this->assign('title', $title);
        $this->view('index/index.html');

//        d($ret);
    }
}
