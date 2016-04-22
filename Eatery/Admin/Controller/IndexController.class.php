<?php
namespace Admin\Controller;
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
    	//获取表单数据
    	$userName=I('post.userName','','htmlspecialchars');
    	$psw=I('post.psw','','htmlspecialchars');
    	echo $userName.'&&'.$psw;
    }
    public function test(){
//     	echo $userName.'&&'.$psw;
 		echo 'H'; 	
    }
    
    /**
     * @deprecated 店家登录成功后的界面
     */
    public function admin_login_success(){
    	$this->display('admin_login_success');
    }
    /**
     * @deprecated 当前订单的处理方法
     * 从memcache快速缓存中获得用户的当前点餐
     */
    public function show_order(){
    	
    }
}