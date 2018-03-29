<?php

namespace app\admin\controller;

use think\Controller;
use app\admin\controller\Base;
use app\admin\validate\Tags as tagVal;

class Tags extends Base
{
    protected $notCheckLogin = [];

    protected $tag;
    protected function _initialize()
    {
        parent::_initialize();
        $this->tag = new \app\admin\model\Tags();
    }

    public function index(){
        $data = $this->tag->paginate(2);
        $page = $data->render();
        $this->assign([
            "data"=>$data,
            "page"=>$page
        ]);
        return $this->fetch();
    }

    public function add(){
        return $this->fetch();
    }

    public function store(){
        $param = input('post.');
        $check = new tagVal();
        if(!$check->check($param)){
            $this->error($check->getError());
            exit;
        }
        $res = $this->tag->allowField(true)->save($param);
        if($res){
            return $this->redirect('Tags/index');
        }
    }

    public function edit(){
        if(request()->isPost()){
            $param = input('post.');
            $check = new tagVal();
            if(!$check->check($param)){
                $this->error($check->getError());
                exit;
            }
            $res = $this->tag->allowField(true)->save($param,['tag_id'=>$param['tag_id']]);
            if($res){
                return $this->redirect('Tags/index');
            }
        }
        $param = input('param.id');
        $oldData = $this->tag->getByTag_id($param);
        $this->assign('oldData',$oldData);
        return $this->fetch();
    }

    public function delete(){
        $param = input('param.id');
        $res = $this->tag->destroy($param);
        if($res){
            return $this->redirect('Tags/index');
        }
    }
}