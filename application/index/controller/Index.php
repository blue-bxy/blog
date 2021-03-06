<?php
namespace app\index\controller;


class Index extends Base
{


    //首页
    public function index()
    {
        $where=[];
        $catename=null;
        if(input('?id')){
            $where=[
              'cate_id'=>input('id')
            ];
            $catename=model('cate')->where('id',input('id'))->value('catename');
        }
        $articles=model('Article')->where($where)->order('create_time','desc')->paginate(5);
        $webInfo=model('system')->find();
        $ViewData=[
            'articles'=>$articles,
            'catename'=>$catename
        ];
        $this->assign($ViewData);
        return view();
    }

    //注册
    public function register(){
        if(request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'conpasspwd'=>input('post.conpasspwd'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email'),
                'verify'=>input('post.verify')
            ];
            $result=model('Member')->register($data);
            if($result==1){
                $this->success('注册成功!','index/index/login');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //登录
    public function login(){
        if(request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'verify'=>input('post.verify')
            ];
            $result=model('Member')->login($data);
            if($result==1){
                $this->success('登录成功!','index/index/index');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //退出登录
    public function loginout(){
        session(null);
        if(session('?user.id')){
            $this->error('退出失败');
        }else{
            $this->success('退出成功！','index/index/index');
        }
    }

    //搜索
    public function search(){
        $where[]=['title','like','%'.input('keyword').'%'];
        $articles=model('Article')->where($where)->order('create_time','desc')->paginate(5);
        $ViewData=[
            'articles'=>$articles,
            'catename'=>input('keyword')
        ];
        $this->assign($ViewData);
        return view('index');
    }
}
