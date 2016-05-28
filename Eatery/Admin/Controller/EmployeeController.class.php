<?php
namespace Admin\Controller;
use Admin\Model\EmployeeModel;
use Admin\Model\LevelModel;
use Think\Controller;

/**
 * 雇员控制器
 * Class EmployeeController
 * @package Admin\Controller
 */
class EmployeeController extends Controller{
    /**
     * 雇员列表
     */
    public function index(){
        $employs = new EmployeeModel();
        $list = $employs->getList();
        /*将获得的该商家的雇员列表注册到模板中*/
        /*遍历数据，并进行相应的处理*/
        $count = count($list);
        for($i=0;$i<$count;$i++){
            $list[$i]['birthday'] =date('Y/m/d',$list[$i]['birthday']);
            $list[$i]['sex'] = $list[$i]['sex'] == 0 ? '保密':($list[$i]['sex'] == 1 ? '男':"女");

        }
        $this->assign('list',$list);
        $this->display('admin_employee_index');
    }
    /**
     * 雇员添加
     */
    public function add_employee(){
        /*查找等级列表*/
        $level = new LevelModel();
        $level_list = $level->getList();
        $this ->assign('level_list',$level_list);
        $this ->display('admin_employee_add');
    }
    /**
     * 雇员添加
     */
    public function insert(){
        $birthday = I('post.birthday','',htmlentities);
        $addtime  = time();
        $date['aid'] = intval(session('userId'));
        $date['username'] = I('post.username','',htmlentities);
        $date['sex']      = I('post.sex','',htmlentities);
        $date['age']      = date('Y',$addtime) - date('Y',strtotime($birthday));
        $date['birthday'] = strtotime($birthday);
        $date['tel_phone']= I('post.mobile','',htmlentities);
        $date['level_id'] = I('post.level_id','',htmlentities);
        $date['addtime']  = $addtime;

        $emp = new EmployeeModel();
        $res = $emp ->add($date);
        if(!$res){
            $data['code'] = 400;
            $data['message'] = '雇员添加失败';
            $this->ajaxReturn($data);
        }else{
            $data['code'] = 200;
            $data['message'] = '雇员添加成功';
            $this->ajaxReturn($data);
        }
    }
    /**
     * 雇员删除
     */
    public function del_employee(){
        $eid = I('get.eid','',htmlspecialchars);
        if(empty($eid)){
            $data['code'] = 400;
            $data['message'] = '请选择要删除的雇员';
            $this->ajaxReturn($data);
        }
        $condition['id'] = intval($eid);
        $emp = new EmployeeModel();
        $res = $emp->where($condition)->delete();
        if($res){
            $data['code']    = 200;
            $data['message'] = '雇员删除成功';
            $this->ajaxReturn($data);
        }else{
            $data['code'] = 400;
            $data['message'] = '雇员删除失败';
            $this->ajaxReturn($data);
        }
    }
    /**
     * 雇员编辑
     */
    public function edit_employee(){

    }
}
