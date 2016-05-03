<?php

namespace Common\Common;
class Memcached{
    private static $conn='';

    /**
     * 连接memcached
     */
    public static function init(){
        $conf = C("memcached");
        if(!self::$conn){
            self::$conn = new \Memcache();
            self::$conn ->connect($conf['host'],$conf['port']);
        }
    }

    /**
     * 向memcached 中添加数据
     * @param $key
     * @param $val
     * @return bool
     */
    public static function set($key,$val){
        if(!self::$conn){
            self::init();
        }
        if(self::$conn -> set($key,$val)){
            return true;
        }
        return false;
    }

    /**
     * 从memcached 中获取数据
     * @param $key
     * @return bool
     */
    public static function get($key){
        if(!self::$conn){
            self::init();
        }
        $res = self::$conn -> get($key);
        return  isset($res) ? $res : false;
    }

    /**
     * 从memcached 中删除元素
     * @param $key
     * @return bool
     */
    public static function remove($key){
        if(!self::$conn){
            self::init();
        }
        if(self::$conn -> delete()){
            return true;
        }
        return false;
    }
    /**
     * 关闭连接
     */
    public static function close(){
        if(!self::$conn){
            self::init();
        }
        self::$conn -> close();
    }

}