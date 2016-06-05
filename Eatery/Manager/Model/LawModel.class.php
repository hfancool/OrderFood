<?php
namespace Manager\Model;
use Think\Model;

class LawModel extends Model{
    /**
     * 更新
     */
    public function join($data){
        $condition['type']  = 1;
        if($this->where($condition)->save($data)){
            return true;
        }
        return false;
    }
    /**
     * 获取
     */
    public function get_join(){
        $condition['type']  = 1;
        $res = $this->where($condition)->getField('info');
        return $res;
    }
}