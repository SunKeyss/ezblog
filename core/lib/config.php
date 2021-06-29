<?php

namespace core\lib;


use Exception;

/**
 * Class config
 * @package core\lib
 * 配置文件类
 */
class config
{
    static public $conf = array();  //静态的配置属性

    /**
     * @param $name
     * @param $file
     * @return mixed
     * @throws Exception
     * 用于加载单个文件的配置
     */
    static public function get($name, $file)  //('DRIVE','log')
    {
        //判断配置文件是否存在
        //判断配置是否存在
        //缓存配置
        if (isset(self::$conf[$file])) {
            return self::$conf[$file][$name];   //如果已经存在就返回配置文件的名称
        } else {
            $path = ICETRACK . '\\icetrack\\core\\config\\' . $file . '.php';
//            p($file);  //字段'route'/ 字段log 表示文件名
            if (is_file($path)) {
                $conf = include $path;    // 引用该路径下的文件，该文件自动返回一个数组  ('DRIVE','file')
//                p($conf);   // 文件中返回的数组
                if (isset($conf[$name])) {   // 判断数组元素是否有效,配置文件是否丢失
                    self::$conf[$file] = $conf;  //保存到本类中的数组中,数组叫log，其中元素是DRIVE=>file。
//                    p(self::$conf);    // 重新编写过的数组 log->['DRIVE',file]
                    return $conf[$name];
                } else {
                    throw new Exception('没有这个配置项' . $name);
                }
            } else {
                throw new Exception('找不到配置文件' . $file);
            }
        }
    }

    /**
     * @param $file
     * @return mixed
     * @throws Exception
     * 引入所有配置文件
     */
    static public function all($file)     // 假设传进来的是database,下面拼接出来的就是database的地址
    {
        if (isset(self::$conf[$file])) {
            return self::$conf[$file];   //如果已经存在就返回配置文件的名称
        } else {
            $path = ICETRACK . '\\icetrack\\core\\config\\' . $file . '.php';

            if (is_file($path)) {
                $conf = include $path;    // 引用该路径下的文件，该文件自动返回一个数组。此例子下就是database文件
                self::$conf[$file] = $conf;    // 保存到数组中，数组叫database
//                p(self::$conf);
                //=============================================================================================
//                p($conf);
                return $conf;
            } else {
                throw new Exception('找不到配置文件' . $file);
            }
        }
    }
}