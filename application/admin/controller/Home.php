<?php

namespace app\admin\controller;



class Home extends Base
{
    //后台首页
    public function index(){
        return view();
    }

    //退出登录
    public function loginout(){
        session(null);
        $this->success('退出成功！欢迎下次登录','admin/index/login');
    }
}
