<?php
namespace Admin\Common;
use Admin\Model\AdminUserModel;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/30
 * Time: 10:10
 * 工具类
 */
class Help{
    /**
     * @param $code        请求数据返回的状态码
     * @param string $message     请求数据返回的提示消息
     * @param array $data  请求数据返回的数据
     * @return json        以json的格式返回数据
     */
    public static function returnJson($code,$message="",$data=array()){
        if(!is_numeric($code)){
            return json_encode($code);
        }
        return json_encode([$code,$message,$data]);
    }

    /**
     * 如果用户没有登录，则跳转到登陆页面
     * 检测用户是否登录
     */
    public static function checkLogin(){

        if(!isset($_SESSION["userId"]) || !isset($_SESSION["username"])){
            $login = C("ip_address")."/Admin/Index/index";
            header("Location:".$login."refresh:0");exit;
//            echo "<script type='text/javascript'>window.location.href='".$login."'</script>";
//            echo "<script language='JavaScript' type='text/javascript'>";
//            echo  "window.location.href='".$login."'";
//            echo    "</script>";
        }
    }

    /**
     * 获得随机字符串
     * @return string
     */
    public static function getRandsecrate(){
        $str = "1234567890abcdefghrjklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*~？,.";
        //将字符串打乱后随机截取字符串中的四个
        $shstr = str_shuffle($str);
        $pos = mt_rand(0,70);
        return substr($shstr,$pos,4);
    }

    /**
     * 对用户的登录密码进行加密
     * @param $value               用户密码
     * @param string $secrateKey    加密字段
     * @return string           返回加密后的字符串
     */
    public static function secrate ($value,$secrateKey=""){
        $secrateKey = empty($secrateKey) ? self::getRandsecrate() : $secrateKey;
        $secrateVal = md5(sprintf("%s@%s@%s",$secrateKey,$value,$secrateKey));
        return ["secrateKey"=>$secrateKey,"secrateVal"=>$secrateVal];
    }
    /**
     * 二维码在线生成
     */
    public static function tcode($aid){

        if(empty($aid)){
           return false;
        }
        /*根据用户传递过来的aid查找*/
        $sql = "SELECT ssid FROM think_mapping WHERE aid = ".intval($aid);
        $res = M()->query($sql);
        $ssid = $res[0]['ssid'];

        $tcode_url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."?ssid=".$ssid;
        $url = "http://qr.liantu.com/api.php?text=".$tcode_url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        if(empty($output)){
           return false;
        }
        /*如果生成二维码成功则将该生成的二维码保存到文件中*/
        $tcode_path = C("tcode_path");
        if(!is_dir($tcode_path)){
            mkdir($tcode_path,0777,true);
        }
        $tcode = $tcode_path.md5(time()).'.jpg';

        if(file_put_contents($tcode,$output)){
            /*将二维码图片插入到数据库中*/
            $admin = new AdminUserModel();
            $condition['id'] = intval($aid);
            $data['tdcode'] = $tcode;
            $res = $admin -> where($condition)->save($data);
            if($res){
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * 语音提示
     * @param $order_num 要语音提示的订单号系信息
     */
    public static function remind_order_audio($order_num){
        /*将阿拉伯数字转换为汉字数字*/
        $count = strlen($order_num);
        $str_order_num = array();
        for($i=0;$i<$count;$i++){
            switch(substr($order_num,$i,1)){
                case 0 :$str_order_num[] = '零';
                    break;
                case 1 :$str_order_num[] = '一';
                    break;
                case 2 :$str_order_num[] = '二';
                    break;
                case 3 :$str_order_num[] = '三';
                    break;
                case 4 :$str_order_num[] = '四';
                    break;
                case 5 :$str_order_num[] = '五';
                    break;
                case 6 :$str_order_num[] = '六';
                    break;
                case 7 :$str_order_num[] = '七';
                    break;
                case 8 :$str_order_num[] = '八';
                    break;
                case 9 :$str_order_num[] = '九';
                    break;
            }
        }
        $str_order_num = implode('',$str_order_num);
        $url = "http://tts.baidu.com/text2audio?lan=zh&ie=UTF-8&spd=2&text=请".$str_order_num."号到前台取餐";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        if(empty($output)){
            return false;
        }
        /*将音频存储到文件中*/
        $dir = DATA_PATH.'audios/'.session('username')."&".session('userId')."/";
        if(!is_dir($dir)){
            mkdir($dir,0777,true);
        }
        $file_name = md5(time()).".mp3";
        $des_file = $dir.$file_name;
        $destination = "/OrderFood/Eatery/Runtime/Data/audios/".session('username')."&".session('userId')."/".$file_name;

        if(file_put_contents($des_file,$output)){
            /*将该音频文件名存入到session中，并将其返回*/
            $sess_audio_resouse = session('audio_resouse');
            if($sess_audio_resouse){
                unlink($sess_audio_resouse);
                session('audio_resouse',null);
            }
            $sess_res = $dir.$file_name;
            session('audio_resouse',$sess_res);
            return $destination;
        }
    }

}