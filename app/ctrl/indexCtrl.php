<?php

namespace app\ctrl;

use core\lib\model;

/**
 * Class indexCtrl
 * @package app\ctrl
 * index控制器
 */
class indexCtrl extends \core\icetrack
{
    /**
     * index主方法，调用配置文件，初始化页面
     */
    public function index()
    {
//        $model = new \app\model\testmodel();    // model是数据类
//        $ret = $model->selectlists();
//        $ret = $model->getOneByID("2");
//        dump($ret);


        /*        以下分割弃用
                $model = new \core\lib\model();
                $sql = "select * from test";
                $ret = $model->query($sql);
                p($ret->fetchAll());
                ======================分开引用配置文件，第一版
                $temp = \core\lib\config::get('CTRL','route');
                $temp = \core\lib\config::get('ACTION','route');
                ======================= 第二版
                $temp = new \core\lib\model();      //model类中又调用了config方法中的all方法，配置文件
*/
/*        $title = '这是一个标签页面';
        $data = 'Hello World';

        $this->assign('title', $title);    //键值对数组
        $this->assign('data', $data);*/

        $this->display('index.html');
    }


}