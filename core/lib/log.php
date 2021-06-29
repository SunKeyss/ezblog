<?php

namespace core\lib;

/**
 * Class log
 * @package core\lib
 * 日志类,应用服务类
 */
class log
{
    static $class; // 存放new出来的class实例

    /**
     * @throws \Exception
     * 日志类的初始化方法，在icetrack.php这个基类中调用
     */
    static public function init()
    {
        //确定存储的方式,即初始化方法
        $drive = config::get('DRIVE', 'log');   //log是文件的名称,此处返回的是file
        $class = '\core\lib\drive\log\\' . $drive;
//        p($class);
        self::$class = new $class;
    }

    /**
     * @param $name 写入文件的内容message
     * @param $file 日志文件的名称,初始化的值是log,可覆盖
     */
    static public function log($name, $file='log')
    {
//        p(isset(self::$class)); // 返回的是true
        self::$class->log($name, $file);     // 此处的self::$class上面初始化已经声明过了，调用的是drive/log下的file文件中的log方法
    }
}