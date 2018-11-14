<?php
namespace app\admin\controller;

use think\Controller;

class Login extends Controller
{
    public function index()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $validate = validate('Manager');
            $result = $validate->scene('login')->check($data);
            if (!$result) {
                $this->error($validate->getError());
            }
            $info = db('admin')->where('account',$data['account'])->find();
            if (!$info) {
                $this->error('帐号不存在!');
            }
            if ($info['password'] != md5($data['password'])) {
                $this->error('密码不正确!');
            }
            session('loginname',$data['account'],'admin');
            session('loginid',$info['id'],'admin');
            $this->success('登陆成功!','index/index');
        }
        // 解决重复登陆问题
        if (session('loginname','','admin') && session('loginid','','admin'))
        {
            $this->redirect('index/index');
        }
        return view();
    }
}
