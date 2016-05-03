<?php
namespace Admin\Common;
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
            header("Location:".$login);exit;
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
     * @param $pwd              用户密码
     * @param string $secrate   加密字段
     * @return string           返回加密后的字符串
     */
    public static function secrate ($pwd,$secrate=""){
        $secrate = empty($secrate) ? self::getRandsecrate() : $secrate;
        $secratePWD= md5(sprintf("%s@%s@%s",$secrate,$pwd,$secrate));
        return ["secrate"=>$secrate,"secratePWD"=>$secratePWD];
    }

}