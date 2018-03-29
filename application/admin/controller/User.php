<?php
namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\User as UserModel;
use app\admin\validate\User as userVad;

class User extends Base
{
    protected $notCheckLogin = ['add','insert'];
    public function add(){
        return $this->fetch();
    }
    public function insert(){
        $data=input('post.');
        $val = new userVad();
        if(!$val->check($data)){
            $this->error($val->getError());
            exit;
        }
        $user = new UserModel();
        $res = $user->allowField(true)->save($data);
        if($res){
            $this->success("创建成功","login/login/login");
            //$this->redirect('User/view');
        }
        else{
            $this->error("创建失败");
        }
    }

    public function view(){
        //$data = UserModel::all();
        //$this->assign("data",$data);
        //return $this->fetch();
        $data = UserModel::paginate(6);
        $page = $data->render();
        $this->assign("data",$data);
        $this->assign("page","$page");
        return $this->fetch();
    }

    public function edit(){
        $id=input('get.id');
        $user=UserModel::get($id);
        $this->assign('user',$user);
        return $this->fetch();
    }

    public function update(){
        $data=input('post.');
        $id = input('post.id');
        $val = new userVad();
        if(!$val->check($data)){
            $this->error($val->getError());
            exit;
        }
        $user = new UserModel();
        $res = $user->allowField(true)->save($data,['id'=>$id]);
        if($res){
            $this->redirect('User/view');
        }
        else{
            $this->error("修改失败");
        }
    }

    public function delete(){
        $id=input('get.id');
        dump($id);
        $res = UserModel::destroy($id);
        //$res = UserModel::destroy($id,true);
        if($res){
            $this->redirect('User/view');
        }
        else{
            $this->error("修改失败");
        }
    }

    public function logout(){
        session(null);
        return $this->redirect('login/login/login');
    }

}