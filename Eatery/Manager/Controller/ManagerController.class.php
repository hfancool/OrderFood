<?php
namespace Manager\Controller;
use Admin\Common\Help;
use Manager\Model\ManagerUserModel;
use Think\Controller;

/**
 * 管理员控制器接口
 * Class ManagerController
 * @package Manager\Controller
 */
class ManagerController extends Controller{
    /**
     * 获取管理员列表
     */
    public function get_managerList(){
        $manage = new ManagerUserModel();
        $list = $manage->get_list();
        if($list){
            $data['code']  =  200;
            $data['bd']    = $list;
            $data['message'] = '获取列表成功';
            $this->ajaxReturn($data);
        }else{
            $data['code']  = 400;
            $data['message'] = '获取列表失败';
            $this->ajaxReturn($data);
        }
    }
    /**
     * 添加管理员
     */
    public function add_manager(){
        $secrate = Help::secrate('000000');/*初始化密码*/
        $data['username'] = I('post.username','',htmlentities);
        $data['mobile']   = I('post.mobile','',htmlentities);
        $data['email']    = I('post.email','',htmlentities);
        $data['password'] = $secrate['secrateVal'];/*初始密码*/
        $data['birthday']  = I('post.birthday','',htmlentities);
        $data['idcard']  = I('post.idcard','',htmlentities);
        $data['secrate']  = $secrate['secrateKey'];
        $data['addtime']  = time();
        $returnUrl = I('post.returnUrl','');
        $manage = new ManagerUserModel();;
        if($manage->add_manager($data)){
            header("Location:".$returnUrl);
        }else{
            echo 'error';
        }
    }
}