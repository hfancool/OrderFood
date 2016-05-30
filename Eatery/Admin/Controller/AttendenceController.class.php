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
        $time = time();
        $atd = new AttendenceModel();
        $users = $atd->getListByTime($time);
        Vendor("Excel.PHPExcel");
        $objExcel = new \PHPExcel();
        $objWriter = new \PHPExcel_Writer_Excel2007($objExcel);
        /*从数据库中获取数据集*/
        $objExcel->getProperties()->setCreator(session('username'));/*设置创建者*/
        $objExcel->getProperties()->setTitle("雇员考勤列表确认");/*设置标题*/
        $objExcel->setActiveSheetIndex(0);/*设置当前的sheet*/
        sort($users);
        $count = count($users);
        $objExcel->getActiveSheet()->setCellValue('A1' , '雇员姓名');
        $objExcel->getActiveSheet()->setCellValue('B1' , '到勤');
        $objExcel->getActiveSheet()->setCellValue('C1' , '病假');
        $objExcel->getActiveSheet()->setCellValue('D1' , '事假');
        $objExcel->getActiveSheet()->setCellValue('E1' , '矿工');
        $objExcel->getActiveSheet()->setCellValue('F1' , '迟到');
        $objExcel->getActiveSheet()->setCellValue('G1' , '早退');
        $objExcel->getActiveSheet()->setCellValue('H1' , '备注');
        $objExcel->getActiveSheet()->setCellValue('I1' , '签字确认');
        for($i=2;$i<=$count+1;$i++){
            $objExcel->getActiveSheet()->setCellValue('A' . $i, $users[$i-2]['username']);
            $objExcel->getActiveSheet()->setCellValue('B' . $i, $users[$i-2]['attend']);
            $objExcel->getActiveSheet()->setCellValue('C' . $i, $users[$i-2]['sick']);
            $objExcel->getActiveSheet()->setCellValue('D' . $i, $users[$i-2]['personal']);
            $objExcel->getActiveSheet()->setCellValue('E' . $i, $users[$i-2]['absent']);
            $objExcel->getActiveSheet()->setCellValue('F' . $i, $users[$i-2]['be_late']);
            $objExcel->getActiveSheet()->setCellValue('G' . $i, $users[$i-2]['early_leave']);
            $objExcel->getActiveSheet()->setCellValue('H' . $i, $users[$i-2]['remarks']);
        }
        /*输出到浏览器让其保存*/
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");;
        header('Content-Disposition:attachment;filename="雇员考勤表.xls"');
        header("Content-Transfer-Encoding:binary");
        $objWriter->save('php://output');
    }
}