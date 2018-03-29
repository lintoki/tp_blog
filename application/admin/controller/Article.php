<?php

namespace app\admin\controller;

class Article extends Base
{
    protected $art;
    protected function _initialize()
    {
        parent::_initialize();
        $this->art = new \app\admin\model\Article();
    }

    public function index(){
        return $this->fetch();
    }

    public function add(){
        return $this->fetch();
    }

    public function store(){

    }

    public function edit(){
        return $this->fetch();
    }

    public function delete(){
        return $this->fetch();
    }
}