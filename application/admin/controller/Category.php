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
            CateModel::create($data);


        }
        return view();
    }
}
