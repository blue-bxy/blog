<?php

namespace app\index\controller;

use think\Controller;

class Base extends Controller
{
    //使用共享视图
    public function initialize()
    {
        $cates=model('cate')->order('sort','asc')->select();
        $webInfo=model('system')->find();
        $topArticles=model('article')->where('is_top',1)->order('create_time','desc')->limit(10)->select();
        $ViewData=[
            'cates'=>$cates,
            'webInfo'=>$webInfo,
            'topArticles'=>$topArticles
        ];
        $this->view->share($ViewData);
    }
}
