<?php

namespace app\admin\controller;

use think\Controller;

class Login extends Controller
{
    public function index()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $res = $this->checkLogin($data);
            if (isset($res['aid'])) {
                $logInfo = array(
                    'uid' => $res['aid'],
                    'ip' => request()->ip(),
                    'logintime' => time(),
                    'msg' => $res['msg'],
                );
                db('log')->insert($logInfo);
                // 同ip管理员登陆次数
                $logscount = db('log')->where('uid',$res['aid'])->count();
                // 同ip管理员登陆次数超过30次时的最早登陆时的id
                $logsmin_time = db('log')->where('uid',$res['aid'])->min('logintime');
                // 同ip管理员登陆次数大于30次时删除时间最早的日志记录
                if ($logscount > 30) {
                    db('log')->where('uid',$res['aid'])->where('logintime',$logsmin_time)->delete();
                }
            }
            if ($res['code']) {
                $this->success($res['msg'], 'index/index');
            }
            $this->error($res['msg']);
        }
        // 解决重复登陆问题
        if (session('loginname', '', 'admin') && session('loginid', '', 'admin')) {
            $this->redirect('index/index');
        }
        return view();
    }

    public function checkLogin($data)
    {
        $validate = validate('Manager');
        $result = $validate->scene('login')->check($data);
        if (!$result) {
//            $this->error($validate->getError());
            return ['code' => 0, 'msg' => $validate->getError()];
        }
        $info = db('admin')->where('account', $data['account'])->find();

        if (!$info) {
//            $this->error('帐号不存在!');
            return ['code' => 0, 'msg' => '帐号不存在'];
        }
        if ($info['password'] != md5($data['password'])) {
//            $this->error('密码不正确!');
            return ['code' => 0, 'msg' => '密码不正确', 'aid' => $info['id']];
        }
        if ($info['state'] == 0) {
            return ['code' => 0, 'msg' => '用户已被锁定', 'aid' => $info['id']];
        }

        session('loginname', $data['account'], 'admin');
        session('loginid', $info['id'], 'admin');
//        $this->success('登陆成功!','index/index');
        return ['code' => 1, 'msg' => '登陆成功', 'aid' => $info['id']];
    }

    /**
     * 登陆退出
     */
    public function logout()
    {
        session(null, 'admin');
        $this->redirect('index');
    }
}
