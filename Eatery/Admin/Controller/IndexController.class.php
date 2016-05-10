<?php
namespace Admin\Controller;
use Admin\Common\Help;
use Admin\Model\AdminUserModel;
use Common\Common\Memcached;
use Think\Controller;
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
     * 用户登出
     */
    public function logout(){
        Help::checkLogin();
        if(session_destroy()){
            header("Location:./index");
        }
    }


    public function test(){
        header("Content-type:text/html;charset=utf-8");
        echo Memcached::get("username");exit;
        if(Memcached::set("username","fanhang")){
           echo "success" ;
        }else{
            echo "error";
        }
//        if(Memcached::set("username","范航")){
//            echo "success";
//        }else{
//            echo "error";
//        }
    }
}