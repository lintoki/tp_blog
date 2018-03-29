<?php
namespace app\admin\model;

use think\Collection;
use think\Model;
use houdunwang\arr\Arr;
use traits\model\SoftDelete;

class Category extends Model
{
//    protected $resultSetType = 'collection';
    use SoftDelete;
    protected $deleteTime = 'deleted';
    protected $pk = 'cate_id';
    public function getCateData($param){
        //获取子集
        $cate_ids = $this->getSon(db('category')->select(),$param);
        //将自己追加进去
        $cate_ids[]=$param;
        //找到之外数据
        $field = db('category')->whereNotIn('cate_id',$cate_ids)->select();
        $data = Arr::tree($field,'cate_name',$fieldPri ='cate_id',$fieldPid = 'cate_pid');
        return $data;
    }

    public function getSon($data,$pid){
        static $temp=[];
        foreach($data as $k=>$v){
            if($pid==$v['cate_pid']){
                $temp[]=$v['cate_id'];
                $this->getSon($data,$v['cate_id']);
            }
        }
        return $temp;
    }

    public function cate_del($cate_id,$cate_pid){
        $this->transaction(function() use($cate_id,$cate_pid){
            $cate_ids = $this->where('cate_pid',$cate_id)->column('cate_id');
            dump(Collection($cate_ids)->toArray());
            $this->whereIn('cate_id',$cate_ids)->update(['cate_pid'=>$cate_pid]);
            $this->where('cate_id',$cate_id)->delete();
//            $this->whereIn('cate_id',);
        });
    }
}