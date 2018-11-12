<?php


namespace app\admin\controller;


use think\Controller;

class Manager extends Controller
{
    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $validate = validate('Manager');
            if (!$validate->check($data)) {
                dump($validate->getError());
            } else {
                dump('验证通过');
            }
            return;
        }
        return view();
    }
}