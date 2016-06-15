<?php
namespace Admin\Controller;
use Think\Controller;

class HotSaleController extends Controller{
    public function index(){
        $this->display('admin_hot_sale');
    }
}