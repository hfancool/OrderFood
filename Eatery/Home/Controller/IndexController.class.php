<?php
namespace Home\Controller;
use Admin\Model\AdminUserModel;
use Admin\Model\MenuModel;
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
     * 处理当前用户的订单，将用户的订单存储到memcached中
     */
    public function order_food(){

    }


}