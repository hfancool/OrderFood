<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/2
 * Time: 16:44
 */
namespace Admin\Controller;
use Admin\Common\Help;
use Think\Controller;

class MenuController extends Controller{
    //我的菜单列表
    public function index(){
        Help::checkLogin();
        $this->display("admin_menu_index");
    }
    /*添加菜单*/
    public function add_menu(){
        Help::checkLogin();
        $this->display("admin_add_menu");
    }
}