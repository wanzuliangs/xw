<?php

namespace app\admin\validate;

use think\Validate;

class Category extends Validate
{
    protected $rule = [
        'name'  => 'require',
    ];

    protected $message = [
        'name.require' => '栏目名不能为空',
    ];
}


