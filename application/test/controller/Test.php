<?php
namespace app\test\controller;
use think\Controller;
use think\Request;
use think\Db;

class Test extends Controller
{
    public function test()
    {
       //print_r($this->request->param());
        $p = $this->request->param();
       $data = DB::name('testone')->find();
//       print_r($p);
       $this->assign('data',$data);
//        $this->assign('p',json($p));
       return $this->fetch();
    }


    //http://47.100.169.35/tp5/public/test/test/hello/name/dfgdf/age/34534
    public function hello($name='rewerwer',$age=12)
    {
        echo $name,'issssssssssss__',$age;
        print_r($this->request->param());
    }
}
