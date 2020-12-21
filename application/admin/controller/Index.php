<?php
namespace app\admin\controller;


use think\Controller;

class Index extends Controller {

    //防止重复登录过滤
    public function initialize()
    {
        if(session('?admin.id')){
            $this->redirect('admin/home/index');
        }
    }

    //跳转到后台登录页面
    public function login(){
        if(request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
            ];
            $result=model('Admin')->login($data);
            if($result==1){
                $this->success('登录成功! 欢迎使用','admin/home/index');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //注册
    public function register(){
        if(request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'conpass'=>input('post.conpass'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email')
            ];
            $result=model('Admin')->register($data);
            if($result==1){
                $this->success('注册成功','admin/index/login');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //忘记密码-发送验证码到邮箱
    public function forgetpwd(){
        if(request()->isAjax()){
            $data=[
                'email'=>input('post.email')
            ];
            $result = $this->validate($data,'Admin.getcode');
            if(true !== $result){
                // 验证失败 输出错误信息
                $this->error($result);
            }
            $code=mt_rand(1000,9999);
            session('code',$code);
            //发送验证码到邮箱
            $result=mailto(input('post.email'),'重置密码的验证码','您的验证码是:'.$code);
            if($result){
                $this->success('发送验证码成功,请查收！');
            }else{
                $this->error('发送验证码失败');
            }
        }

        return view();
    }

    //重置密码
    public function resetpwd(){
        if(request()->isAjax()){
            $data=[
                'code'=>input('post.code'),
                'email'=>input('post.email'),
                'password'=>input('post.password'),
                'conpass'=>input('post.conpass')
            ];
            $result=model('Admin')->resetpwd($data);
            if($result==1){
                $this->success('密码重置成功','admin/index/login');
            }else{
                $this->error($result);
            }
        }
    }
}
