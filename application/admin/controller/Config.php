<?php

namespace app\admin\controller;

use think\Controller;

class Config extends Controller
{
    public function index()
    {
        if (request()->isPost()) {
            $data = input('post.');
            // 获取表单传过来的图片
            $file = input('file.imglogo');
            if ($file) {
                $data['img'] = $this->upload($file);
            }
            $data_config = json_encode($data, JSON_UNESCAPED_UNICODE);
            $configInfo = db('config')->find();
            if (!$configInfo) {
                db('config')->insert(['cfg' => $data_config]);
            } else {
                db('config')->where('id', $configInfo['id'])->update(['cfg' => $data_config]);
            }
            $this->success('修改配置成功!');
        }
        $config = db('config')->find();
        $configInfo = json_decode($config['cfg'], true);
        $this->assign('configInfo', $configInfo);
        return view();
    }

    protected function upload($file)
    {
        if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads','logo');
            $filename = $info->getFilename();
            return $filename;
        }
    }
}