<?php
namespace Manager\Controller;
use Manager\Model\ManagerUserModel;
use Think\Controller;
use Think\Verify;

class IndexController extends Controller {
    /*验证码生成句柄*/
    private $verify = '';
    /*验证码配置*/
    protected $config = array(
                    'fontSize'=>15,
                    'length'  =>4
                );

    /**
     * 控制器构造方法
     */
    public function __construct(){
        if($this->verify == ''){
            $this->verify = new Verify($this->config);
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
        if($manage->validate($username,$pwd)){
            $this->success('登录成功','./login_success');
        }else{
            $this->error('登录信息验证失败');
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
            $this->verify = new Verify($this->config);
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

}