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
        /*按用户id 进行分组*/
        $sql = "SELECT e.username  FROM think_attendence AS a".
            " LEFT JOIN think_employee AS e ON a.eid = e.id".
            " WHERE FROM_UNIXTIME(a.addtime,'%Y-%m') = '".date('Y-m',$time)."' ".
            " AND a.aid=".intval($aid)." GROUP BY a.eid";
        $res = $this->query($sql);
        /*组装数组*/
        $tmp = array(
            'username'   =>'',
            'attend'     =>0,
            'sick'       =>0,
            'personal'   =>0,
            'absent'     =>0,
            'be_late'    =>0,
            'early_leave'=>0,
            'remarks'    =>''
        );
        $users = array();
        foreach($res as $key=>$val){
            $users[$val['username']] = $tmp;
        }
//        var_dump($users);
        $sql = "SELECT a.eid, e.username, a.att_type , a.remarks FROM think_attendence AS a".
        " LEFT JOIN think_employee AS e ON a.eid = e.id".
        " WHERE FROM_UNIXTIME(a.addtime,'%Y-%m') = '".date('Y-m',$time)."' ".
        " AND a.aid=".intval($aid);
        $res = $this->query($sql);
        /*遍历结果集*/
        foreach($res as $key => $val){
            if(empty($users['username']['username'])){
                $users[$val['username']]['username'] = $val['username'];
                $users[$val['username']]['remarks']  .= $val['remarks'];
            }
            switch($val['att_type']){
                case 1 : $users[$val['username']]['attend']+=1;
                    break;
                case 2 : $users[$val['username']]['sick']+=1;
                    break;
                case 3 :  $users[$val['username']]['personal']+=1;
                    break;
                case 4 :  $users[$val['username']]['absent']+=1;
                    break;
                case 5 :  $users[$val['username']]['be_late']+=1;
                    break;
                case 6 :  $users[$val['username']]['early_leave']+=1;
                    break;
            }
        }
        return $users;
    }
}
