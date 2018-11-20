<?php

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Category as CateModel;

class Category extends Controller
{
    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $validate = validate('Category');
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }
            if (CateModel::create($data)) {
                $this->success('栏目分类添加成功!');
            }

        }
        $list = CateModel::order('sort desc,id asc')->select();
        $res = CateModel::getCate($list);
        $this->assign('catelist', $res);
        return view();
    }

    public function index()
    {
        $list = CateModel::order('sort desc,id asc')->select();
        $res = CateModel::getCate($list);
        $this->assign('catelist', $res);
        return view();
    }

    /**
     * 栏目排序
     */
    public function sort()
    {
        if (request()->isPost()) {
           $data = input('post.');
           $cateModel = new CateModel();
           if ($cateModel->sort($data)) {
                $this->success('排序成功!');
           }
        }

    }
}
