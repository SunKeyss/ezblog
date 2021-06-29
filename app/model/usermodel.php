<?php

namespace app\model;


use core\lib\model;


class usermodel extends model
{
    public $usertable = 'userinfo';

    public $ret = array();

    /**
     * @param $username 用户名称
     * 根据用户名称查询用户单条信息
     * 主要用户登录查询，注册时查询用户名重复
     */
    public function selectUserByName($username)
    {
        $this->ret = $this->get($this->usertable, '*',
            array(
                "username" => $username
            ));    // 在控制器中实例化了usermodel
        return $this->ret;   //若不存在返回null

    }
}