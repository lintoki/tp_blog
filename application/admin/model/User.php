<?php
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;

class User extends Model
{
    //软删除
    use SoftDelete;
    protected static $deleteTime = 'delete_time';

    //自动处理的字段
    protected $auto=['password','repassword'];

    protected function setPasswordAttr($value){
        return md5($value);
    }

    protected function setRepasswordAttr($value){
        return md5($value);
    }
}
