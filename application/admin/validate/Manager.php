<?php
namespace app\admin\validate;

use think\Validate;

class Manager extends Validate
{
    protected $rule =   [
        'account'  => 'require|min:4|unique:admin',
        'password'   => 'require|min:6|confirm:repass',
        'repass'=>'require',
        'code'=>'require|captcha'
    ];

    protected $message  =   [
        'account.require' => '帐号不能为空',
        'account.min' => '帐号长度不能小于4位',
        'account.unique' => '帐号已存在',
        'password.require'=>'密码不能为空',
        'password.min'=>'密码长度不能小于6位',
        'password.confirm' => '两次密码输入不一致',
        'repass.require' => '密码确认不能为空',
        'code.require' => '验证码不能为空',
        'code.captcha' => '验证码不正确',

    ];

    protected $scene = [
        'edit'  =>  ['password','repass'],
        'login' => ['account'  => 'require|min:4','password' => 'require|min:6','code',],
    ];
}