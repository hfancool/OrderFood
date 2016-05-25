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
//        $condition["FROM_UNIXTIME('Y%-m%',addtime)"] = date("Y-m",time());
        $list = $this->alias('e')->field('e.*,l.level_name,l.salary,a.*')->join('think_level l ON e.level_id = l.level_id','LEFT')
            ->join('think_attendence a ON e.id = a.eid','LEFT')
            ->where($condition)->select();
        if($list){
            return $list;
        }else{
            return false;
        }
    }
}