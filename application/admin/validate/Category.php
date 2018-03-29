<?php

namespace app\admin\validate;

use think\Validate;

class Category extends Validate
{
    protected $rule = [
        "cate_name"=>"require",
        "cate_sort"=>"require|number|between:1,9999"
    ];

    protected $message = [
        'cate_name.require'=>'标签名不能为空',
        'cate_sort.require'=>'栏目排序不能为空',
        'cate_sort.number'=>'栏目排序必须为数字',
        'cate_sort.between'=>'栏目排序必须在1-9999之间',
    ];
}