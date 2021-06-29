<?php

namespace app\ctrl;

use core\lib\model;

/**
 * 开启seesion缓存
 */
session_start();

class messCtrl extends \core\icetrack
{
    public $mess = array();

    public $msg;  //返回前端的结果数组
    public $model;  //数据库实例类

    public function __construct()
    {
        $this->model = new \app\model\messmodel();    // model是数据类
    }

    /**
     * 显示消息信息列表
     * 查询数据库
     */
    public function showmessages()
    {
        $ret = $this->model->selectAllMessagesByName($_SESSION['username']);
        $this->assign('messdatas', $ret);   //传值到前台
        $this->display('/contents/showmessages.html');
    }

    /**
     * 查找id号对应的信息
     */
    public function getOneMessdetails()
    {
        $ret = $this->model->getOneMessdetails($_GET['mess_id']);

        $this->assign('onemessage', $ret);
        $this->display('/contents/messagedetail.html');

    }

    /**
     * 修改事件信息
     */
    public function updateMessage()
    {
        $_GET['mess_title'] = urldecode($_GET['mess_title']);
        $_GET['mess_contents'] = urldecode($_GET['mess_contents']);    // 对中文进行解码
        $this->mess = array(
            'id' => $_GET['mess_id'],
            'mess_title' => $_GET['mess_title'],
            'mess_contents' => $_GET['mess_contents']
        );

        $ret = $this->model->updateMess($this->mess);
        $this->showmessages();
    }

    /**
     * 删除事件
     */
    public function deleteMessage()
    {

        $ret = $this->model->deleteMess($_GET['mess_id']);


        if (!empty($ret) && !is_null($ret)) {
            $this->msg['type'] = 1;
            $this->msg['message'] = '操作成功';
            echo json_encode($this->msg);
        } else {
            $this->msg['type'] = 0;
            $this->msg['message'] = '操作失败';
            echo json_encode($this->msg);
        }


    }


}