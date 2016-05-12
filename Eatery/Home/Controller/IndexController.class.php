<?php
namespace Home\Controller;
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
        $this->assign('menu_list',$menu_list);
        $this->display('index');
    }

    public function order_food(){

    }


}