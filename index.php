<?php
/**
 * 入口文件
 * 1.定义常量
 * 2.加载函数库
 * 3.启动框架
 */


#定义系统常量
define('ICETRACK', realpath('../'));
define('CORE', ICETRACK . '/icetrack/core');
define('APP', ICETRACK . '/icetrack/app');
define('MODULE', 'app');
define('DEBUG', true);

# 引入第三方库的自动加载
include "vendor/autoload.php";

if (DEBUG) {
    /*第三方错误类库 服务注册*/
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
    ini_set('display_error', 'On');
} else {
    ini_set('display_error', 'Off');
}

#加载函数库
include CORE . '/common/function.php';

#启动框架
include CORE . '/icetrack.php';

/**
 * 类自动加载
 * 当类不存在时候，自动触发此函数，调用自动加载类
 */
spl_autoload_register('\core\icetrack::load');
/**
 * 调用基础类的run方法
 */
\core\icetrack::run();
