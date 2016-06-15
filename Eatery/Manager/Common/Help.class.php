<?php
namespace Manager\Common;
class Help {
    public static function check_login(){
        $managerId   = session('managerId');
        $managername = session('managername');
        if(empty($managerId) || empty($managername)){
            return false;
        }
        return true;
    }
}