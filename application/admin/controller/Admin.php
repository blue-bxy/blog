<?php

namespace app\admin\controller;



class Admin extends Base
{
    //管理员列表
    public function adminlist(){
        $admins=model('Admin')->order(['is_super'=>'desc','status'=>'desc'])->paginate(10);
        //定义一个模板数据变量
        $viewData=[
            'admins'=>$admins
        ];
        $this->assign($viewData);
        return view();
    }

    //管理员添加
    public function add(){
        if(request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'conpass'=>input('post.conpass'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email'),
            ];
            $result=model('admin')->add($data);
            if($result==1){
                $this->success('添加成功！','admin/admin/adminlist');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //管理员状态操作
    public function status(){
        $data=[
            'id'=>input('post.id'),
            'status'=>input('post.status')?0:1
        ];
        $result=model('Admin')->status($data);
        if($result==1){
            $this->success('操作成功！','admin/admin/adminlist');
        }else{
            $this->error($result);
        }
    }

    //管理员编辑
    public function edit(){
        if(request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'password'=>input('post.password'),
                'newpwd'=>input('post.newpwd'),
                'nickname'=>input('post.nickname'),
            ];
            $result=model('Admin')->edit($data);
            if($result==1){
                $this->success('管理员编辑成功！','admin/admin/adminlist');
            }else{
                $this->error($result);
            }
        }
        $adminInfo=model('Admin')->find(input('id'));
        $viewData=[
            'adminInfo'=>$adminInfo
        ];
        $this->assign($viewData);
        return view();
    }

    //管理员删除
    public function del(){
        $memberInfo=model('Admin')->find(input('post.id'));
        $result=$memberInfo->delete();
        if($result){
            $this->success('管理员删除成功！','admin/admin/adminlist');
        }else{
            $this->error('删除失败');
        }
    }
}
