<?php

namespace app\admin\controller;



class Member extends Base
{
    //会员列表
    public function memberlist(){
        $members=model('Member')->order('create_time','desc')->paginate(10);
        //定义一个模板数据变量
        $viewData=[
            'members'=>$members
        ];
        $this->assign($viewData);
        return view();
    }

    //会员添加
    public function add(){
        if(request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email'),
            ];
            $result=model('Member')->add($data);
            if($result==1){
                $this->success('添加成功！','admin/member/memberlist');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //会员编辑
    public function edit(){
        if(request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'nickname'=>input('post.nickname'),
                'password'=>input('post.password'),
                'conpass'=>input('post.conpass'),
            ];
            $result=model('Member')->edit($data);
            if($result==1){
                $this->success('会员编辑成功！','admin/member/memberlist');
            }else{
                $this->error($result);
            }
        }
        $memberInfo=model('Member')->find(input('id'));
        $viewData=[
            'memberInfo'=>$memberInfo
        ];
        $this->assign($viewData);
        return view();
    }

    //会员删除
    public function del(){
        $memberInfo=model('member')->with('comments')->find(input('post.id'));
        $result=$memberInfo->together('comments')->delete();
        if($result){
            $this->success('会员删除成功！','admin/member/memberlist');
        }else{
            $this->error('删除失败');
        }
    }
}
