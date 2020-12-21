<?php

namespace app\admin\controller;



//栏目管理
class Cate extends Base
{
    //栏目列表
    public function list(){
        $cates=model('Cate')->order('sort','asc')->paginate(10);
        //定义一个模板数据变量
        $viewData=[
          'cates'=>$cates
        ];
        $this->assign($viewData);
        return view();
    }

    //栏目的添加
    public function addcate(){
        if(request()->isAjax()){
            $data=[
              'catename'=>input('post.catename'),
              'sort'=>input('post.sort')
            ];
            $result=model('Cate')->addcate($data);
            if($result==1){
                $this->success('栏目添加成功！','admin/cate/list');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //栏目排序
    public function  sort(){
        if(request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'sort'=>input('post.sort')
            ];
            $result=model('Cate')->sort($data);
            if($result==1){
                $this->success('排序成功！','admin/cate/list');
            }else{
                $this->error($result);
            }
        }
    }

    //栏目编辑
    public function edit(){
        if(request()->isAjax()){
            $data=[
                'catename'=>input('post.catename'),
                'id'=>input('post.id')
            ];
            $result=model('Cate')->editcate($data);
            if($result==1){
                $this->success('栏目编辑成功！','admin/cate/list');
            }else{
                $this->error($result);
            }
        }

        $cateInfo=model('Cate')->find(input('id'));
        //定义一个模板数据变量
        $viewData=[
            'cateInfo'=>$cateInfo
        ];
        $this->assign($viewData);
        return view();
    }

    //栏目删除
    public function del(){
        $cateInfo=model('cate')->with('article')->find(input('post.id'));
        foreach ($cateInfo['article'] as $k=>$v){
            $v->together('comments')->delete();
        }
        $result=$cateInfo->together('article')->delete();
        if($result){
            $this->success('栏目删除成功！','admin/cate/list');
        }else{
            $this->error('删除失败');
        }

    }
}
