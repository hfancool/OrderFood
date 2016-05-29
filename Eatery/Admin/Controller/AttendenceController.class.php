<?php
namespace Admin\Controller;
use Admin\Common\Help;
use Admin\Model\AttendenceModel;
use Think\Controller;

class AttendenceController extends Controller{
    /**
     * 雇员考勤首页界面
     */
    public function index(){
        Help::checkLogin();
        $eid = I('get.eid','',htmlspecialchars);
        $time =  date('Y-m-d H:i:s',time());
        $this->assign('time',$time);
        $this->assign('eid',$eid);
        $this->display('index');
    }
    /**
     * 雇员考勤
     */
    public function violation(){
        Help::checkLogin();
        $atd = new AttendenceModel();
        $eid = I('get.eid','',htmlspecialchars);
        /*查看该用户今天是否已经考勤*/
        if($atd ->is_violation_today($eid)){
            $data['code']    = 400;
            $data['message'] = '该雇员今天已考勤';
            $this->ajaxReturn($data);
            exit;
        }
        $att = I('get.att','',htmlspecialchars);
        $vio = I('get.vio','',htmlspecialchars);
        /*更新考勤表中的数据*/
        $res = $atd -> updateRecord($eid,$att,$vio);
        if($res){
            $data['code'] = 200;
            $data['message'] = '考勤成功';
            $this->ajaxReturn($data);
        }else{
            $data['code'] = 400;
            $data['message'] = '考勤失败';
            $this->ajaxReturn($data);
        }
    }
    /**
     * 导出考勤表到Excel文件中
     */
    public function getViolationTOExcel(){
        Vendor("Excel.PHPExcel");
        $objExcel = new \PHPExcel();
        $objWriter = new \PHPExcel_Writer_Excel2007($objExcel);
        /*从数据库中获取数据集*/
//        $objExcel->createSheet();
//        $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');

        $objWriter->save('Public/output.xlsx');
    }
}