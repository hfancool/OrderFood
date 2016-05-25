<?php

namespace Admin\Controller;
use Admin\Model\LevelModel;
use Think\Controller;

/**
 * 雇员等级管理
 * Class LevelController
 * @package Admin\Controller
 */
class LevelController extends Controller{
    /**
     * 显示当前商家的雇员等级列表
     */
    public function index(){
        $level = new LevelModel();
        $list = $level->getList();

        $this->assign('list',$list);
        $this->display('list');
    }
    /**
     * 怎加雇员等级列表
     */
    public function add_level(){
        $this->display('add');
    }
    public function insert(){
        $level_id = I('get.level_id','',htmlspecialchars);
        $level_name = I('get.level_name','',htmlspecialchars);
        $salary = I('get.salary','',htmlspecialchars);
        if(empty($level_id) || empty($level_name) || empty($salary)){
            return;
        }
        $level = new LevelModel();
        $condition['level_id'] = intval($level_id);
        $check = $level->where($condition)->select();
        if(!isset($check)){
            $returnData['code'] = 400;
            $returnData['message'] =$check;
            $this->ajaxReturn($returnData);
            exit;
        }
        $data['level_id'] = intval($level_id);
        $data['level_name'] = $level_name;
        $data['salary'] = intval($salary);
        $data['aid'] = intval(session('userId'));
        $res = $level->add($data);
        if($res){
            $returnData['code'] = 200;
            $returnData['message'] = '添加成功';
            $this->ajaxReturn($returnData);
        }else{
            $returnData['code'] = 400;
            $returnData['message'] = '添加失败';
            $this->ajaxReturn($returnData);
        }

    }
    /**
     * 删除雇员等级列表
     */
    public function del_level(){
        $level_id = I('get.level_id','',htmlentities);
        if(empty($level_id)){
            return;
        }
        $condition['level_id'] = intval($level_id);
        $level = new LevelModel();
        $res = $level ->where($condition)->delete();
        if(!IS_AJAX){
            return $res;
        }
        if($res){
            $data['code'] = 200;
            $data['message'] = '操作成功';
            $this -> ajaxReturn($data);
        }else{
            $data['code'] =400;
            $data['message'] = '操作失败';
            $this -> ajaxReturn($data);
        }
    }
    /**
     * 修改雇员等级列表
     */
    public function edit_level(){
        $level_id   = I('get.level_id','',htmlspecialchars);
        $level_name = I('get.level_name','',htmlspecialchars);
        $salary     = I('get.salary','',htmlspecialchars);
        $data = ['level_name'=>$level_name,'salary'=>$salary];
        $level = new LevelModel();
        $res = $level ->editLevel($level_id,$data);
        /*如果不是ajax请求则直接返回数据库操作后的结果*/
        if(!IS_AJAX){
            return $res;
        }
        if($res){
            $returnData['code'] = 200;
            $returnData['message'] = '更新等级成功';
            $this->ajaxReturn($returnData);
        }else{
            $returnData['code'] = 400;
            $returnData['message'] = '更新等级失败';
            $this->ajaxReturn($returnData);
        }
    }
}