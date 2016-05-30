<?php
namespace Home\Controller;
use Admin\Model\AdminUserModel;
use Admin\Model\MenuModel;
use Common\Memcached;
use Think\Controller;

/**
 * 用户点餐控制器
 * Class IndexController
 * @package Home\Controller
 */
class IndexController extends Controller {
    /**
     * 用户点餐时的欢迎首页面
     */
    public function index(){
        /*获取用户扫码传递过来的参数*/
        $ssid = I('get.ssid','',htmlspecialchars);
        /*根据ssid 查找用户当前扫码的餐厅id*/
        if(!empty($ssid)){
            $sql = "SELECT aid FROM think_mapping WHERE ssid = '".$ssid."'";
            $res = M()->query($sql);
        }
        $aid = $res[0]['aid'];
        $menu = new MenuModel();
        $menu_list=$menu -> getMenuListByAid($aid);
        if(!$menu_list){
            echo "获取菜单列表失败";
            return;
        }
        $admin = new AdminUserModel();
        $condition['id'] = $aid;
        $storename = $admin->where($condition)->getField('storename');
        if($storename){
            $this->assign('storename',$storename);
        }else{
            $this->assign('storename','当前点餐');
        }
        /*将商家的ssid保存到cookie中，方便用户以后的操作*/
        cookie('ssid',$ssid,array('expire'=>3600,'prefix'=>'menu_'));
        $this->assign('menu_list',$menu_list);
        $this->display('index');
    }

    /**
     * 当用户在浏览列表时点击列表项时浏览该项的详细信息
     */
    public function show_info(){
        /*获取菜单id*/
        $menu_id = I('get.menu_id','',htmlspecialchars);
        $menu = new MenuModel();
        $menu_info= $menu -> getRowById(intval($menu_id));
        $this->assign("menu_info",$menu_info);
        $this->display("menuInfo");
    }
    /**
     * 处理购物车功能
     */
    public function category(){
        /*将用户提交的订单存储到session中*/
        $category_menu = session('category');
        if(!isset($category_menu)){
            $category_menu = array();
        }
        $_POST['total_pay'] = doubleval($_POST['price']) * intval($_POST['num']);
        array_push($category_menu,$_POST);
        if(session('category',$category_menu) == null){
            echo 1;/*添加成功*/
        }else{
            echo 0;/*添加失败*/
        }
    }
    /**
     * 用户查看自己的购物车
     */
    public function check_category(){
        /*将购物车中添加的数据返回给客户*/
        $category_menu = session('category');
//        var_dump($category_menu);exit;
        if(isset($category_menu)){
            $this->assign('my_order',$category_menu);
        }
        $this->display('category');
    }

    /**
     * 清空购物车中的数据
     */
    public function clean_category(){
        if(session('category')){
           session('category',null);
        }
    }
    /**
     * 根据menu_id 删除购物车中的记录
     */
    public function remove_category(){
        $menu_id = I('get.menu_id',"",htmlentities);
        $num = I('get.num',0,htmlspecialchars);
        $category_menu = session('category');
        if(!isset($category_menu)){
            echo 1;/*没有数据*/
        }
        reset($category_menu);
        while(list($key,$val) = each($category_menu)){
            if($val['menu_id'] == $menu_id && $val['num'] == $num){
                unset($category_menu[$key]);
                break;
            }
        }
        session('category',$category_menu);
    }
    /**
     * 处理当前用户的订单，将用户的订单存储到memcached中
     * 1、获取商家的ssid
     * 2、为当前订单分配惟一的编号
     * 3、获取购物车中菜单的信息
     * 该方法是当用户在线支付成功之后自动调用的方法
     * 由于暂时还没有实现在线支付功能，所以在此先进行免支付以实现功能
     */
    public function order_food(){
        /*获取商家的ssid*/
        $ssid = cookie('menu_ssid');/*将ssid作为memcached中的key*/
        if(empty($ssid)){
            return;
        }
        /*用户的惟一id，为了保证点餐号的唯一性，暂时取点餐号暂时使用时间戳后6位，有待改进*/
        $id = substr(strval(time()),4);//TODO 有待修改
        /*获取session中的点餐信息*/
        $category = session('category');
        if(empty($category)){
            return;
        }
        /*定义memcached中的val*/
        $order_info[$id] = array();
        $count = count($category);
        for($i=0;$i<$count;$i++){
            $temp=array(
                'menu_id'=>$category[$i]['menu_id'],
                'num'    =>$category[$i]['num']
            );
            $order_info[$id][] = $temp;
        }

        if(!Memcached::get($ssid)){
            $order = array();
            array_push($order,$order_info);
            /*将组装好的数据存储到memcached中*/
            $order_info = serialize($order);
            if(Memcached::set($ssid,$order_info)){
                $data['code']  = '200';
                $data['id']    = $id;
                $data['message']    = "下单成功";
                $this->ajaxReturn($data);
            }else{
                $data['code']  = '400';
                $data['message']    = "下单失败";
                $this->ajaxReturn($data);
            }
        }else{
            $temp =unserialize(Memcached::get($ssid));
            $temp[] = $order_info;
//            array_push($temp,$order_info);
            $order_info = serialize($temp);
            if(Memcached::set($ssid,$order_info)){
                $data['code']  = '200';
                $data['order_id']    = $id;
                $data['message']    = "下单成功";
                $this->ajaxReturn($data);
            }else{
                $data['code']  = '400';
                $data['message']  = '下单失败';
                $this->ajaxReturn($data);
            }
        }

    }
    public function clean(){
        $ssid = cookie('menu_ssid');/*将ssid作为memcached中的key*/
        Memcached::remove($ssid);
    }
    public function get(){
        $ssid = cookie('menu_ssid');/*将ssid作为memcached中的key*/
        var_dump(unserialize(Memcached::get($ssid)));
    }

}