<?php

namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
    //没登录先登录
    public function initialize()
    {
        if(!session('?admin.id')){
            $this->redirect('admin/index/login');
        }
    }
}
