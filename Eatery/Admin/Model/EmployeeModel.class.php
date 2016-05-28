<?php
/**
 * 雇员管理模型
 */
namespace Admin\Model;
use Think\Model;

class EmployeeModel extends Model{
    /**
     * 获取雇员列表
     */
    public function getList(){
        /*将雇员管理表中的数据查询出来*/
        $aid = session('userId');
        $condition['e.aid'] = intval($aid);
        $list = $this->alias('e')->field('e.*,l.level_name,l.salary')->join('think_level l ON e.level_id = l.level_id','LEFT')
            ->where($condition)->select();
        if($list){
            return $list;
        }else{
            return false;
        }
    }
}