<?php
namespace app\admin\controller;
use think\Db;

class Index extends Common
{
    public function index()
    {
        return view();
    }

    /**
     * 获取服务器信息
     * @return \think\response\View
     */
    public function system()
    {
        $system = array(
            // 服务器IP
            'IP'=>$_SERVER['SERVER_ADDR'],
            // 服务器域名
            'host'=>$_SERVER['SERVER_NAME'],
            // 服务器操作系统
            'os' => PHP_OS, // 或使用php_uname()更详细
            // 运行环境
            'server'=>$_SERVER["SERVER_SOFTWARE"],
            // 服务器端口
            'port'=>$_SERVER['SERVER_PORT'],
            // PHP版本
            'version' => PHP_VERSION,
            // 数据库版本
            'mysql_ver' => Db::query('select version()')[0]['version()'],
            // 数据库名称
            'dbname' => config('database')['database'],
            // 数据库大小
        );
        $this->assign('system',$system);
        return view();
    }
}
