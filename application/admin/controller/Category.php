<?php

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Category as CateModel;

class Category extends Common
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

    public function edit($id)
    {
        if (request()->isPost()) {
            $data = input('post.');
            $catIds = CateModel::getChildrenIds($id);
            $catIds[] = $id;
            if (!in_array($data['pid'],$catIds)) {
                $res = CateModel::update(['id' => $id, 'name' => $data['name'], 'pid' => $data['pid']]);
                if ($res) {
                    $this->success('修改栏目分类成功!',url('index'));
                }
            } else {
                $this->error('上级栏目不能选择当前分类和当前子分类!');
            }
        }
        // 获取栏目分类
        $list = CateModel::order('sort desc,id asc')->select();
        $res = CateModel::getCate($list);
        $catInfo = CateModel::get($id);
        $this->assign([
            'catelist' => $res,
            'catInfo' => $catInfo,
        ]);
        return view();
    }
}
