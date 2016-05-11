<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/28
 * Time: 21:02
 */
namespace Admin\Model;
use Admin\Common\Help;
use Think\Model;
class AdminUserModel extends Model{
    /**
     * @param $username 用户名
     * @param $password 密码
     * @return bool 验证成功返回true 否则返回false
     */
    public function login_validate($username,$password){
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

    /**
     * 获取商家信息
     * @return bool|mixed
     */
    public function my_info(){
        $sql = "SELECT storename,address FROM ".$this->getTableName()." WHERE id=".intval(session('userId'));
        $res=$this->query($sql);
        if(isset($res)){
            return $res[0];
        }
        return false;
    }

}