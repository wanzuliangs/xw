<?php
namespace app\admin\controller;

use think\Controller;

class Common extends Controller
{
    public function _initialize()
    {
        if (!session('loginname','','admin') && !session('loginid','','admin')) {
            $this->error('帐号没有登陆','login/index');
        }
    }
}