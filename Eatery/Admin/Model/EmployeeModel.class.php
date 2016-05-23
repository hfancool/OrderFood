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
        $list = $this->table('think_employee e,think_level l')->
                where('e.level_id = l.level_id and e.aid = '."$aid".'')->
                field('e.*,l.level_name,l.salary')->select();
        if($list){
            return $list;
        }else{
            return false;
        }
    }
}