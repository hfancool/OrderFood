<?php
namespace Manager\Controller;
use Manager\Common\Help;
use Manager\Model\ManagerUserModel;
use Think\Controller;
use Think\Verify;

class IndexController extends Controller {
    /*验证码生成句柄*/
    private $verify = '';
    /*验证码配置*/
//    protected $config = C('verify');
    /**
     * 控制器构造方法
     */
    public function __construct(){
        if($this->verify == ''){
            $this->verify = new Verify(C('verify'));
        }
        parent::__construct();
    }
	/**
	 * @deprecated 管理员登录
	 */
    public function index(){
        $this->display('login');
    }

    /**
     * 管理员登录
     */
    public function check_login(){
        /*获取管理员的登录信息*/
        $username = I('post.username','',htmlentities);
        $pwd      = I('post.password','',htmlentities);
        $manage = new ManagerUserModel();
        $condition['username'] = $username;
        $status = $manage->where($condition)->getField('status');
        if($status == 2){
            $data['code']     =  400;
            $data['message']  =  '您已被管理员停用';
            $this->ajaxReturn($data);
        }
        if($manage->validate($username,$pwd)){
            $data['code']     =  200;
            $data['message']  =  '登录成功';
            $this->ajaxReturn($data);
        }else{
            $data['code']     =  400;
            $data['message']  =  '登录信息验证失败';
            $this->ajaxReturn($data);
        }
    }

    /**
     * 管理员登录成功后的跳转页面
     */
    public function login_success(){
        echo 'login_success';
    }
    /**
     * 检查验证码是否正确
     */
    public function check_verify(){
        $captcha = I('get.captcha','',htmlentities);
        if(empty($this->verify)){
            $this->verify = new Verify(C('verify'));
        }
        $res = $this->verify->check($captcha);
        if($res){
            $data['code']    = 200;
            $data['message'] = '验证码正确';
            $this->ajaxReturn($data);
        }else{
            $data['code']    = 400;
            $data['message'] = '验证码错误';
            $this->ajaxReturn($data);
        }
    }
    /**
     * 生成验证码
     */
    public function makeVerify(){
        $this->verify->entry();
    }
    /**
     * 检测管理员是否登录
     */
    public function is_login(){
        if(Help::check_login()){
            $data['code'] = 200;
            $data['message'] = '用户已登录';
            $this->ajaxReturn($data);
        }else{
            $data['code'] = -1;
            $data['message'] = '用户未登录';
            $this->ajaxReturn($data);
        }
    }
    /**
     * 登出
     */
    public function logout(){
        if(session_destroy()){
            $data['code'] = 200;
            $data['message'] = '登出成功';
            $this->ajaxReturn($data);
        }else{
            $data['code'] = 400;
            $data['message'] = '登出失败';
            $this->ajaxReturn($data);
        }
    }
    /**
     * 管理员权限检查
     */
    public function perm_check(){
        $mana_user = new ManagerUserModel();
        $mana_id = session('managerId');
        if(empty($mana_id)){
           return;
        }
        $condition['id'] = intval($mana_id);
        $mana_action = $mana_user->where($condition)->getField('action');
        /*接口返回当前的管理员的权限*/

        if($mana_action == 'admin'){
            $data['code']   =  200;
            $data['action'] = 'admin';
            $data['message']= '操作成功';
            $this->ajaxReturn($data);
        }else{
            $data['code']    = 200;
            $data['action']  ='user';
            $data['message'] ='操作成功';
            $this->ajaxReturn($data);
        }
    }
}