<?php

namespace app\admin\validate;

use think\Validate;

class Tags extends Validate
{
    protected $rule = [
        "tag_name"=>"require"
    ];

    protected $message = [
        "tag_name.require"=>"标签名不能为空"
    ];
}