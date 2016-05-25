<?php
namespace Admin\Controller;
use Admin\Model\EmployeeModel;
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

    }
}
