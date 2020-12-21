<?php
namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;


class Admin extends Model{
    // 设置当前模型对应的完整数据表名称

    //软删除
    use SoftDelete;

    //登录校验
    public function login($data){
        $validate=new \app\common\validate\Admin();
        if(!$validate->scene('login')->check($data)){
            return $validate->getError();
        }
        $result=$this->where($data)->find();
        if($result){
            //判断用户是否被禁用
            if($result['status']!=1){
                return '此账户被禁用';
            }

            //存取用户的信息到session
            $sessionData=[
                'id'=>$result['id'],
                'nickname'=>$result['nickname'],
                'is_super'=>$result['is_super']
            ];
            session('admin',$sessionData);
            return 1;//1表示用户名密码正确
        }else{
            return '用户名或密码错误';
        }
    }

    //注册账号
    public function register($data){
        $validate=new \app\common\validate\Admin();
        if(!$validate->scene('register')->check($data)){
            return $validate->getError();
        }
        $result=$this->allowField(true)->save($data);
        if($result){
            mailto($data['email'],'注册管理员账户成功','注册管理员成功！，感谢使用');
            return 1;
        }else{
            return '注册失败';
        }
    }

    //重置密码
    public function resetpwd($data){
        $validate=new \app\common\validate\Admin();
        if(!$validate->scene('resetpwd')->check($data)){
            return $validate->getError();
        }
        if($data['code']!=session('code')){
            return '验证码不正确！';
        }
        $adminInfo=$this->where('email',$data['email'])->find();
        $password=$data['password'];
        $adminInfo->password=$password;
        $result=$adminInfo->save();
        if($result){
            return 1;
        }else{
            return '重置密码失败！';
        }
    }

    //添加管理员
    public function add($data){
        $validate=new \app\common\validate\Admin();
        if(!$validate->scene('register')->check($data)){
            return $validate->getError();
        }
        $result=$this->allowField(true)->save($data);
        if($result){
            return 1;
        }else{
            return '添加失败';
        }
    }

    //管理员状态操作
    public function status($data){
        $adminInfo=$this->find($data['id']);
        $adminInfo->status=$data['status'];
        $result=$adminInfo->save();
        if($result){
            return 1;
        }else{
            return '操作失败';
        }
    }

    //管理员编辑
    public function edit($data){
        $validate=new \app\common\validate\Admin();
        if(!$validate->scene('Edit')->check($data)){
            return $validate->getError();
        }
        $adminInfo=$this->find($data['id']);
        if($data['password']!=$adminInfo['password']){
            return '原密码不正确';
        }
        $adminInfo->password=$data['newpwd'];
        $adminInfo->nickname=$data['nickname'];
        $result=$adminInfo->save();
        if($result){
            return 1;
        }else{
            return '编辑失败';
        }

    }
}

