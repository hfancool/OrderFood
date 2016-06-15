<?php
namespace Manager\Controller;
use Manager\Model\LawModel;
use Think\Controller;
use Think\Model;

class LawController extends Controller{
    /**
     * 设置加入我们信息
     */
    public function set_rule(){
        $info = I('post.data','',htmlspecialchars);
        $type = I('post.type','',htmlspecialchars);
        /*将最新的数据更新到数据库中*/
        $law_join = new LawModel();
        $condition['type']  = intval($type);
        $data['info']  =  $info;
        if($law_join->where($condition)->save($data)){
            $ret_data['code']    = 200;
            $ret_data['message'] = '条款添加成功';
            $ret_data['info']    = htmlspecialchars_decode($info);
            $this->ajaxReturn($ret_data);
        }else{
            $ret_data['code']    = 400;
            $ret_data['message'] = '条款添加失败';
            $this->ajaxReturn($ret_data);
        }
    }
    /**
     * 获取加入我们条款
     */
    public function get_rule(){
        $type = I('get.type','',htmlspecialchars);
        $condition['type']   =  intval($type);
        $law_join = new LawModel();
        $res = $law_join->where($condition)->getField('info');
        if($res){
            $data['code']    =  200;
            $data['message'] =  '获取条款成功';
            $data['info']    =  htmlspecialchars_decode($res);
            $this->ajaxReturn($data);
        }else{
            $data['code']    =  400;
            $data['message'] =  '获取条款失败';
            $this->ajaxReturn($data);
        }
    }




    /**
     * 加入信息
     */
    public function join_info(){
        $law = M('Law');
        $condition['mid'] = 1;
        echo $law->where($condition)->getField('info');
    }
    /**
     *获取用户信息协议
     */
    public function user_rule(){

    }
    /**
     * 注册条款
     */
    public function register_rule(){

    }
}