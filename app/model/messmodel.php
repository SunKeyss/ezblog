<?php

namespace app\model;


use core\lib\model;


class messmodel extends model
{

    public $messtable = 'messinfo';

    public $ret = array();

    /**
     * @param $username
     * @return array|null
     * 根据用户名查询所有message
     * 显示名下所有文章
     */
    public function selectAllMessagesByName($username)
    {
        $this->ret = $this->select($this->messtable, "*",
            array(
                "mess_author" => $username
            ));
        return $this->ret;

    }

    /**
     * @param $messId
     * @return false|mixed
     * 根据id获取某一篇的信息
     */
    public function getOneMessdetails($messId)
    {
        $this->ret = $this->get($this->messtable, "*",
            array(
                "id" => $messId
            ));
        return $this->ret;

    }

    /**
     * @param $mess  是一个数组，对应需要修改的信息
     * @return \PDOStatement|null
     * 修改事件信息
     */
    public function updateMess($mess)
    {
        $this->ret = $this->update($this->messtable, $mess, array("id" => $mess['id']));
        return $this->ret;
    }


    public function deleteMess($messId)
    {
        $this->ret = $this->delete($this->messtable,array("id" =>$messId));
        return $this->ret;
    }

}