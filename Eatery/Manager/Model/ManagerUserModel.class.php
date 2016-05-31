<?php
namespace Manager\Model;
use Think\Model;

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
//        $secratePWD = Help::secrate($password,$res["secrate"]);/*对用户的密码进行加密*/
        if($password == $res["password"]){
            //将用户的登录信息写入到session文件中
            session("userId",$res["id"]);
            session("username",$res["username"]);
            return true;
        }else{
            return false;
        }
    }
}
