<?php
namespace app\admin\controller;

use houdunwang\arr\Arr;
use app\admin\controller\Base;
use app\admin\model\Category as Cate;
use app\admin\validate\Category as CateCheck;

class Category extends Base
{
    protected $cate;
    protected $notCheckLogin = [];
    protected function _initialize()
    {
        parent::_initialize();
        $this->cate = new \app\admin\model\Category();
    }

    public function index(){
//        $data=Cate::paginate(2);
//        $page=$data->render();
//        $this->assign("page",$page);
//        <!--<div style="float:right" class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">{$page}</div>-->
        $data = Arr::tree(Cate::all(),'cate_name',$fieldPri = 'cate_id', $fieldPid = 'cate_pid');
        $this->assign("data",$data);
        return $this->fetch();
    }
    public function add(){
        return $this->fetch();
    }

    public function store(){
        if(request()->isPost()){
            $data = input('post.');
            //验证数据准确性
            $check = new CateCheck();
            if(!$check->check($data)){
                $this->error($check->getError());
                exit;
            }
            //存储数据
            $res = $this->cate->allowField(true)->save($data);
            return $this->redirect("Category/index");
        }
    }

    public function addson(){
        $param=input('param.id');
        $cate = new Cate();
        $data = Cate::get(['cate_id'=>$param]);
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function edit(){
        if(request()->isPost()){
            $param = input('post.');
            $check = new CateCheck();
            if(!$check->check($param)){
                $this->error($check->getError());
                exit;
            }
            $res = $this->cate->allowField(true)->save($param,['cate_id'=>$param['cate_id']]);
            if($res){
                return $this->redirect("Category/index");
            }
            exit;
        }
        $param = input('param.id');
        $oldData = $this->cate->getByCate_id($param);
        $data = $this->cate->getCateData($param);
        $this->assign('oldData',$oldData);
        $this->assign('data',$data);
        return $this->fetch();

    }

    public function getTree(){
        //树状目录
        $data = Arr::tree(db('category')->select(),'cate_name',$fieldPri = 'cate_id', $fieldPid = 'cate_pid');
//        $data = Arr::tree(Cate::all(),'cate_name',$fieldPri='cate_id',$fieldPid='cate_pid');
//        dump($data);
        dump(Cate::all());
    }

    public function delete(){
        $param = input('param.');
        dump($param);
        $this->cate->cate_del($param['id'],$param['pid']);
        return $this->redirect("Category/index");
    }
}