<?php


namespace app\admin\controller;


use think\Controller;

class Manager extends Controller
{
    public function add()
    {
        if (request()->isPost()) {
        
            var_dump(input('post.'));
            return;
        }
        return view();
    }
}