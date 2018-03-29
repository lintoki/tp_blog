<?php
namespace app\test\controller;
use think\Controller;
use think\Request;
use think\Db;

class Testdb extends Controller
{
    public function ins()
    {
        $result=Db::execute('insert into testone (content) VALUES (?)',["dfgdfgdfgdf"]);
        dump($result);
    }

    public function sec(){
        $result=Db::query('select * from testone');
        dump($result);
    }

    public function tesd(){
//        DB::table("testone")->insert(['content'=>'sdfsdfhgfh']);
//        $res = DB::name("testone")->field('content')->order('id','desc')->limit(5)->select();
//        dump($res);
        $db=db('testone');
        $res = $db->field('content')->order('id','desc')->limit(10)->select();
        dump($res);
    }
}
