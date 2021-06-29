<?php

namespace core\lib;

//use Medoo\Medoo;

/**
 * Class model
 * @package core\lib
 * 模型类
 * 连接数据库等
 */
class model extends \Medoo\Medoo
{
    public function __construct()
    {

        $option = config::all('database');  //all()是config类中的静态方法
        parent::__construct($option);    //连接数据库,传入数组
        \core\lib\log::log('    link_type:'.$option['type'].'   username:'.$option['username'].'    database:'.$option['database'],'datalink');  //记录日志文件


    }
}


/*class model extends PDO
{
    public function __construct()
    {
//        $dsn='mysql:host=localhost;dbname=tabletest';
//        $username = 'root';
//        $password = 'root';
        try {
            $database = config::all('database');  //all()是config类中的静态方法
//            p($database);
            //            parent::__construct($dsn, $username, $password);
            parent::__construct($database['DSN'], $database['USERNAME'], $database['PASSWD']);
        } catch (PDOException $e) {
            p($e->getMessage());
        }

    }
}*/