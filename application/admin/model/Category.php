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
                $tmp_arr['sort'] = $v['sort'];
                $arr[] = $tmp_arr;
                self::getCate($list,$v['id'],$lev);
            }
        }
        return $arr;
    }

    /**
     * 分类排序
     * @param $data
     */
    public  function sort($data)
    {
        foreach($data as $k => $v) {
            $tmp['id'] = $k;
            $tmp['sort'] = $v;
            $list[] = $tmp;
        }
        return $this->saveAll($list);
    }

    /**
     * 获取子分类的id
     * @param $id
     */
    public static function getChildrenIds($id) {
        $res = self::field('id')->where('pid',$id)->select();
        static $tmp = array();
        foreach ($res as $v) {
            $tmp[] = $v['id'];
            self::getChildrenIds($v['id']);
        }
        return $tmp;
    }
}
