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
        $this->display('admin_employee_index');
    }
}
