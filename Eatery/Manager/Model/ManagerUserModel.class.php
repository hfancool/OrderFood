<?php
namespace Manager\Model;
use Think\Model;
use Admin\Common\Help;
/**
 * 管理员用户模型
 * Class ManagerUserModel
 * @package Manager\Model
 */
class ManagerUserModel extends Model{
    /**
     * 验证管理员的身份
     * @param $username string 管理员姓名
     * @param $password $string 管理员登录密码
     */
    public function validate($username,$password){
        $condition['username'] = addslashes($username);
        $res = $this->where($condition)->find();
        $secrate = Help::secrate($password,$res["secrate"]);/*对用户的密码进行加密*/
        if($secrate['secrateVal'] == $res["password"]){
            //将用户的登录信息写入到session文件中
            session("managerId",$res["id"]);
            session("managername",$res["username"]);
            return true;
        }else{
            return false;
        }
    }
    /**
     * 获取管理员列表
     */
    public function get_list($page,$pageCount){
        $offset = $pageCount * ($page-1);
        $res = $this->field('id,username,birthday,mobile,status,email,idcard,addtime')->limit($offset,$pageCount)->select();
        $count = count($res);
        for($i=0;$i<$count;$i++){
//            $res[$i]['sex'] = $res[$i]['sex'] == 1 ? '保密':($res[$i]['sex'] == 2 ? '男' : '女');
            $res[$i]['birthday'] = date('Y-m-d',$res[$i]['birthday']);
            $res[$i]['addtime']  = date('Y-m-d H:i:s',$res[$i]['addtime']);
            $res[$i]['status']   = $res[$i]['status'] == 1 ? '启用':'停用';
        }
        return $res;
    }
    /**
     * 添加管理员
     */
    public function add_manager($data){
        if($this->add($data)){
            return true;
        }
        return false;
    }
    /**
     * 修改管理员状态
     */
    public function cs($id){
//        $sql = "UPDATE think_admin_user SET status = CASE status WHEN 1 THEN 2 WHEN 2 THEN 1 END ".
//                " where id =1";
//        $res = $this->query($sql);
        $condition['id'] = intval($id);
        $status = $this->where($condition)->getField('status');
        if($status == 1){
            $data['status'] = 2;
        }else{
            $data['status'] = 1;
        }
        $res = $this->where($condition)->save($data);
        if($res){
            return true;
        }
        return false;
    }
}
