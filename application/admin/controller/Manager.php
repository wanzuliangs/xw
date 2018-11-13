<?php

namespace app\admin\controller;

use think\Controller;

class Manager extends Controller
{
    public function index()
    {
        $adminList = db('admin')->paginate(2);;
        $this->assign('adminList', $adminList);
        return view();
    }

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
                    $this->success('管理员添加成功!', 'add');
                } else {
                    $this->success('管理员添加失败!', 'add');
                }
            }
            return;
        }
        return view();
    }

    public function edit($id)
    {
        if (request()->isPost()) {
            $data = input('post.');
            // 帐号存在时去掉
            if (isset($data['account'])) {
                unset($data['account']);
            }
            if (!$data['password']) {
                unset($data['password']);
                unset($data['repass']);
            } else {
                unset($data['repass']);
                $data['password'] = md5($data['password']);
                $validate = validate('Manager');
                if (!$validate->scene('edit')->check($data)) {
                    $this->error($validate->getError());
                }
            }
            if ($data['state'] == '0' && $id == '1') {
                $this->error('超级管理员admin状态不允许禁用!');
            }
            $result = db('admin')->where('id', $id)->update($data);
            if ($result) {
                $this->success('数据更新成功','index');
            } else {
                $this->error('数据更新失败');
            }
        }
        $data = db('admin')->where('id', $id)->find();
        $this->assign("data", $data);
        return view();
    }

    public function delete($id)
    {
        $res = db('admin')->where('id',$id)->delete();
        if ($res) {
            $this->success('删除管理员成功!','index');
        } else {
            $this->error('删除管理员失败!', 'index');
        }
    }
}