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
        $page      = I('post.page',1);
        $pageCount = I('post.pageCount',1);
        $list = $manage->get_list($page,$pageCount);
        if($list){
            $data['code']  =  200;
            $data['bd']    = $list;
            $data['message'] = '获取列表成功';
            $this->ajaxReturn($data);
        }else{
            $data['code']  = 400;
            $data['message'] = '暂无更多数据';
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
    /**
     * 修改状态
     */
    public function change_status(){
        $manage_id = I('get.id');
        $manage =new ManagerUserModel();
        $res = $manage->cs($manage_id);
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
     * 删除系统后台管理员
     */
    public function del_manager(){
        $mana_id = I('get.mana_id');
        /*操作*/
        $condition['id']   =  intval($mana_id);
        $manage = new ManagerUserModel();
        $res = $manage->where($condition)->delete();
        if($res){
            $data['code']    = 200;
            $data['message'] = '删除成功';
            $this->ajaxReturn($data);
        }else{
            $data['code']    = 400;
            $data['message'] = '删除失败';
            $this->ajaxReturn($data);
        }
    }
}