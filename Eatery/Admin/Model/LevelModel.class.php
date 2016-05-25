<?php
/**
 * 用户等级模型
 */
namespace Admin\Model;
use Think\Model;

class LevelModel extends Model{
    /**
     * 获取会员等级列表
     */
    public function getList(){
        $condition['aid'] = intval(session('userId'));
        $res = $this->field('level_id,level_name,salary')->where($condition)->order('level_id desc')->select();
        return $res;
    }
    /**
     * 更新雇员等级
     */
    public function editLevel($level_id,$data=array()){
        if(empty($data)){
            return false;
        }
        $condition['level_id'] = intval($level_id);
        $res = $this->where($condition)->save($data);
        if(!$res){
            return false;
        }
        return true;
    }
}