<?php

namespace core\lib;
use core\lib\config;


/**
 * Class route
 * @package core\lib
 * 路由类
 */
class route
{
    public $control;  // 控制器
    public $action;    // 方法

    public function __construct()
    {
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
            $path = $_SERVER['REQUEST_URI'];
            $path = str_replace('?',"/",$path);
            $path = str_replace('=',"/",$path);
            $path = str_replace('&',"/",$path);
            $patharr = explode('/', trim($path, '/'));  //explode()把字符打散为数组
            if (isset($patharr[1])) {
                $this->control = $patharr[1];  //表示控制器变量存在
            }
            unset($patharr[0]);
            unset($patharr[1]);
            if (isset($patharr[2])) {
                $this->action = $patharr[2];   //表示行为变量存在，也就是对应的方法
                unset($patharr[2]);
            } else {
//                $this->action = 'index';
                $this->action = config::get('ACTION','route');  // 如果没有有效字段，则按照默认情况index处理
            }
            // 处理url多余的参数。解析到$_GET
            $count = count($patharr) + 3;
            $i = 3;
            while ($i < $count) {
                if (isset($patharr[$i + 1]))   // 防止出现奇数的参数 数组越界
                {
                    $_GET[$patharr[$i]] = $patharr[$i + 1];
                    $i = $i + 2;
                }
            }
        } else {
            $this->control = config::get('CTRL','route');
            $this->action = config::get('ACTION','route');
        }
    }

}