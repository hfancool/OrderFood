<?php
namespace Admin\Controller;
use Admin\Common\Help;
use Admin\Model\AdminUserModel;
use Admin\Model\MappingModel;
use Admin\Model\MenuModel;
use Common\Memcached;
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
        $res = $user ->login_validate($userName,$psw);
        if($res == 1){
            $data["code"]=400;
            $data["message"]="您的账号已停用";
            $this -> ajaxReturn($data);
        }
        if($res === 2){
            $data["code"]=400;
            $data["message"]="用户名或密码错误";
            $this -> ajaxReturn($data);
        }else{
            $data["code"]=200;
            $data["message"]="登录成功";
            $this -> ajaxReturn($data);
        }

    }
    /**
     * @deprecated 店家登录成功后的界面
     */
    public function admin_login_success(){
        /*检测用户是否登录*/
        Help::checkLogin();
//        $order_info = $this->show_order();
//        $this->assign('order',$order_info);
    	$this->display('admin_login_success');
    }
    /**
     * @deprecated 当前订单的处理方法
     * 从memcache快速缓存中获得用户的当前点餐
     */
    public function show_order(){
//        Help::checkLogin();
        $m = new MenuModel();
        $menu = $m->getMenuList();
        /*获取当前商家的ssid*/
        $sql = "SELECT ssid FROM think_mapping WHERE aid = ".intval(session('userId'));
        $res = M()->query($sql);
        $ssid = $res[0]['ssid'];
        $order = unserialize(Memcached::get($ssid));
        $order_info = array();
        foreach($order as $key => $val){
            foreach($val as $k => $v){
                foreach($v as $i=>$id){
                    /*遍历商家菜单，找到匹配的记录*/
                    foreach($menu as $menu_key=>$menu_val){
                        if($menu_val['menu_id'] == $id['menu_id']){
                            $order_info[$k][] = array(
                                'menu_id'  => $id['menu_id'],
                                'menu_name'=> $menu_val['name'],
                                'price'    => $menu_val['price'],
                                'num'=>$id['num']);
                        }
                    }
                }
            }
        }
        if(IS_AJAX){
            $this->ajaxReturn($order_info);
        }else{
            return $order_info;
        }
    }
    /**
     * 订单完成后删除订单
     */
    public function complete_order(){
        /*获取当前商家的ssid*/
        $sql = "SELECT ssid FROM think_mapping WHERE aid = ".intval(session('userId'));
        $res = M()->query($sql);
        $ssid = $res[0]['ssid'];
        /*获得完成订单号*/
        $order_id = I('get.order_id',0,htmlspecialchars);
        $order = unserialize(Memcached::get($ssid));
        reset($order);
        while(list($key,$val) = each($order)){
            if(key($val) == $order_id){
                unset($order[$key]);
                break;
            }
        }
        $order_info = serialize($order);
        if(Memcached::set($ssid,$order_info)){
            /*此处加入语音提示信息*/
            $str_num = Help::remind_order_audio($order_id);
            $data['code']  = '200';
            $data['message']    = "删除成功";
            $data['audio']    = $str_num;
            $this->ajaxReturn($data);
        }else{
            $data['code']  = '400';
            $this->ajaxReturn($data);
        }
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
//        Help::checkLogin();
//        var_dump($_SESSION);
        $condition['id'] = intval(session('userId'));
        $user = new AdminUserModel();
        $res = $user->field('storename','secrate')->where($condition)->select();
        $value = implode("&",$res[0]);
        if(empty($res[0]['secrate'])){
            $secrate = Help::secrate($value);
            $data['secrate'] = $secrate['secrateKey'];
            $user->where($condition)->save($data);
        }else{
            $secrate = Help::secrate($value,$res[0]['secrate']);
        }
        $map = new MappingModel();
        $data['ssid']   =   $secrate['secrateVal'];
        $data['aid']    =   intval(session('userId'));
        $map->add($data);
//        $sql = "INSERT INTO think_mapping (ssid,aid) VALUES ('".$secrate['secrateVal']."' , ".intval(session('userId'))." )";
//        $sql = "INSERT INTO think_mapping (ssid,aid) VALUES ('".$mapping."' , 4 )";
//        $Model = new Model();
//        $map = $Model->query($sql);
//        if($mapping){
//            echo 'success';
//        }
//        echo 'fail';
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

    /**
     * 商家修改密码
     */
    public function chpwd(){
        if(IS_AJAX){
            $newpwd = I('post.newpwd','',htmlspecialchars);
            if(empty($newpwd)){
                $data['code']    = 400;
                $data['message'] = '密码不能为空';
                $this->ajaxReturn($data);
            }else{
                Help::checkLogin();
                $admin = new AdminUserModel();
                $res = $admin->chpwd($newpwd);
                if($res){
                    $data['code']    = 200;
                    $data['message'] = '密码修改成功';
                    $this->ajaxReturn($data);
                }else{
                    $data['code']    = 400;
                    $data['message'] = '密码修改失败';
                    $this->ajaxReturn($data);
                }
            }
        }
        $this->display('chpwd');
    }
    public function test(){
        $str_num = Help::remind_order_audio(1111);
        var_dump($str_num);exit;
        var_dump(Memcached::get('name'));
//        $mem = new \Memcache();
//        $mem->connect('127.0.0.1',11211);
//        $mem->set('name','fanhang');
    }
}