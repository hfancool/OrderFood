<?php
/**
 * 雇员日常请假，到勤率操作模型
 */
namespace Admin\Model;
use Think\Model;

class AttendenceModel extends Model{
  /**
   * 查看用户当日是否已经签到
   */
    public function is_violation_today($eid){
        if(empty($eid)){
            return false;
        }
        $time = date('Y-m-d',time());
        $sql = "SELECT COUNT(id) AS cou FROM think_attendence WHERE FROM_UNIXTIME(addtime,'%Y-%m-%d') = '".$time."' AND eid = ".intval($eid);
        $res = $this->query($sql);
        if($res[0]['cou']){
            return true;
        }
        return false;
    }
    /**
     * 更新查询
     */
    public function updateRecord($eid,$att_type,$remarks){
        /*将新数据插入到数据库*/
        $data['aid']      = intval(session('userId'));
        $data['eid']      = intval($eid);
        $data['att_type'] = $att_type;
        $data['remarks']  = $remarks;
        $data['addtime']  = time();
        $res = $this->add($data);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 按月获取数据库中的记录
     */
    public function getListByTime($time){
        $aid = intval(session('userId'));
        $sql = "SELECT ";
    }
}
