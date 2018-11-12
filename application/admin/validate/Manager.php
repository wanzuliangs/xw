<?php
namespace app\admin\validate;

use think\Validate;

class Manager extends Validate
{
    protected $rule =   [
        'account'  => 'require|min:4|unique:admin',
        'password'   => 'require|min:6',
        'repass'=>'require|confirm:password'
    ];

    protected $message  =   [
        'name.require' => '帐号不能为空',
        'name.min' => '帐号长度不能小于4位',
        'name.unique' => '帐号已存在',
        'password.require'=>'密码不能为空',
        'password.min'=>'密码长度不能小于6位',
    ];
}