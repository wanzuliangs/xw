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
                $this->error($validate->getError());
            } else {
                // 去掉确认密码
                unset($data['repass']);
                $data['password'] = md5($data['password']);
                // 插入数据
                if (db('admin')->insert($data)) {
                    $this->success('管理员添加成功!','add');
                } else {
                    $this->success('管理员添加失败!','add');
                }
            }
            return;
        }
        return view();
    }
}