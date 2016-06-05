<?php
namespace Manager\Controller;
use Manager\Model\LawModel;
use Think\Controller;
use Think\Model;

class LawController extends Controller{
    /**
     * 获取加入我们信息
     */
    public function join(){
        $data = I('post.data','',htmlspecialchars);
        /*将最新的数据更新到数据库中*/
//        var_dump($data);exit;
        $law = new LawModel();
        $law->join($data);
//        $this->ajaxReturn($law->get_join());
//        return $law->get_join();
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