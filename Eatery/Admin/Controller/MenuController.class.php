<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/2
 * Time: 16:44
 */
namespace Admin\Controller;
use Admin\Common\Help;
use Admin\Model\MenuModel;
use Think\Controller;
use Think\Upload;

class MenuController extends Controller{
    //我的菜单列表
    public function index(){
        Help::checkLogin();
        $menu = new MenuModel();
        $menu_list= $menu ->getMenuList();
        $this->assign("menu_list",$menu_list);
        $this->display("admin_menu_index");
    }
    /*添加菜单*/
    public function add_menu(){
        Help::checkLogin();
        if(isset($_POST['menuname'])){
            $data['menuname'] = $_POST['menuname'];
        }
        if(isset($_POST['price'])){
            $data['price'] = $_POST['price'];
        }
        if(isset($_POST['desc'])){
            $data['desc'] = $_POST['desc'];
        }
        /*处理图片的上传*/
        if(isset($_FILES['image']['name'])){
        $upload = new Upload();/*实例化上传类*/
        $upload -> maxSize =3145728;
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->subName = "Admin/menu_image";
        $info = $upload->upload();
         if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
         }else{// 上传成功
                $data['imagePath'] = $info['image']['savepath'].$info['image']['savename'];
                $menu = new MenuModel();
                if($menu -> addMenu($data)){
                    echo "<script>window.location.href='./index';</script>";
                }else{
                    echo "<script>alert('上传图片失败');window.history.back();</script>";
                }
         }
        }
        $this->display("admin_add_menu");
    }
    /**
     * 修改菜单
     */
    public function editMenu(){
        Help::checkLogin();
        $menu_id = I("get.menu_id","");
        if(!isset($menu_id)){
            return;
        }
        $menu = new MenuModel();
        $menu_info= $menu -> getRowById(intval($menu_id));
        if(isset($_POST['menuname'])){
            $data['menuname'] = $_POST['menuname'];
        }
        if(isset($_POST['price'])){
            $data['price'] = $_POST['price'];
        }
        if(isset($_POST['desc'])){
            $data['desc'] = $_POST['desc'];
        }
        /*处理图片的上传*/
        if(isset($_FILES['image']['name'])){
            /*删除原有的图片文件*/
            $remove_img = UPLOAD_PATH.$menu_info['image'];
            if(file_exists($remove_img)){
                @unlink($remove_img);
            }
            $upload = new Upload();/*实例化上传类*/
            $upload -> maxSize =3145728;
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
            $upload->subName = "Admin/menu_image";
            $info = $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
                $data['imagePath'] = $info['image']['savepath'].$info['image']['savename'];
                $menu = new MenuModel();
                if($menu -> editMenu($menu_id,$data)){
                    echo "<script>window.location.href='./index';</script>";
                }else{
                    echo "<script>alert('上传图片失败');window.history.back();</script>";
                }
            }
        }
        $this->assign("menu_info",$menu_info);
        $this->display("admin_menu_edit");
    }
    /**
     * 删除菜单中的记录
     */
    public function removeMenu(){
        Help::checkLogin();
        $menu_id = I("get.menu_id","");
        if(empty($menu_id)){
            echo 0;
        }
        $menu = new MenuModel();
        $menu_info= $menu -> getRowById(intval($menu_id));
        $res = $menu->removeById(intval($menu_id));
        if($res){
            $remove_img = UPLOAD_PATH.$menu_info['image'];
            if(file_exists($remove_img)){
                @unlink($remove_img);
            }
            echo 1;
        }else{
            echo 0;
        }
    }
//    public function add(){
//        Help::checkLogin();
//
//    }
}