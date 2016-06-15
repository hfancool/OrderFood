<?php
namespace Manager\Controller;
use Admin\Common\Help;
use Admin\Model\AdminUserModel;
use Think\Controller;

/**
 * 后台管理员对商家的管理接口
 * Class AdminController
 * @package Manager\Controller
 */
class AdminController extends Controller{
    /**
     * 获取商家列表
     */
    public function get_adminList(){
        /*检查用户是否登录*/
        if(!$_SESSION['managerId'] || !$_SESSION['managername']){
            $data['code']    = 0;
            $data['message'] = '未登录';
            $this->ajaxReturn($data);
        }
        $page      = I('post.page',1);
        $pageCount = I('post.pageCount',1);
        $admin = new AdminUserModel();
        $res = $admin->get_list($page,$pageCount);
        if($res){
            $data['code']    = 200;
            $data['bd']    =  $res;
            $data['message'] = '获取列表成功';
            $this->ajaxReturn($data);
        }else{
            $data['code']    = 400;
            $data['message'] = '无更多数据';
            $this->ajaxReturn($data);
        }
    }
    /**
     *  更改商家状态
     */
    public function change_status(){
        $aid = I('get.id','',htmlspecialchars);
        $admin =new AdminUserModel();
        $res = $admin->cs($aid);
        if($res){
            $data['code']     =  200;
            $data['message']  =  '成功';
            $this->ajaxReturn($data);
        }else{
            $data['code'] = 400;
            $data['message'] = '失败';
            $this->ajaxReturn($data);
        }
    }
    /**
     * 新建商家
     */
    public function add_admin(){
        /*获取接口数据*/
        $secrate = Help::secrate('000000');/*初始化密码*/
        $data['username'] = I('post.username','',htmlentities);
        $data['mobile']   = I('post.mobile','',htmlentities);
        $data['email']    = I('post.email','',htmlentities);
        $data['password'] = $secrate['secrateVal'];/*初始密码*/
        $data['address']  = I('post.address','',htmlentities);
        $data['paytype']  = I('post.paytype','现金支付',htmlentities);
        $data['storename']= I('post.storename','',htmlentities);
        $data['storeinfo']= I('post.info','',htmlentities);
        $data['secrate']  = $secrate['secrateKey'];
        $data['status']   = 1;
        $data['addtime']  = time();
        $returnUrl = I('post.returnUrl','');
        $admin = new AdminUserModel();
        if($admin->add_admin($data)){
            header("Location:".$returnUrl);
        }else{
           echo 'error';
        }
    }
    /**
     * 初始化商家密码
     */
    public function repwd(){
        $admin_id = I('post.admin_id','');
        $secrate = Help::secrate('000000');
        $condition['id'] = intval($admin_id);
        $admin = new AdminUserModel();
        $data['password'] = $secrate['secrateVal'];
        $data['secrate']  = $secrate['secrateKey'];
        $res = $admin->where($condition)->save($data);
        if($res){
            $info['code']    = 200;
            $info['message'] = '初始化密码成功';
            $this->ajaxReturn($info);
        }else{
            $info['code']    = 400;
            $info['message'] = '初始化密码失败';
            $this->ajaxReturn($info);
        }

    }
}