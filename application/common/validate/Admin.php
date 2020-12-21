<?php


namespace app\common\validate;

use think\Validate;

class Admin extends Validate
{
    protected $rule=[
        'username|管理员账户'=>'require',
        'password|密码'=>'require',
        'newpwd|新密码'=>'require',
        'conpass|确认密码'=>'require|confirm:password',
        'nickname|昵称'=>'require',
        'email|邮箱'=>'require|email',
        'code|验证码'=>'require'
    ];

    //登录验证场景
    public function sceneLogin(){
        return $this->only(['username','password']);
    }

    //注册验证场景
    public function sceneRegister(){
        return $this->only(['username','password','conpass','nickname','email'])
            ->append('email','unique:admin')->append('username','unique:admin');
    }

    //获取验证码场景
    public function sceneGetcode(){
        return $this->only(['email']);
    }

    //重置密码验证场景
    public function sceneResetpwd(){
        return $this->only(['code','password','conpass']);
    }

    //编辑管理员场景
    public function sceneEdit(){
        return $this->only(['password','newpwd','nickname']);
    }
}