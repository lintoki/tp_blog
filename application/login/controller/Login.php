<?php
namespace app\login\controller;
use think\Controller;
use app\admin\model\User;

class Login extends Controller
{
    public function login(){
        return $this->fetch();
    }

    public function loginIndex(){
        $data=input('post.');
        $user = new User();
        $res = $user->where('name',$data['name'])->find();
        if($res){
            if($res['password']===md5($data['password'])){
                session('name',$data['name']);
            }
            else{
                $this->error("密码不对");
            }
        }
        else{
            $this->error("用户不存在");
        }
        if(captcha_check($data['code'])){
            return $this->redirect("admin/index/index");
        }
        else{
            $this->error("验证码错误");
        }
    }
}