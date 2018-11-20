<?php

namespace app\admin\model;

use think\Model;

class Category extends Model
{
    // 获取栏目分类
    public static function getCate($list,$pid = 0,$lev=-1)
    {
        static $arr = array();
        $lev+=1;
        if ($lev == 0) {
            $str = '';
        } else {
            $str = '|';
        }
        foreach ($list as $v) {
            if ($v['pid'] == $pid) {
                $tmp_arr['id'] = $v['id'];
                $tmp_arr['name'] = $str . str_repeat('---',$lev) . $v['name'];
                $tmp_arr['pid'] = $v['pid'];
                $arr[] = $tmp_arr;
                self::getCate($list,$v['id'],$lev);
            }
        }
        return $arr;
    }
}
