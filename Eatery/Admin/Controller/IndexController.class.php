<?php
namespace Admin\Controller;
use Admin\Common\Help;
use Admin\Model\AdminUserModel;
use Common\Common\Memcached;
use Think\Controller;
use Think\Model;

class IndexController extends Controller {
	/**
	 * @deprecated 店家登录的首页面
	 */
    public function index(){
    	$this->display('admin_login');
    }
    /**
     * @deprecated 店家登录的处理方法
     */
    public function admin_login(){
        header("Content-Type:text/html;charset=utf-8");
    	//获取表单数据
    	$userName=I('post.userName','','htmlspecialchars');
    	$psw=I('post.psw','','htmlspecialchars');
        $user = new AdminUserModel();
        if(!($user ->login_validate($userName,$psw))){
            $data["code"]=400;
            $data["message"]="用户名或密码错误";
            $this -> ajaxReturn($data);
        }else{
            $data["code"]=200;
            $data["message"]="用户名或密码错误";
            $this -> ajaxReturn($data);
        }

    }
    /**
     * @deprecated 店家登录成功后的界面
     */
    public function admin_login_success(){
        /*检测用户是否登录*/
        Help::checkLogin();
    	$this->display('admin_login_success');
    }
    /**
     * @deprecated 当前订单的处理方法
     * 从memcache快速缓存中获得用户的当前点餐
     */
    public function show_order(){
        Help::checkLogin();
    }

    /**
     * 商家查看我的信息时加载的数据
     */
    public function admin_my_info(){
        Help::checkLogin();/*检测登录*/
        $handle = new AdminUserModel();
        if(!$my_info=$handle->my_info()){
            return;
        }
        $this->assign('my_info',$my_info);
        $this->display('admin_my_info');
    }

    /**
     * 用户登出
     */
    public function logout(){
        Help::checkLogin();
        if(session_destroy()){
            header("Location:./index");
        }
    }

    /**
     * 将商家的信息进行加密并生成惟一的值
     */
    public function make_url(){
        Help::checkLogin();
        $condition['id'] = intval(session('userId'));
        $user = new AdminUserModel();
        $res = $user->field('storename','secrate','secrate')->where($condition)->select();
        $value = implode("&",$res[0]);
        if(empty($res[0]['secrate'])){
            $secrate = Help::secrate($value);
            $data['secrate'] = $secrate['secrateKey'];
            $user->where($condition)->save($data);
        }else{
            $secrate = Help::secrate($value,$res[0]['secrate']);
        }
        $sql = "INSERT INTO think_mapping (ssid,aid) VALUES ('".$secrate['secrateVal']."' , ".intval(session('userId'))." )";
        if(M()->query($sql)){
            echo 'success';
        }
        echo 'fail';
    }

    /**
     * 二维码在线生成
     */
    public function tcode(){
        $aid = intval(session('userId'));
        if(Help::tcode($aid)){
            return true;
        }
        return false;
    }
    /**
     * 商家二维码显示
     */
    public function show_tcode(){
        Help::checkLogin();
        $admin = new AdminUserModel();
        $condition['id'] = intval(session('userId'));
        $tcode = $admin->where($condition)->getField('tdcode');
        if(!$tcode){
            if($this->tcode()){
                $tcode = $admin->where($condition)->getField('tdcode');
            }else{
                echo 'fail';
            }
        }
        $this->assign('tcode',$tcode);
        $this->display('tcode');
    }
}