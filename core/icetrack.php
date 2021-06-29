<?php

namespace core;

class icetrack
{
    public static $classMap = array();   // 引用一次$class对象即可
    public $assign;

    /**
     * 启动框架
     */
    static public function run()
    {
        \core\lib\log::init();   //log类的初始化
        $route = new \core\lib\route(); //调用路由类，解析url，跳转对应控制器

        //加载控制器
        $ctrlClass = $route->control;  // url中表示的控制器字段
        $action = $route->action;   // url中表示方法的字段
        $ctrlfile = APP . '/ctrl/' . $ctrlClass . 'Ctrl.php';    // 指向indexCtrl.php这个文件地址
        $ctrl_Class = '\\' . MODULE . '\ctrl\\' . $ctrlClass . 'Ctrl';    //指向indexCtrl这个类
//        p($ctrl_Class);

        if (is_file($ctrlfile)) {
//            include $ctrlfile;    //为什么要引用这个文件？
            $ctrl = new $ctrl_Class();   //实例化一个indexCtrl类
//            p($ctrl);
//            p($action);
//            p('这里是icetrack');
            $ctrl->$action();    // 调用$ctrl对象中的名为$action的一个方法,实际上就是index方法
            \core\lib\log::log('    ctrl:' . $ctrlClass . ';    action:' . $action);  //记录日志文件

        } else {
            throw new \Exception('找不到控制器' . $ctrlClass);
        }
    }

    /**
     * @param $class
     * @return bool
     * 自动加载类
     * new\core\route();
     * $class = '\core\route';
     * icetrack.'\core\route.php';
     */
    static public function load($class)
    {
//        p(ICETRACK);    // ICETRACK打印结果是 G:\phpEnv\www\localhost
        if (isset($classMap[$class])) {
            return true;
        } else {
            $file = ICETRACK . '/icetrack/' . $class . '.php';
            $file = str_replace('\\', '/', $file);
            if (is_file($file)) {
                include $file;
                self::$classMap[$class] = $class; //将$class对象放到classMap数组中，下次再需要就不用引用了
            } else {
                return false;
            }
        }
    }

    /**
     * @param $name
     * @param $value
     * 视图文件赋值
     */
    public function assign($name, $value)
    {
        $this->assign[$name] = $value;
    }

    /**
     * @param $file
     * 调用视图文件
     */
    public function display($file)
    {
        $fileClass = APP . '/views/' . $file;
        if (is_file($fileClass)) {

//            extract($this->assign);    // 打散数组，使得$data字段可以被引用.下面由模板完成
//            p($data);  // 可以运行但是会报错
//            include $file;


            //版本问题弃用
/*            Twig_Autoloader::register();  //注册twig服务

            $loader = new Twig_Loader_Filesystem(APP.'/views');  //传入视图文件夹
            $twig = new Twig_Environment($loader, array(
                'cache' => ICETRACK.'/log/twig',
                'debug' => DEBUG
            ));   //  设置twig放置缓存的位置
            $template = $twig->loadTemplate('index.html');// 加载一个模板文件
            $template->display($this->assign?$this->assign:'');*/

            $loader = new \Twig\Loader\FilesystemLoader(APP . '/views');   //传入视图文件夹
            $twig = new \Twig\Environment($loader,array(
                'cache' => ICETRACK.'/log/twig',
                'debug' => DEBUG
            ));   //  设置twig放置缓存的位置
            $template = $twig->load($file); // 加载一个模板文件
            //注意display函数接收的参数必须是数组
            //将参数显示到页面
            $template->display(isset($this->assign)?$this->assign:array());  //三目运算符，若为false则返回空数组


        }
    }

}