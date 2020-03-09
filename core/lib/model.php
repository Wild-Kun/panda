<?php


namespace core\lib;


use Medoo\Medoo;

class model extends medoo
{
    public function __construct()
    {
        $option = conf::all('database');

//        try {
//            parent::__construct($dsn, $username, $passwd);
//        } catch (\PDOException $e) {
//            d($e->getMessage());
//        }
        parent::__construct($option);
    }

}