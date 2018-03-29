<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Base extends Controller{
    protected $notCheckLogin = [''];
    protected function _initialize(){
        if(!$this->isLogin()&&!in_array(Request::instance()->action(),$this->notCheckLogin)){
            $this->error('请先登录！！','login/login/login');
        }
    }

    public function isLogin(){
        return session('?name');
    }
}