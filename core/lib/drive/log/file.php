<?php

namespace core\lib\drive\log;

use core\lib\config;

class file
{
    public $path;    //日志的存储位置

    public function __construct()
    {
        $conf = config::get('OPTION', 'log');
        $this->path = $conf['PATH'];
    }

    public function log($message, $file = 'log')   //默认情况下日志文件叫log
    {
//        p(name);
        /**
         * 1.确认文件存储文职是否存在，新建目录
         * 2.写入文件
         */
//        p($this->path);
        if (!is_dir($this->path)) {
            mkdir($this->path, '0777', true); // 0777表示最大权限，true表示允许递归创建嵌套目录
        }


        $message = date('Y-m-d H:i:s').json_encode($message).PHP_EOL;
        $file_name = $this->path .date('Ymd'). $file . '.php' ;    //每一天生成一个文新件
        //file_put_contents是php自带的一个写文件的函数
        //默认存储位置xxx.log;  $message有可能是数组，将其编码成json数据,php_EOL表示php中的自动换行符;  FILE_APPEND表示追加
        file_put_contents($file_name, $message,FILE_APPEND);


    }

}
//文件系统