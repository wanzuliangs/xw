<?php

namespace app\admin\controller;


class Manager extends Common
{
    public function index()
    {
        $adminList = db('admin')->paginate(4);;
        $this->assign('adminList', $adminList);
        return view();
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $validate = validate('Manager');
            if (!$validate->scene('add')->check($data)) {
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
                $validate = validate('Manager');
                if (!$validate->scene('edit')->check($data)) {
                    $this->error($validate->getError());
                }
                $data['password'] = md5($data['password']);
            }
            unset($data['repass']);
            if ($data['state'] == '0' && $id == '1') {
                $this->error('超级管理员admin状态不允许禁用!');
            }
            $result = db('admin')->where('id = ' . $id)->update($data);
            if ($result) {
                $this->success('数据更新成功', 'index');
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
        if ($id == 1) {
            $this->error('超级管理员不能删除');
        }
        $res = db('admin')->where('id', $id)->delete();
        if ($res) {
            $this->success('删除管理员成功!', 'index');
        } else {
            $this->error('删除管理员失败!', 'index');
        }
    }

    /**
     * 管理员密码修改
     */
    public function setpass()
    {
        if (request()->isPost()) {
            $loginid = session('loginid', '', 'admin');
            // 获取表单数据
            $data = input('post.');
            // 后端验证表单数据
            $validate = validate('Manager');
            if (!$validate->scene('editpass')->check($data)) {
                $this->error($validate->getError());
            }
            // 判断旧密码是否正确
            $data_admin = db('admin')->where('id',$loginid)->find();
            if (md5($data['oldpassword']) != $data_admin['password']) {
                $this->error('旧密码不正确!');
            }
            // 如果帐号存在，则去除
            if (isset($data['account']) && !empty($data['account'])) {
                unset($data['account']);
            }
            unset($data['oldpassword']);
            unset($data['repass']);
            $data['password'] = md5($data['password']);
            $res = db('admin')->where('id',$loginid)->update($data);
            if ($res) {
                $this->success('密码修改成功!');
            }
            return;
        }
        return view();
    }
}