<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/28
 * Time: 21:02
 */
namespace Admin\Model;
use Admin\Common\Help;
use Admin\Controller\IndexController;
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
        $secrate = Help::secrate($password,$res["secrate"]);/*对用户的密码进行加密*/
        if($res['status'] == 2){
            return 1;
        }
        if($secrate['secrateVal'] == $res["password"]){
            //将用户的登录信息写入到session文件中
            session("userId",$res["id"]);
            session("username",$res["username"]);
            if($res['secrate'] == ''){
                $condition['id']  = $res['id'];
                $admin = new AdminUserModel();
                $data['secrate'] = $secrate['secrateKey'];
                $admin->where($condition)->save($data);
            }
            /*判断当商家的ssid为空的时候为商家生成ssid*/
            $sql = "SELECT ssid FROM think_mapping WHERE aid = ".intval($res['id']);
            $map = M()->query($sql);
            if(!$map){
                $con = new IndexController();
                $con->make_url();
            }
            return 0;
        }else{
            return 2;
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
    /**
     * 获取商家列表
     */
    public function get_list(){
        $res = $this->field("id,username,address,paytype,storename,storeinfo,addtime,status")->select();
        $count = count($res);
        for($i=0;$i<$count;$i++){
            $res[$i]['addtime'] = date("Y-m-d H:i:s",$res[$i]['addtime']);
            $res[$i]['status'] = intval($res[$i]['status']) == 1 ? '启用':'停用';
        }
        return $res;
    }
    /**
     * 更改商家的状态
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
    /**
     * 添加商家
     */
    public function add_admin($data){
        if($this->add($data)){
            return true;
        }
        return false;
    }
}