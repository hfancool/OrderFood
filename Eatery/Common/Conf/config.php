<?php
return array(
	//'配置项'=>'配置值'
    'DB_TYPE' => 'mysql', // 数据库类型
    'DB_HOST' => 'localhost', // 服务器地址
    'DB_NAME' => 'eatery', // 数据库名
    'DB_USER' => 'root', // 用户名
    'DB_PWD' => 'fanhang', // 密码
    'DB_PORT' => 3306, // 端口
    'DB_PREFIX' => 'think_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    /*当前的服务器的ip地址*/
    "ip_address"=>$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["SCRIPT_NAME"],

    /*验证码生成配置参数*/
    'verify' =>array(
        'fontSize'=>15,
        'length'  =>4
    ),
    /*memcached 配置文件*/
    "memcached" =>array(
        "host" => "127.0.0.1",
        "port" => 11211,
    ),
    /*菜单图片的上传地址*/
    "UPLOAD_PATH" => UPLOAD_PATH,
    'tcode_path' => 'Public/Admin/tcode/',/*商家二维码存放路劲*/
);