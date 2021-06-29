<?php

namespace app\model;

use core\lib\model;

class testmodel extends model
{
    public $table = 'test';    //test表

    /**
     * @return array|null
     * 查询所有数据
     */
    public function selectLists()
    {
        $ret = $this->select($this->table, '*');  //$this是testmodel实例，在indexctrl中已经实例化过了。medoo数据库框架
        return $ret;
    }

    /**
     * @return false|mixed
     * 根据id查询单行数据
     */
    public function getOneByID($id)
    {
        $ret = $this->get($this->table, '*', array("id" => $id));
        return $ret;
    }

    /**
     * @param $id 数据库主键id
     * 根据id删除单行数据
     */
    public function delOneByID($id)
    {

    }

    /**
     * @param $id
     * 根据id修改单行数据
     */
    public function updateOneByID($id)
    {

    }

    /*        #查询
                $data = $model->select('test','*',array("id"=>2));
                $data = $model->select('test', '*');


                #插入
                $model->insert('test', array("name" => 'pock'));

                #修改
                $model->update('test', array("name" => 'pock12'), array("name" => 'pock'));

                #删除
                $model->delete('test',array("name"=>'pock12'));*/
}