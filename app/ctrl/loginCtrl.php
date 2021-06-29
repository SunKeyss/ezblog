<?php

namespace app\ctrl;

// 开启seesion缓存
session_start();

class loginCtrl extends \core\icetrack
{
    public $username;  //由于用户名下面函数还需要用
    public $password;  //由于用户名下面函数还需要用
    public $msg = array();    //返回前端的结果数组
    public $model;  //数据库实例类

    public function __construct()
    {
        $this->model = new \app\model\usermodel();    // model是数据类
    }

    /**
     * 登录函数
     */
    public function login()
    {
        $this->username = $_POST['username'];
        $this->password = md5($_POST['password']);    //密码使用md5加密

        $ret = $this->model->selectUserByName($this->username);    //查找用户信息
        /*查询用户名是否存在*/
        if (is_null($ret) || empty($ret)) {
            $this->msg['type'] = 0;
            $this->msg['message'] = '用户名不存在';
            echo json_encode($this->msg);
            return;
        }

        if ($ret['password'] === $this->password) {
            $this->msg['type'] = 1;
            $this->msg['message'] = '登录成功';

            $_SESSION['username'] = $this->username;   //保存到session中，表示用户登录信息
            unset($this->password);
            echo json_encode($this->msg);
        } else {
            $this->msg['type'] = 0;
            $this->msg['message'] = '密码错误';
            echo json_encode($this->msg);
        }

    }


}