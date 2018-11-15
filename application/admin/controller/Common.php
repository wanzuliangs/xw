<?php
namespace app\admin\controller;

use think\Controller;

class Common extends Controller
{
    public function _initialize()
    {
        if (!session('loginname','','admin') || !session('loginid','','admin')) {
            $controller = request()->controller();
            $action = request()->action();
            if ($controller == 'Index' && $action == 'index') {
                $this->redirect('login/index');
            }
            $this->error('帐号没有登陆','login/index');
        }
    }
}