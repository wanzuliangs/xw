<?php


namespace app\admin\controller;


use think\Controller;

class Manager extends Controller
{
    public function add()
    {
        if (request()->isPost()) {
            echo '数据处理...';
            return;
        }
        return view();
    }
}