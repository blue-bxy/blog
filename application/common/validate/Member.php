<?php


namespace app\common\validate;


use think\Validate;

class Member extends Validate
{
    protected $rule=[
        'username|用户名'=>'require|unique:member',
        'password|密码'=>'require',
        'conpasspwd|确认密码'=>'require|confirm:password',
        'nickname|昵称'=>'require',
        'email|邮箱'=>'require|email|unique:member',
        'verify|验证码'=>'require|captcha',
        'conpass|新密码'=>'require',
    ];

    //添加会员场景
    public function sceneAddMember(){
        $this->only(['username','nickname','password','email']);
    }

    //编辑会员场景
    public function sceneEditMember(){
        $this->only(['nickname','password','conpass']);
    }

    //注册场景
    public function sceneRegister(){
        $this->only(['username','password','conpasspwd','nickname','email','verify']);
    }

    //登录场景
    public function sceneLogin(){
        $this->only(['username','password','verify'])->remove('username','unique');
    }
}