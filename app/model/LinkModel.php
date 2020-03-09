<?php


namespace app\model;


use core\lib\model;

class LinkModel extends model
{
    private $table = 'blog_link';

    public function lists()
    {
        $ret=$this->select($this->table,'*');
        return $ret;
    }
}