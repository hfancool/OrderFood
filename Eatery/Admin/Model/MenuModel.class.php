<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/4
 * Time: 22:33
 */
namespace Admin\Model;
use Think\Model;

class MenuModel extends Model{
    /**
     * 获取菜单列表
     */
    public function getMenuList(){
        /*获取当前用户的菜单*/
        $user_id = session("userId");
        $condition["parent_id"] = $user_id;
        $res=$this -> where($condition) ->select();
        for($i=0;$i<count($res);$i++){
            $res[$i]['image'] = "Uploads/".$res[$i]["image"];
        }
        return empty($res) ? false : $res;
    }
    /**
     * 通过aid获取菜单列表
     */
    public function getMenuListByAid($aid){
        $condition["parent_id"] = $aid;
        $res=$this -> where($condition) ->select();
        for($i=0;$i<count($res);$i++){
            $res[$i]['image'] = "Uploads/".$res[$i]["image"];
        }
        return empty($res) ? false : $res;
    }
    /**
     * 将上传的菜单保存到数据库中
     * @param $data
     */
    public function addMenu($data){
        if(empty($data)){
            return false;
        }
        $condition['parent_id'] = intval(session("userId"));
        $condition['name']  = $data['menuname'];
        $condition['desc']  = $data['desc'];
        $condition['image'] = $data['imagePath'];
        $condition['price'] = floatval($data['price']);
        if($this ->add($condition)){
            return true;
        }
        return false;
    }

    /**
     * 更新数据库中的数据
     * @param $menu_id
     * @param $data
     * @return bool
     */
    public function editMenu($menu_id,$data){
        $condition['menu_id'] = $menu_id;
        $edit['name']  = $data['menuname'];
        $edit['desc']  = $data['desc'];
        $edit['image'] = $data['imagePath'];
        $edit['price'] = floatval($data['price']);
        if($this->where($condition)->save($edit)){
            return true;
        }
        return false;
    }

    /**
     * 通过菜单id 获得一条记录
     * @param  int $menu_id 菜单id
     */
    public function getRowById($menu_id){
        if(!is_numeric($menu_id)){
           return false;
        }
        $condition['menu_id'] = intval($menu_id);
        $res = $this->where($condition)->select();
        return isset($res) ? $res[0] : false;
    }

    /**
     * 通过菜单 id 删除菜单记录
     * @param $menu_id
     */
    public function removeById($menu_id){
        if(!is_numeric($menu_id)){
            return false;
        }
        $condition['menu_id'] = intval($menu_id);
        $res = $this->where($condition)->delete();
        return $res;
    }

}